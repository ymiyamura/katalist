<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserPeersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserPeersTable Test Case
 */
class UserPeersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserPeersTable
     */
    public $UserPeers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_peers',
        'app.users',
        'app.peers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserPeers') ? [] : ['className' => UserPeersTable::class];
        $this->UserPeers = TableRegistry::getTableLocator()->get('UserPeers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserPeers);

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
