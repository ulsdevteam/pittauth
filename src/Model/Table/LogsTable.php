<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Database\Schema\TableSchema as Schema;
/**
 * Logs Model
 *
 * @method \App\Model\Entity\Log get($primaryKey, $options = [])
 * @method \App\Model\Entity\Log newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Log[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Log|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Log|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Log patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Log[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Log findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LogsTable extends Table
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

        $this->setTable('Logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        //allow Logs controller actions to have a query that will 'contain' => ['Accounts']
        $this->belongsTo('Accounts')
            ->setBindingKey('username')
            ->setForeignKey('username')
            ->setJoinType('INNER');
        
        $this->belongsTo('idtypes')
            ->setForeignKey('id_type');
        
        }
    //
    protected function _initializeSchema(Schema $table)
    {
        $table->setColumnType('id_number', 'crypted');
        //more could be added in the same pattern as above
        
        return $table;
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
            ->scalar('username')
            ->maxLength('username', 30)
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->scalar('firstname')
            ->maxLength('firstname', 35)
            ->requirePresence('firstname', 'create')
            ->notEmpty('firstname');

        $validator
            ->scalar('lastname')
            ->maxLength('lastname', 35)
            ->requirePresence('lastname', 'create')
            ->notEmpty('lastname');

        $validator
            ->scalar('id_number')
            ->maxLength('id_number', 200)
            ->requirePresence('id_number', 'create')
            ->notEmpty('id_number');

        $validator
            ->scalar('id_type')
            ->maxLength('id_type', 50)
            ->requirePresence('id_type', 'create')
            ->notEmpty('id_type');

        $validator
            ->scalar('note')
            ->maxLength('note', 500)
            ->allowEmpty('note');

        $validator
            ->scalar('assigned_by')
            ->maxLength('assigned_by', 50)
            ->requirePresence('assigned_by', 'create')
            ->notEmpty('assigned_by');

        $validator
            ->dateTime('cleared')
            ->allowEmpty('cleared');

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
}
