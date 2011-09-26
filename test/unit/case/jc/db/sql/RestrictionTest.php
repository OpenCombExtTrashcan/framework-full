<?php
namespace jc\test\unit\testcase\jc\db\sql;

use jc\db\sql\Restriction;

/**
 * Test class for jc\db\sql\Restriction.
 * @for jc\db\sql\Restriction
 */
class RestrictionTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @var jc\db\sql\Restriction
	 */
	protected $aRestriction;
	
	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		//        $this->aRestriction = new Restriction ;
	}
	
	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
	}
	
	public function testMakeStatement() {
		$aRestriction = new Restriction ();
		
		$aRestriction->eqColumn ( 'testColumn1', 'testColumn2' )
		->neColumn ( 'testColumn1', 'testColumn2' )
		->eq ( 'testColumn', 11 )
		->in ( 'testColumn', array ('a', 'b', 'c', 1, 2, 3 ) )
		->isNotNull ( 'testColumn' )
		->expression ( " 1 = 1 AND `testTable`.`testColumn` >= '1' ORDER BY `testTable`.`testColumn` " );
		$aRestriction1 = new Restriction();
		$aRestriction1->eq ( 'testColumn1', 111 )->in ( 'testColumn', array ('a', 'b', 'c', 1, 2, 3 ) );
		$aRestriction->add($aRestriction1);
		$this->assertEquals("`testColumn1` = `testColumn2` AND `testColumn1` <> `testColumn2` AND `testColumn` = '11' ".
		"AND `testColumn` IN ('a','b','c','1','2','3') AND `testColumn` IS NOT NULL AND  1 = 1 ".
		"AND `testTable`.`testColumn` >= '1' ORDER BY `testTable`.`testColumn`  AND ( `testColumn1` = '111' ".
		"AND `testColumn` IN ('a','b','c','1','2','3') )", $aRestriction->makeStatement() ) ;
	}
	
