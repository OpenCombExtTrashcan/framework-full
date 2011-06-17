<?php

use jc\mvc\model\db\orm\operators\Selecter;

require_once __DIR__.'/../../../../common.php';
require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Selecter test case.
 */
class SelecterTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var Selecter
	 */
	private $Selecter;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		// TODO Auto-generated SelecterTest::setUp()
		

		$this->Selecter = new Selecter(/* parameters */);
	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated SelecterTest::tearDown()
		

		$this->Selecter = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests Selecter->select()
	 */
	public function testSelect() {
		// TODO Auto-generated SelecterTest->testSelect()
		$this->markTestIncomplete ( "select test not implemented" );
		
		$this->Selecter->select(/* parameters */);
	
	}

}

