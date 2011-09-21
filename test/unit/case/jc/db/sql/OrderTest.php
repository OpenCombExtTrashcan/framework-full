<?php
namespace jc\test\unit\testcase\jc\db\sql;


use jc\db\sql\Order ;

/**
 * Test class for jc\db\sql\Order.
 * @for jc\db\sql\Order
 */
class OrderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\db\sql\Order
     */
    protected $aOrder;

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

    public function testAsc()
    {
    	//以列名为参数,使用静态方法获得一个Order对象,升序排列
        $aOrder = Order::asc('test');
    	$this->assertEquals(' ORDER BY test ASC', $aOrder->makeStatement() );
    }

    public function testDecs()
    {
    	//以列名为参数,使用静态方法获得一个Order对象,降序排列
    	$aOrder = Order::decs('test');
    	$this->assertEquals(' ORDER BY test DESC', $aOrder->makeStatement() );
    }

    public function testAddColumn()
    {
        $aOrder = new Order() ;
        $aOrder->addColumn('test1' , true);
    	$this->assertEquals(' ORDER BY test1 ASC', $aOrder->makeStatement() );
    	$aOrder->addColumn('test2' , false);
    	$this->assertEquals(' ORDER BY test1 ASC,test2 DESC', $aOrder->makeStatement() );
    }

    public function testRemoveColumn()
    {
        $aOrder = new Order() ;
        $aOrder->addColumn('test1' , true);
    	$aOrder->addColumn('test2' , false);
    	
    	//使用列名移除一个列
    	$aOrder->removeColumn('test2');
    	
    	$aIter = $aOrder->iterator();
    	$this->assertEquals(1, $aIter->count());
    	$arr = $aIter->current();
    	$this->assertEquals('test1', $arr[0]);
    	
    	//使用列名移除一个列
    	$aOrder->removeColumn('test1');
    	$aIter = $aOrder->iterator();
    	$this->assertEquals(0, $aIter->count());
    }

    public function testClearColumns()
    {
        $aOrder = new Order('test',false);
        $aOrder->addColumn('test1' , true);
    	$aOrder->addColumn('test2' , false);
    	$aOrder->clearColumns();
    	
    	$aIter = $aOrder->iterator();
    	$this->assertEquals(0, $aIter->count());
    }

    public function testIterator()
    {
        $aOrder = new Order('test',false);
        $aOrder->addColumn('test1' , true);
    	$aOrder->addColumn('test2' , false);
    	//获得迭代器
    	$aIter = $aOrder->iterator();
    	
		$arr = $aIter->current();
    	$this->assertEquals('test', $arr[0]);
    	$this->assertEquals('DESC', $arr[1]);
    	
    	$aIter->next();
    	$arr = $aIter->current();
    	$this->assertEquals('test1', $arr[0]);
    	$this->assertEquals('ASC', $arr[1]);
    	
    	$aIter->next();
    	$arr = $aIter->current();
    	$this->assertEquals('test2', $arr[0]);
    	$this->assertEquals('DESC', $arr[1]);
    	
    	$aIter->next();
    	$this->assertFalse($aIter->valid());
    }

    public function testMakeStatement()
    {
    	$aOrder = new Order('test',false);
        $aOrder->addColumn('test1');
    	$aOrder->addColumn('test2' , false);
    	
    	$this->assertEquals(' ORDER BY test DESC,test1 ASC,test2 DESC', $aOrder->makeStatement());
    }

//    public function testCheckValid()
//    {
//    }
}
?>
