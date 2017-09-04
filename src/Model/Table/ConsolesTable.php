<?php
namespace PersonalGames\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Consoles Model
 *
 * @property \PersonalGames\Model\Table\GamesTable|\Cake\ORM\Association\HasMany $Games
 *
 * @method \PersonalGames\Model\Entity\Console get($primaryKey, $options = [])
 * @method \PersonalGames\Model\Entity\Console newEntity($data = null, array $options = [])
 * @method \PersonalGames\Model\Entity\Console[] newEntities(array $data, array $options = [])
 * @method \PersonalGames\Model\Entity\Console|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \PersonalGames\Model\Entity\Console patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \PersonalGames\Model\Entity\Console[] patchEntities($entities, array $data, array $options = [])
 * @method \PersonalGames\Model\Entity\Console findOrCreate($search, callable $callback = null, $options = [])
 */
class ConsolesTable extends Table
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

        $this->setTable('consoles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Games', [
            'foreignKey' => 'console_id'
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

        return $validator;
    }
}
