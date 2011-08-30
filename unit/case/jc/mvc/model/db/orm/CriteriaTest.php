<?php
namespace jc\test\unit\testcase\jc\mvc\model\db\orm;


use jc\mvc\model\db\orm\Criteria ;

/**
 * Test class for jc\mvc\model\db\orm\Criteria.
 * @for jc\mvc\model\db\orm\Criteria
 */
class CriteriaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\mvc\model\db\orm\Criteria
     */
    protected $aCriteria;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
//        $this->aCriteria = new Criteria ;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

	public function testMakeStatement() {
		$aCriteria = new Criteria ();
		$aCriteria->setDefaultTable('testTable');
		$aCriteria->eqColumn ( 'testColumn1', 'testColumn2' )
		->neColumn ( 'testColumn1', 'testColumn2' )
		->eq ( 'testColumn', 11 )
		->in ( 'testColumn', array ('a', 'b', 'c', 1, 2, 3 ) )
		->isNotNull ( 'testColumn' )
		->expression ( " 1 = 1 AND `testTable`.`testColumn` >= '1' ORDER BY `testTable`.`testColumn` " );
		$aCriteria1 = new Criteria();
//		$aCriteria1->setDefaultTable('testTable1');
		$aCriteria1->eq ( 'testColumn1', 111 )->in ( 'testColumn', array ('a', 'b', 'c', 1, 2, 3 ) );
		$aCriteria->add($aCriteria1);
		$this->assertEquals("`testTable`.`testColumn1` = `testTable`.`testColumn2` ".
		"AND `testTable`.`testColumn1` <> `testTable`.`testColumn2` AND `testTable`.`testColumn` = '11' ".
		"AND `testTable`.`testColumn` IN ('a','b','c','1','2','3') AND `testTable`.`testColumn` IS NOT NULL ".
		"AND  1 = 1 AND `testTable`.`testColumn` >= '1' ORDER BY `testTable`.`testColumn`  AND ( testColumn1 = '111' ".
		"AND testColumn IN ('a','b','c','1','2','3') )", $aCriteria->makeStatement() ) ;
	}
    
//    public function testSetDefaultTable()
//    {
//		$aCriteria = new Criteria ();
//		$aCriteria->setDefaultTable ( 'testTable' );
//		$this->assertEquals ( '`testTable`', $aCriteria->defaultTable () );
//		$aCriteria->setDefaultTable ( '`testTable`' );
//		$this->assertEquals ( '`testTable`', $aCriteria->defaultTable () );
//    }
//
//    public function testDefaultTable()
//    {
//		$aCriteria = new Criteria ();
//		$this->assertEquals ( '', $aCriteria->defaultTable () );
//		$this->testSetDefaultTable();
//    }
    
//    public function testTransColumn(){
//    	$aReflectionMethod = new \ReflectionMethod ( 'jc\mvc\model\db\orm\Criteria', 'transColumn' );
//		$aReflectionMethod->setAccessible ( true );
//		$this->assertEquals ( "`testColumn`", $aReflectionMethod->invokeArgs ( new Criteria (), array ('testColumn' ) ) );
//    }
}
?>
