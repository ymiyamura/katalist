<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Offers Model
 *
 * @property \App\Model\Table\FromUsersTable|\Cake\ORM\Association\BelongsTo $FromUsers
 * @property \App\Model\Table\ToUsersTable|\Cake\ORM\Association\BelongsTo $ToUsers
 *
 * @method \App\Model\Entity\Offer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Offer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Offer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Offer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Offer|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Offer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Offer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Offer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OffersTable extends Table
{
    const STATUS_OFFERED = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_CALLED = 3;
    const STATUS_CANCELLED = 4;

    private $disp_statuses = [
        self::STATUS_OFFERED => 'オファー中',
        self::STATUS_ACCEPTED => '承認済み',
        self::STATUS_CALLED => '完了',
        self::STATUS_CANCELLED => 'キャンセル',
    ];

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('offers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ToUsers', [
            'className' => 'Users',
            'foreignKey' => 'to_user_id',
            'bindingKey' => 'id',
        ]);

        $this->belongsTo('FromUsers', [
            'className' => 'Users',
            'foreignKey' => 'from_user_id',
            'bindingKey' => 'id',
        ]);

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

        $validator
            ->scalar('request_message')
            ->allowEmpty('request_message');

        $validator
            ->scalar('free_message')
            ->allowEmpty('free_message');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        $validator
            ->dateTime('accepted')
            ->allowEmpty('accepted');

        $validator
            ->dateTime('cancelled')
            ->allowEmpty('cancelled');

        $validator
            ->dateTime('called')
            ->allowEmpty('called');

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

    public function getDispStatuses()
    {
        return $this->disp_statuses;
    }

    public function accept($id, $accept_user_id)
    {
        $offer = $this->find()
            ->where([
                'id' => $id,
                'to_user_id' => $accept_user_id,
            ])
            ->first();
        if (empty($offer)) {
            return false;
        }
        $data = [
             'status' => self::STATUS_ACCEPTED,
             'accepted' => date('Y-m-d H:i:s'),
        ];
        $offer = $this->patchEntity($offer, $data);
        if (!$this->save($offer)) {
            return false;
        }
        return true;
    }

    public function call($id, $accept_user_id)
    {
        $offer = $this->find()
            ->where([
                'id' => $id,
                'to_user_id' => $accept_user_id,
            ])
            ->first();
        if (empty($offer)) {
            return false;
        }
        $data = [
             'status' => self::STATUS_CALLED,
             'called' => date('Y-m-d H:i:s'),
        ];
        $offer = $this->patchEntity($offer, $data);
        if (!$this->save($offer)) {
            return false;
        }
        return true;
    }

    public function cancel($id, $accept_user_id)
    {
        $offer = $this->find()
            ->where([
                'id' => $id,
                'to_user_id' => $accept_user_id,
            ])
            ->first();
        if (empty($offer)) {
            return false;
        }
        $data = [
             'status' => self::STATUS_CANCELLED,
             'cancelled' => date('Y-m-d H:i:s'),
        ];
        $offer = $this->patchEntity($offer, $data);
        if (!$this->save($offer)) {
            return false;
        }
        return true;
    }
}
