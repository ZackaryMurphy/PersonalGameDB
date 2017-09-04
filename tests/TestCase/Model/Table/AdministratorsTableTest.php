<?php
namespace PersonalGames\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use PersonalGames\Model\Table\AdministratorsTable;

/**
 * PersonalGames\Model\Table\AdministratorsTable Test Case
 */
class AdministratorsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \PersonalGames\Model\Table\AdministratorsTable
     */
    public $Administrators;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.administrators'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Administrators') ? [] : ['className' => AdministratorsTable::class];
        $this->Administrators = TableRegistry::get('Administrators', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Administrators);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
