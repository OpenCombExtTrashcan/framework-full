<?php
namespace jc\test\unit\testcase\jc\db\sql;


use jc\db\sql\Restriction;
use jc\db\sql\Order;
use jc\db\sql\Criteria ;

/**
 * Test class for jc\db\sql\Criteria.
 * @for jc\db\sql\Criteria
 */
class CriteriaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\db\sql\Criteria
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

    public function testMakeStatement()
    {
    	$aCriteria = new Criteria();
        
        //设置条件
    	$aCriteria->restriction()->eq('testR1', 'testR1');
    	$aCriteria->restriction()->expression('testR2 = testR2');
    	
    	//设置order
    	$aCriteria->order()->addColumn('testAsc' );
    	$aCriteria->order()->addColumn('testDesc' ,false);
    	
    	//设置limit
    	$aCriteria->setEnableLimitStart(true);
    	$aCriteria->setLimit(4 , 1);
    	$this->assertEquals(' LIMIT 1,4', $aCriteria->limit());
    	
    	$this->assertEquals("`testR1` = 'testR1' AND testR2 = testR2  ORDER BY testAsc ASC,testDesc DESC  LIMIT 1,4" , $aCriteria->makeStatement() );
    }

//    public function testCheckValid()
//    {
//    }

    /**
     * @see testSetLimit().
     */
    public function testSetEnableLimitStart()
    {
    	$this->testSetLimit();
    }

    public function testSetLimit()
    {
    	//只设置limit length 的情况
    	$aCriteria = new Criteria();
    	$aCriteria->setLimit(4);
    	$this->assertEquals(' LIMIT 4', $aCriteria->limit());
    	
    	//设置limit区间的情况,需要先打开limit from 开关
    	$aCriteria = new Criteria();
    	$aCriteria->setEnableLimitStart(true);
    	$aCriteria->setLimit(4 , 1);
    	$this->assertEquals(' LIMIT 1,4', $aCriteria->limit());
    	
    	//在没有打开limit from开关的情况下设置Limit from,会引发异常
    	$aCriteria = new Criteria();
    	$this->setExpectedException('jc\lang\Exception');
    	$aCriteria->setLimit(4 , 1);
    }

    /**
     * @see testSetLimit().
     */
    public function testLimit()
    {
    	$this->testSetLimit();
    }

    /**
     * @see testSetLimit().
     */
    public function testSetLimitFrom()
    {
    	$this->testSetLimit();
    }

    /**
     * @see testSetLimit().
     */
    public function testSetLimitLen()
    {
    	$this->testSetLimit();
    }

    public function testSetRestriction()
    {
    	$aRestriction = new Restriction();
    	$aRestriction->eq('test', 'test');
    	
    	$aCriteria = new Criteria();
    	$aCriteria->setRestriction($aRestriction);
    	$aGotRestriction = $aCriteria->restriction();
    	
    	$this->assertTrue($aGotRestriction === $aRestriction);
    	
    }

    /**
     * @see testSetRestriction()
     */
    public function testRestriction()
    {
    	$this->testSetRestriction();
    }

    public function testSetOrder()
    {
    	$aOrder = new Order('testSetOrder');
        $aCriteria = new Criteria();
        $aCriteria->setOrder($aOrder);
        $aGotOrder = $aCriteria->order();
        
        $this->assertTrue($aOrder === $aGotOrder);
    }

    /**
     * @see testSetOrder()
     */
    public function testOrder()
    {
    	$this->testSetOrder();
    }
}
?>
