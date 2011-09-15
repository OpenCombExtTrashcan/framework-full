<?php
namespace jc\test\unit\testcase\jc\db\sql;

use jc\db\sql\Criteria;

/**
 * Test class for jc\db\sql\Criteria.
 * @for jc\db\sql\Criteria
 */
class CriteriaTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @var jc\db\sql\Criteria
	 */
	protected $aCriteria;
	
	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		//        $this->aCriteria = new Criteria ;
	}
	
	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
	}
	
	public function testMakeStatement() {
		$aCriteria = new Criteria ();
		
		$aCriteria->eqColumn ( 'testColumn1', 'testColumn2' )
		->neColumn ( 'testColumn1', 'testColumn2' )
		->eq ( 'testColumn', 11 )
		->in ( 'testColumn', array ('a', 'b', 'c', 1, 2, 3 ) )
		->isNotNull ( 'testColumn' )
		->expression ( " 1 = 1 AND `testTable`.`testColumn` >= '1' ORDER BY `testTable`.`testColumn` " );
		$aCriteria1 = new Criteria();
		$aCriteria1->eq ( 'testColumn1', 111 )->in ( 'testColumn', array ('a', 'b', 'c', 1, 2, 3 ) );
		$aCriteria->add($aCriteria1);
		$this->assertEquals("`testColumn1` = `testColumn2` AND `testColumn1` <> `testColumn2` AND `testColumn` = '11' ".
		"AND `testColumn` IN ('a','b','c','1','2','3') AND `testColumn` IS NOT NULL AND  1 = 1 ".
		"AND `testTable`.`testColumn` >= '1' ORDER BY `testTable`.`testColumn`  AND ( `testColumn1` = '111' ".
		"AND `testColumn` IN ('a','b','c','1','2','3') )", $aCriteria->makeStatement() ) ;
	}
	