//	/**
//	 * @todo Implement testCheckValid().
//	 */
//	public function testCheckValid() {
//		// Remove the following lines when you implement this test.
//		$this->markTestIncomplete ( 'This test has not been implemented yet.' );
//	}
	
	public function testLogic() {
		$aRestriction = new Restriction ();
		$aRestriction->setLogic ( false );
		$this->assertFalse ( $aRestriction->logic () );
		$aRestriction->setLogic ( true );
		$this->assertTrue ( $aRestriction->logic () );
	}
	
	public function testSetLogic() {
		$this->testLogic ();
	}
	
	public function testClear() {
		$aRestriction = new Restriction ();
		$aRestriction->eq ( 'testColumn', 11 );
		$aRestriction->expression ( "`testColumn` = 11" );
		$this->assertEquals ( "`testColumn` = '11' AND `testColumn` = 11", $aRestriction->makeStatement () );
		$aRestriction->clear ();
		$this->assertEquals ( "", $aRestriction->makeStatement () );
	}
	
	public function testEq() {
		$aRestriction = new Restriction ();
		$aRestriction->eq ( 'testColumn', 11 );
		$this->assertEquals ( "`testColumn` = '11'", $aRestriction->makeStatement () );
	}
	
	public function testEqColumn() {
		$aRestriction = new Restriction ();
		$aRestriction->eqColumn ( 'testColumn1', 'testColumn2' );
		$this->assertEquals ( "`testColumn1` = `testColumn2`", $aRestriction->makeStatement () );
	}
	
	public function testNe() {
		$aRestriction = new Restriction ();
		$aRestriction->ne ( 'testColumn1', '12' );
		$this->assertEquals ( "`testColumn1` <> '12'", $aRestriction->makeStatement () );
	}
	
	public function testNeColumn() {
		$aRestriction = new Restriction ();
		$aRestriction->neColumn ( 'testColumn1', 'testColumn2' );
		$this->assertEquals ( "`testColumn1` <> `testColumn2`", $aRestriction->makeStatement () );
	}
	
	public function testGt() {
		$aRestriction = new Restriction ();
		$aRestriction->gt ( 'testColumn1', '12' );
		$this->assertEquals ( "`testColumn1` > '12'", $aRestriction->makeStatement () );
	}
	
	public function testGtColumn() {
		$aRestriction = new Restriction ();
		$aRestriction->gtColumn ( 'testColumn1', 'testColumn2' );
		$this->assertEquals ( "`testColumn1` > `testColumn2`", $aRestriction->makeStatement () );
	}
	
	public function testGe() {
		$aRestriction = new Restriction ();
		$aRestriction->ge ( 'testColumn1', '12' );
		$this->assertEquals ( "`testColumn1` >= '12'", $aRestriction->makeStatement () );
	}
	
	public function testGeColumn() {
		$aRestriction = new Restriction ();
		$aRestriction->geColumn ( 'testColumn1', 'testColumn2' );
		$this->assertEquals ( "`testColumn1` >= `testColumn2`", $aRestriction->makeStatement () );
	}
	
	public function testLt() {
		$aRestriction = new Restriction ();
		$aRestriction->lt ( 'testColumn1', '12' );
		$this->assertEquals ( "`testColumn1` < '12'", $aRestriction->makeStatement () );
	}
	
	public function testLtColumn() {
		$aRestriction = new Restriction ();
		$aRestriction->ltColumn ( 'testColumn1', 'testColumn2' );
		$this->assertEquals ( "`testColumn1` < `testColumn2`", $aRestriction->makeStatement () );
	}
	
	public function testLe() {
		$aRestriction = new Restriction ();
		$aRestriction->le ( 'testColumn1', '12' );
		$this->assertEquals ( "`testColumn1` <= '12'", $aRestriction->makeStatement () );
	}
	
	public function testLeColumn() {
		$aRestriction = new Restriction ();
		$aRestriction->leColumn ( 'testColumn1', 'testColumn2' );
		$this->assertEquals ( "`testColumn1` <= `testColumn2`", $aRestriction->makeStatement () );
	}
	
	public function testLike() {
		$aRestriction = new Restriction ();
		$aRestriction->like ( 'testColumn1', '%likeThis%' );
		$this->assertEquals ( "`testColumn1` LIKE '%likeThis%'", $aRestriction->makeStatement () );
	}
	
	public function testIn() {
		$aRestriction = new Restriction ();
		$aRestriction->in ( 'testColumn', array ('a', 'b', 'c', 1, 2, 3 ) );
		$this->assertEquals ( "`testColumn` IN ('a','b','c','1','2','3')", $aRestriction->makeStatement () );
	}
	
	public function testBetween() {
		$aRestriction = new Restriction ();
		$aRestriction->between ( 'testColumn', 'a', 'b' );
		$this->assertEquals ( "`testColumn` BETWEEN 'a' AND 'b'", $aRestriction->makeStatement () );
	}
	
	public function testIsNull() {
		$aRestriction = new Restriction ();
		$aRestriction->isNull ( 'testColumn' );
		$this->assertEquals ( "`testColumn` IS NULL", $aRestriction->makeStatement () );
	}
	
	public function testIsNotNull() {
		$aRestriction = new Restriction ();
		$aRestriction->isNotNull ( 'testColumn' );
		$this->assertEquals ( "`testColumn` IS NOT NULL", $aRestriction->makeStatement () );
	}
	
	public function testExpression() {
		$aRestriction = new Restriction ();
		$aRestriction->expression ( " 1 = 1 AND `testTable`.`testColumn` >= '1' ORDER BY `testTable`.`testColumn` " );
		$this->assertEquals ( " 1 = 1 AND `testTable`.`testColumn` >= '1' ORDER BY `testTable`.`testColumn` ", $aRestriction->makeStatement () );
	}
	
	public function testAdd() {
		$aRestriction1 = new Restriction ();
		$aRestriction1->eq ( 'eqColumn1', 'eqColumnValue1' );
		
		$aRestriction2 = new Restriction ();
		$aRestriction2->eq ( 'eqColumn2', 'eqColumnValue2' );
		
		$aRestriction1->add ( $aRestriction2 );
		//检验方法是否将刚创建的实例添加到调用者中
		$this->assertEquals ( "`eqColumn1` = 'eqColumnValue1' AND ( `eqColumn2` = 'eqColumnValue2' )", $aRestriction1->makeStatement () );
	}
	
	public function testCreateRestriction() {
		$aRestriction1 = new Restriction ();
		$aRestriction1->eq ( 'eqColumn1', 'eqColumnValue1' );
		
		$aRestriction2 = $aRestriction1->createRestriction ();
		$aRestriction2->eq ( 'eqColumn2', 'eqColumnValue2' );
		
		//检验方法是否正确创建了Restriction类型的实例并返回
		$this->assertType ( 'jc\db\sql\Restriction', $aRestriction2 );
		//检验方法是否将刚创建的实例添加到调用者中
		$this->assertEquals ( "`eqColumn1` = 'eqColumnValue1' AND ( `eqColumn2` = 'eqColumnValue2' )", $aRestriction1->makeStatement () );
	}
	
	//	public function test__clone() {
	//		$this->markTestIncomplete ( 'This test has not been implemented yet.' );
	//	}
	

	//	public function testSetDefaultTable() {
	//		$aRestriction = new Restriction ();
	//		$aRestriction->setDefaultTable ( 'testTable' );
	//		$this->assertEquals ( '`testTable`', $aRestriction->defaultTable () );
	//		$aRestriction->setDefaultTable ( '`testTable`' );
	//		$this->assertEquals ( '`testTable`', $aRestriction->defaultTable () );
	//	}
	//	
	//	public function testDefaultTable() {
	//		$aRestriction = new Restriction ();
	//		$this->assertEquals ( '', $aRestriction->defaultTable () );
	//	}
	

	/**
	 * 使用反射机制测试protected transColumn方法
	 */
	public function testTransColumn() {
		$aReflectionMethod = new \ReflectionMethod ( 'jc\db\sql\Restriction', 'transColumn' );
		$aReflectionMethod->setAccessible ( true );
		$this->assertEquals ( "`testColumn`", $aReflectionMethod->invokeArgs ( new Restriction (), array ('testColumn' ) ) );
		$this->assertEquals ( "`testColumn`", $aReflectionMethod->invokeArgs ( new Restriction (), array ('`testColumn`' ) ) );
		$this->assertEquals ( "`123`", $aReflectionMethod->invokeArgs ( new Restriction (), array (123 ) ) );
	}
	
	/**
	 * 使用反射机制测试protected tranValue方法
	 */
	public function testTranValue() {
		$aReflectionMethod = new \ReflectionMethod ( 'jc\db\sql\Restriction', 'tranValue' );
		$aReflectionMethod->setAccessible ( true );
		$this->assertEquals ( "'1'", $aReflectionMethod->invokeArgs ( new Restriction (), array (true ) ) );
		$this->assertEquals ( "'0'", $aReflectionMethod->invokeArgs ( new Restriction (), array (false ) ) );
		$this->assertEquals ( "'show'", $aReflectionMethod->invokeArgs ( new Restriction (), array ('show' ) ) );
		$this->assertEquals ( "'10'", $aReflectionMethod->invokeArgs ( new Restriction (), array (10 ) ) );
		$this->assertEquals ( "null", $aReflectionMethod->invokeArgs ( new Restriction (), array (null ) ) );
	}
	
	/**
	 * 使用反射机制测试private makeSureBackQuote方法
	 */
	public function testMakeSureBackQuote() {
		$aReflectionMethod = new \ReflectionMethod ( 'jc\db\sql\Restriction', 'makeSureBackQuote' );
		$aReflectionMethod->setAccessible ( true );
		$this->assertEquals ( "`testColumn`", $aReflectionMethod->invokeArgs ( new Restriction (), array ('testColumn' ) ) );
		$this->assertEquals ( "`testColumn`", $aReflectionMethod->invokeArgs ( new Restriction (), array ('`testColumn`' ) ) );
		$this->assertEquals ( "`123`", $aReflectionMethod->invokeArgs ( new Restriction (), array (123 ) ) );
	}
}
?>
