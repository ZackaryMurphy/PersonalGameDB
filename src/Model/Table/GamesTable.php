<?php
namespace PersonalGames\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Games Model
 *
 * @property \PersonalGames\Model\Table\ConsolesTable|\Cake\ORM\Association\BelongsTo $Consoles
 *
 * @method \PersonalGames\Model\Entity\Game get($primaryKey, $options = [])
 * @method \PersonalGames\Model\Entity\Game newEntity($data = null, array $options = [])
 * @method \PersonalGames\Model\Entity\Game[] newEntities(array $data, array $options = [])
 * @method \PersonalGames\Model\Entity\Game|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \PersonalGames\Model\Entity\Game patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \PersonalGames\Model\Entity\Game[] patchEntities($entities, array $data, array $options = [])
 * @method \PersonalGames\Model\Entity\Game findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GamesTable extends Table
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

        $this->setTable('games');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Consoles', [
            'foreignKey' => 'console_id',
            'joinType' => 'INNER'
        ]);
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('notes')
            ->requirePresence('notes', 'create')
            ->notEmpty('notes');

        $validator
            ->boolean('special_edition')
            ->requirePresence('special_edition', 'create')
            ->notEmpty('special_edition');

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
        $rules->add($rules->existsIn(['console_id'], 'Consoles'));

        return $rules;
    }
}