//	/**
//	 * @todo Implement testCheckValid().
//	 */
//	public function testCheckValid() {
//		// Remove the following lines when you implement this test.
//		$this->markTestIncomplete ( 'This test has not been implemented yet.' );
//	}
	
	public function testLogic() {
		$aCriteria = new Criteria ();
		$aCriteria->setLogic ( false );
		$this->assertFalse ( $aCriteria->logic () );
		$aCriteria->setLogic ( true );
		$this->assertTrue ( $aCriteria->logic () );
	}
	
	public function testSetLogic() {
		$this->testLogic ();
	}
	
	public function testClear() {
		$aCriteria = new Criteria ();
		$aCriteria->eq ( 'testColumn', 11 );
		$aCriteria->expression ( "`testColumn` = 11" );
		$this->assertEquals ( "`testColumn` = '11' AND `testColumn` = 11", $aCriteria->makeStatement () );
		$aCriteria->clear ();
		$this->assertEquals ( "", $aCriteria->makeStatement () );
	}
	
	public function testEq() {
		$aCriteria = new Criteria ();
		$aCriteria->eq ( 'testColumn', 11 );
		$this->assertEquals ( "`testColumn` = '11'", $aCriteria->makeStatement () );
	}
	
	public function testEqColumn() {
		$aCriteria = new Criteria ();
		$aCriteria->eqColumn ( 'testColumn1', 'testColumn2' );
		$this->assertEquals ( "`testColumn1` = `testColumn2`", $aCriteria->makeStatement () );
	}
	
	public function testNe() {
		$aCriteria = new Criteria ();
		$aCriteria->ne ( 'testColumn1', '12' );
		$this->assertEquals ( "`testColumn1` <> '12'", $aCriteria->makeStatement () );
	}
	
	public function testNeColumn() {
		$aCriteria = new Criteria ();
		$aCriteria->neColumn ( 'testColumn1', 'testColumn2' );
		$this->assertEquals ( "`testColumn1` <> `testColumn2`", $aCriteria->makeStatement () );
	}
	
	public function testGt() {
		$aCriteria = new Criteria ();
		$aCriteria->gt ( 'testColumn1', '12' );
		$this->assertEquals ( "`testColumn1` > '12'", $aCriteria->makeStatement () );
	}
	
	public function testGtColumn() {
		$aCriteria = new Criteria ();
		$aCriteria->gtColumn ( 'testColumn1', 'testColumn2' );
		$this->assertEquals ( "`testColumn1` > `testColumn2`", $aCriteria->makeStatement () );
	}
	
	public function testGe() {
		$aCriteria = new Criteria ();
		$aCriteria->ge ( 'testColumn1', '12' );
		$this->assertEquals ( "`testColumn1` >= '12'", $aCriteria->makeStatement () );
	}
	
	public function testGeColumn() {
		$aCriteria = new Criteria ();
		$aCriteria->geColumn ( 'testColumn1', 'testColumn2' );
		$this->assertEquals ( "`testColumn1` >= `testColumn2`", $aCriteria->makeStatement () );
	}
	
	public function testLt() {
		$aCriteria = new Criteria ();
		$aCriteria->lt ( 'testColumn1', '12' );
		$this->assertEquals ( "`testColumn1` < '12'", $aCriteria->makeStatement () );
	}
	
	public function testLtColumn() {
		$aCriteria = new Criteria ();
		$aCriteria->ltColumn ( 'testColumn1', 'testColumn2' );
		$this->assertEquals ( "`testColumn1` < `testColumn2`", $aCriteria->makeStatement () );
	}
	
	public function testLe() {
		$aCriteria = new Criteria ();
		$aCriteria->le ( 'testColumn1', '12' );
		$this->assertEquals ( "`testColumn1` <= '12'", $aCriteria->makeStatement () );
	}
	
	public function testLeColumn() {
		$aCriteria = new Criteria ();
		$aCriteria->leColumn ( 'testColumn1', 'testColumn2' );
		$this->assertEquals ( "`testColumn1` <= `testColumn2`", $aCriteria->makeStatement () );
	}
	
	public function testLike() {
		$aCriteria = new Criteria ();
		$aCriteria->like ( 'testColumn1', '%likeThis%' );
		$this->assertEquals ( "`testColumn1` LIKE '%likeThis%'", $aCriteria->makeStatement () );
	}
	
	public function testIn() {
		$aCriteria = new Criteria ();
		$aCriteria->in ( 'testColumn', array ('a', 'b', 'c', 1, 2, 3 ) );
		$this->assertEquals ( "`testColumn` IN ('a','b','c','1','2','3')", $aCriteria->makeStatement () );
	}
	
	public function testBetween() {
		$aCriteria = new Criteria ();
		$aCriteria->between ( 'testColumn', 'a', 'b' );
		$this->assertEquals ( "`testColumn` BETWEEN 'a' AND 'b'", $aCriteria->makeStatement () );
	}
	
	public function testIsNull() {
		$aCriteria = new Criteria ();
		$aCriteria->isNull ( 'testColumn' );
		$this->assertEquals ( "`testColumn` IS NULL", $aCriteria->makeStatement () );
	}
	
	public function testIsNotNull() {
		$aCriteria = new Criteria ();
		$aCriteria->isNotNull ( 'testColumn' );
		$this->assertEquals ( "`testColumn` IS NOT NULL", $aCriteria->makeStatement () );
	}
	
	public function testExpression() {
		$aCriteria = new Criteria ();
		$aCriteria->expression ( " 1 = 1 AND `testTable`.`testColumn` >= '1' ORDER BY `testTable`.`testColumn` " );
		$this->assertEquals ( " 1 = 1 AND `testTable`.`testColumn` >= '1' ORDER BY `testTable`.`testColumn` ", $aCriteria->makeStatement () );
	}
	
	public function testAdd() {
		$aCriteria1 = new Criteria ();
		$aCriteria1->eq ( 'eqColumn1', 'eqColumnValue1' );
		
		$aCriteria2 = new Criteria ();
		$aCriteria2->eq ( 'eqColumn2', 'eqColumnValue2' );
		
		$aCriteria1->add ( $aCriteria2 );
		//检验方法是否将刚创建的实例添加到调用者中
		$this->assertEquals ( "`eqColumn1` = 'eqColumnValue1' AND ( `eqColumn2` = 'eqColumnValue2' )", $aCriteria1->makeStatement () );
	}
	
	public function testCreateCriteria() {
		$aCriteria1 = new Criteria ();
		$aCriteria1->eq ( 'eqColumn1', 'eqColumnValue1' );
		
		$aCriteria2 = $aCriteria1->createCriteria ();
		$aCriteria2->eq ( 'eqColumn2', 'eqColumnValue2' );
		
		//检验方法是否正确创建了Criteria类型的实例并返回
		$this->assertType ( 'jc\db\sql\Criteria', $aCriteria2 );
		//检验方法是否将刚创建的实例添加到调用者中
		$this->assertEquals ( "`eqColumn1` = 'eqColumnValue1' AND ( `eqColumn2` = 'eqColumnValue2' )", $aCriteria1->makeStatement () );
	}
	
	//	public function test__clone() {
	//		$this->markTestIncomplete ( 'This test has not been implemented yet.' );
	//	}
	

	//	public function testSetDefaultTable() {
	//		$aCriteria = new Criteria ();
	//		$aCriteria->setDefaultTable ( 'testTable' );
	//		$this->assertEquals ( '`testTable`', $aCriteria->defaultTable () );
	//		$aCriteria->setDefaultTable ( '`testTable`' );
	//		$this->assertEquals ( '`testTable`', $aCriteria->defaultTable () );
	//	}
	//	
	//	public function testDefaultTable() {
	//		$aCriteria = new Criteria ();
	//		$this->assertEquals ( '', $aCriteria->defaultTable () );
	//	}
	

	/**
	 * 使用反射机制测试protected transColumn方法
	 */
	public function testTransColumn() {
		$aReflectionMethod = new \ReflectionMethod ( 'jc\db\sql\Criteria', 'transColumn' );
		$aReflectionMethod->setAccessible ( true );
		$this->assertEquals ( "`testColumn`", $aReflectionMethod->invokeArgs ( new Criteria (), array ('testColumn' ) ) );
		$this->assertEquals ( "`testColumn`", $aReflectionMethod->invokeArgs ( new Criteria (), array ('`testColumn`' ) ) );
		$this->assertEquals ( "`123`", $aReflectionMethod->invokeArgs ( new Criteria (), array (123 ) ) );
	}
	
	/**
	 * 使用反射机制测试protected tranValue方法
	 */
	public function testTranValue() {
		$aReflectionMethod = new \ReflectionMethod ( 'jc\db\sql\Criteria', 'tranValue' );
		$aReflectionMethod->setAccessible ( true );
		$this->assertEquals ( "'1'", $aReflectionMethod->invokeArgs ( new Criteria (), array (true ) ) );
		$this->assertEquals ( "'0'", $aReflectionMethod->invokeArgs ( new Criteria (), array (false ) ) );
		$this->assertEquals ( "'show'", $aReflectionMethod->invokeArgs ( new Criteria (), array ('show' ) ) );
		$this->assertEquals ( "'10'", $aReflectionMethod->invokeArgs ( new Criteria (), array (10 ) ) );
		$this->assertEquals ( "null", $aReflectionMethod->invokeArgs ( new Criteria (), array (null ) ) );
	}
	
	/**
	 * 使用反射机制测试private makeSureBackQuote方法
	 */
	public function testMakeSureBackQuote() {
		$aReflectionMethod = new \ReflectionMethod ( 'jc\db\sql\Criteria', 'makeSureBackQuote' );
		$aReflectionMethod->setAccessible ( true );
		$this->assertEquals ( "`testColumn`", $aReflectionMethod->invokeArgs ( new Criteria (), array ('testColumn' ) ) );
		$this->assertEquals ( "`testColumn`", $aReflectionMethod->invokeArgs ( new Criteria (), array ('`testColumn`' ) ) );
		$this->assertEquals ( "`123`", $aReflectionMethod->invokeArgs ( new Criteria (), array (123 ) ) );
	}
}
?>
