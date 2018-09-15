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
    private $statuses = [
        1 => 'offered',
        2 => 'accepted',
        3 => 'called',
        4 => 'cancelled',
    ];

    private $disp_statuses = [
        1 => 'オファー中',
        2 => '承諾済み',
        3 => '完了',
        4 => 'キャンセル',
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

    public function getStatuses()
    {
        return $this->statuses;
    }

    public function getDispStatuses()
    {
        return $this->disp_statuses;
    }
}
