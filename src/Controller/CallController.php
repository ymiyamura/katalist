<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Call Controller
 *
 *
 * @method \App\Model\Entity\Call[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CallController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $call = $this->paginate($this->Call);

        $this->set(compact('call'));
    }

    /**
     * View method
     *
     * @param string|null $id Call id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $call = $this->Call->get($id, [
            'contain' => []
        ]);

        $this->set('call', $call);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $call = $this->Call->newEntity();
        if ($this->request->is('post')) {
            $call = $this->Call->patchEntity($call, $this->request->getData());
            if ($this->Call->save($call)) {
                $this->Flash->success(__('The call has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The call could not be saved. Please, try again.'));
        }
        $this->set(compact('call'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Call id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $call = $this->Call->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $call = $this->Call->patchEntity($call, $this->request->getData());
            if ($this->Call->save($call)) {
                $this->Flash->success(__('The call has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The call could not be saved. Please, try again.'));
        }
        $this->set(compact('call'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Call id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $call = $this->Call->get($id);
        if ($this->Call->delete($call)) {
            $this->Flash->success(__('The call has been deleted.'));
        } else {
            $this->Flash->error(__('The call could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
