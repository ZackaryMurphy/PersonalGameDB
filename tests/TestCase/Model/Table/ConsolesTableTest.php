<?php
namespace PersonalGames\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use PersonalGames\Model\Table\ConsolesTable;

/**
 * PersonalGames\Model\Table\ConsolesTable Test Case
 */
class ConsolesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \PersonalGames\Model\Table\ConsolesTable
     */
    public $Consoles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.consoles',
        'app.games'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Consoles') ? [] : ['className' => ConsolesTable::class];
        $this->Consoles = TableRegistry::get('Consoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Consoles);

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
}
