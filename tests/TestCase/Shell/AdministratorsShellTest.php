<?php
namespace PersonalGames\Test\TestCase\Shell;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\ConsoleIntegrationTestCase;
use PersonalGames\Shell\AdministratorsShell;

/**
 * PersonalGames\Shell\AdministratorsShell Test Case
 */
class AdministratorsShellTest extends ConsoleIntegrationTestCase
{

    /**
     * ConsoleIo mock
     *
     * @var \Cake\Console\ConsoleIo|\PHPUnit_Framework_MockObject_MockObject
     */
    public $io;

    public $fixtures = [
        'app.administrators'
    ];

    /**
     * Test subject
     *
     * @var \PersonalGames\Shell\AdministratorsShell
     */
    public $Administrators;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->io = $this->getMockBuilder('Cake\Console\ConsoleIo')->getMock();
        $this->Administrators = new AdministratorsShell($this->io);
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
     * Description test
     *
     * @return void
     */
    public function testDescriptionOutput()
    {
        $this->exec('administrators');
        $this->assertOutputContains('A nifty backend tool to add administrators');
    }

    /**
     * Test getOptionParser method
     *
     * @return void
     */
    public function testGetOptionParser()
    {
        $this->exec('administrators');
        $this->assertOutputContains('--email');
        $this->assertOutputContains('--password');
        $this->assertOutputContains('--name');
    }

    /**
     * Test main method
     *
     * @return void
     */
    public function testMainFailsWithMissingOptions()
    {
        $administratorsTable = TableRegistry::get('Administrators');
        $query = $administratorsTable->find();
        $results = $query->hydrate(false)->toArray();
        $this->exec('administrators');
        $this->assertErrorContains('is required to properly add an administrator');
        $afterFailResults = $administratorsTable->find();
        $this->assertEquals($results, $afterFailResults->hydrate(false)->toArray());
        $this->exec('administrators --name TestCase');
        $afterFailResults = $administratorsTable->find();
        $this->assertEquals($results, $afterFailResults->hydrate(false)->toArray());
        $this->exec('administrators --name TestCase --password password');
        $afterFailResults = $administratorsTable->find();
        $this->assertEquals($results, $afterFailResults->hydrate(false)->toArray());
        $this->exec('administrators --name TestCase --email fail@test.com');
        $afterFailResults = $administratorsTable->find();
        $this->assertEquals($results, $afterFailResults->hydrate(false)->toArray());
        $this->exec('administrators --email TestCase@test.com --password password');
        $afterFailResults = $administratorsTable->find();
        $this->assertEquals($results, $afterFailResults->hydrate(false)->toArray());
    }

    public function testMainSucceedsWithAllOptions()
    {
        $adminTable = TableRegistry::get('Administrators');
        $this->exec('administrators --name testAddition --password password --email testAddition@test.com');
        $this->assertOutputContains('New administrator saved.');
        $results = $adminTable->find()->where(['name' => 'testAddition', 'email' => 'testAddition@test.com'])->first();
        $this->assertNotNull($results);
    }
}
