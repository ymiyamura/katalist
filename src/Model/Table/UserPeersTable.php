<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * UserPeers Model
 *
 * @method \App\Model\Entity\UserPeer get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserPeer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserPeer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserPeer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserPeer|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserPeer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserPeer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserPeer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserPeersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('user_peers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmpty('id', 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        return $rules;
    }

    public function updatePeerId($user_id)
    {
        $Users = TableRegistry::get('Users');
        $user = $Users->find()
            ->where(['id' => $user_id])
            ->first();

        // userのvalidation
        if (empty($user)) {
            return false;
        }

        $peer_id = $this->createPeerId();
        if (!$peer_id) {
            return false;
        }
        $user_peer = $this->find()->where(['user_id' => $user_id])->first();
        if (empty($user_peer)) {
            $user_peer = $this->newEntity();
            $user_peer->user_id = $user_id;
            $user_peer->peer_id = $peer_id;
        } else {
            $user_peer->peer_id = $peer_id;
        }
        try {
            return $this->save($user_peer);
        } catch (\Exception $e) {
            $this->log([
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return false;
        }
    }

    public function createPeerId()
    {
        $success = false;
        $length = 16;
        for ($i=0; $i < 3; $i++) {
            $tmp = substr(base_convert(md5(uniqid()), 16, 36), 0, $length);
            if (!$this->exists(['peer_id' => $tmp])) {
                $success = true;
                break;
            }
        }
        if ($success) {
            return $tmp;
        }
        return false;
    }
}
