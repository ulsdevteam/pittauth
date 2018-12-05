<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IdtypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IdtypesTable Test Case
 */
class IdtypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\IdtypesTable
     */
    public $Idtypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.idtypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Idtypes') ? [] : ['className' => IdtypesTable::class];
        $this->Idtypes = TableRegistry::getTableLocator()->get('Idtypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Idtypes);

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
