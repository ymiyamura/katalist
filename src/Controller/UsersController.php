<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\File;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // ユーザーの登録とログアウトを許可します。
        // allow のリストに "login" アクションを追加しないでください。
        // そうすると AuthComponent の正常な機能に問題が発生します。
        $this->Auth->allow(['add', 'logout']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $conditions = [
            'is_katalist' => true,
        ];
        if ($this->Auth->user('id') > 0) {
            $conditions['id !='] = $this->Auth->user('id');
        }
        $this->paginate = [
            'conditions' => $conditions,
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->Offers = TableRegistry::getTableLocator()->get('Offers');
        $offer = $this->Offers->newEntity();
        $this->set(compact('user', 'offer'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->Auth->user()) {
            $this->Auth->logout();
            return $this->redirect(['action' => 'add']);
        }
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            $user['catch_phrase'] = ''; // TODO
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                // ログイン処理
                $user = $this->Auth->identify();
                if ($user) {
                    $this->Auth->setUser($user);
                    return $this->redirect($this->Auth->redirectUrl());
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {
        $user_id = $this->Auth->user('id');
        // 自分のユーザのみ編集できる
        if (empty($user_id)) {
            return $this->redirect(['action' => 'index']);
        }

        $user = $this->Users->get($user_id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->log($this->request->getData());
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'edit']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function imageDelete()
    {
        $user_id = $this->Auth->user('id');
        // 自分のユーザのみ編集できる
        if (empty($user_id)) {
            return $this->redirect(['action' => 'index']);
        }
        $user = $this->Users->get($user_id, [
            'contain' => []
        ]);
        if (empty($user->image1)) {
            $this->Flash->error(__('No image.'));
            return $this->redirect(['action' => 'edit']);
        }
        $user->image1 = '';
        $user->dir1 = '';
        $this->log($user->_accessible);
        if (!$this->Users->save($user)) {
            $this->Flash->error(__('The image could not be deleted. Please, try again.'));
            return $this->redirect(['action' => 'edit']);
        }

        // ファイル削除
        $file = new File(WWW_ROOT . 'files' . DS . 'Users' . DS . 'image1' . DS . $user->id . DS . $user->image1);
        $this->log($file);
        // $this->log($file->exists());
        if ($file->exists()) {
            $file->delete();
        }
        $this->Flash->success(__('image deleted'));
        return $this->redirect(['action' => 'edit']);
    }
}
