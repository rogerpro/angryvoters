<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ElectionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ElectionsTable Test Case
 */
class ElectionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ElectionsTable
     */
    public $Elections;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.elections',
        'app.questions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Elections') ? [] : ['className' => 'App\Model\Table\ElectionsTable'];
        $this->Elections = TableRegistry::get('Elections', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Elections);

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
