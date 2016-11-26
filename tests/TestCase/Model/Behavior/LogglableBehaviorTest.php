<?php
namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\LogglableBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\LogglableBehavior Test Case
 */
class LogglableBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Behavior\LogglableBehavior
     */
    public $Logglable;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Logglable = new LogglableBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Logglable);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
