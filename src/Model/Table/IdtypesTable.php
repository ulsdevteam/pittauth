<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Idtypes Model
 *
 * @method \App\Model\Entity\Idtype get($primaryKey, $options = [])
 * @method \App\Model\Entity\Idtype newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Idtype[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Idtype|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Idtype|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Idtype patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Idtype[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Idtype findOrCreate($search, callable $callback = null, $options = [])
 */
class IdtypesTable extends Table
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

        $this->setTable('idtypes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('idtype')
            ->maxLength('idtype', 50)
            ->requirePresence('idtype', 'create')
            ->notEmpty('idtype');

        return $validator;
    }
}
