<?php
namespace jc\test\unit\testcase\jc\db\reflecter;

use jc\test\unit\testcase\jc\db\reflecter\mock\MockDriver;

use jc\db\DB;
use jc\db\reflecter\MySQLDBReflecter;
use jc\db\reflecter\MySQLReflecterFactory ;

/**
 * Test class for jc\db\reflecter\MySQLReflecterFactory.
 * @for jc\db\reflecter\MySQLReflecterFactory
 */
class MySQLReflecterFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\db\reflecter\MySQLReflecterFactory
     */
    protected $aMySQLReflecterFactory;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    	
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testCreateDBReflecter()
    {
    	$aDB = new DB();
    	$aDB->setDriver(new MockDriver('test', 'test', 'test'));
    	$aMySQLReflecterFactory = new MySQLReflecterFactory($aDB);
    	$aMySQLReflecter = $aMySQLReflecterFactory->createDBReflecter('testDB');
    	
    	$this->assertType(MySQLDBReflecter, $aMySQLReflecter);
    }

    /**
     * @todo Implement testCreateTableReflecter().
     */
    public function testCreateTableReflecter()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testCreateColumnReflecter().
     */
    public function testCreateColumnReflecter()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testCreateIndexReflecter().
     */
    public function testCreateIndexReflecter()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
}
?>
