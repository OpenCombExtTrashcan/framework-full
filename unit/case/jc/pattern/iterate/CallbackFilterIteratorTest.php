<?php
namespace jc\test\unit\testcase\jc\pattern\iterate;

use jc\pattern\iterate\ArrayIterator;
use jc\pattern\iterate\CallbackFilterIterator ;

/**
 * Test class for jc\pattern\iterate\CallbackFilterIterator.
 * @for jc\pattern\iterate\CallbackFilterIterator
 */
class CallbackFilterIteratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\pattern\iterate\CallbackFilterIterator
     */
    protected $aCallbackFilterIterator;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    	$this->testArray = array (1, 2, 3, 4, 5 );
		//使用jecat的arrayIterator
		$this->testArrayIterator = new ArrayIterator( $this->testArray );
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
    
	public function testAddCallback()
    {
    	//创建一个CallbackFilterIterator实例,添加一个noOdd回调函数来过滤目标数组迭代器
    	$aCallbackFilterIterator = new CallbackFilterIterator($this->testArrayIterator ,'jc\test\unit\testcase\jc\pattern\iterate\noOdd');
    	$this->assertTrue($aCallbackFilterIterator->valid());
    	$this->assertEquals( 2 , $aCallbackFilterIterator->current());
    	$aCallbackFilterIterator->next();
    	$this->assertTrue($aCallbackFilterIterator->valid());
    	$this->assertEquals( 4 , $aCallbackFilterIterator->current());
    	$aCallbackFilterIterator->next();
    	$this->assertFalse($aCallbackFilterIterator->valid());
    	$this->assertNull( $aCallbackFilterIterator->current() );
    	
    	//实现一个函数变量 , 函数的功能是不允许偶数
    	$noEven = function(\Iterator $aIterator){
	    	if($aIterator->current() % 2 === 0){
				return false;
			}else{
				return true;
			}
		};
		
    	$aCallbackFilterIterator->addCallback($noEven);
    	//现在2个过滤器把数组中所有数组都过滤掉了,迭代器应该没有符合条件的元素了
    	$aCallbackFilterIterator->rewind() ;
    	$this->assertFalse($aCallbackFilterIterator->valid());
    	$aCallbackFilterIterator->next();
    	$this->assertFalse($aCallbackFilterIterator->valid());
    	$aCallbackFilterIterator->next();
    	$this->assertFalse($aCallbackFilterIterator->valid());
    	$aCallbackFilterIterator->next();
    	$this->assertFalse($aCallbackFilterIterator->valid());
    	$aCallbackFilterIterator->rewind();
    	$this->assertFalse($aCallbackFilterIterator->valid());
    	$aCallbackFilterIterator->next();
    	$this->assertFalse($aCallbackFilterIterator->valid());
    	$aCallbackFilterIterator->next();
    	$this->assertFalse($aCallbackFilterIterator->valid());
    	$this->assertNull( $aCallbackFilterIterator->current() );
    	
    	//尝试删除一个callback函数
    	$aCallbackFilterIterator->removeCallback($noEven);
    	$aCallbackFilterIterator->rewind() ;
    	$this->assertTrue($aCallbackFilterIterator->valid());
    	$this->assertEquals( 2 , $aCallbackFilterIterator->current());
    	$aCallbackFilterIterator->next();
    	$this->assertTrue($aCallbackFilterIterator->valid());
    	$this->assertEquals( 4 , $aCallbackFilterIterator->current());
    	$aCallbackFilterIterator->next();
    	$this->assertFalse($aCallbackFilterIterator->valid());
    	$this->assertNull( $aCallbackFilterIterator->current() );
    	
    	
    	//测试clearcallback函数
    	$aCallbackFilterIterator->rewind() ;
    	$this->assertTrue($aCallbackFilterIterator->valid());
    	$this->assertEquals( 2 , $aCallbackFilterIterator->current());
    	
    	$aCallbackFilterIterator->clearCallback();
    	
    	$aCallbackFilterIterator->next();
    	$this->assertTrue($aCallbackFilterIterator->valid());
    	$this->assertEquals( 3 , $aCallbackFilterIterator->current());
    	$aCallbackFilterIterator->next();
    	$this->assertTrue($aCallbackFilterIterator->valid());
    	$this->assertEquals( 4 , $aCallbackFilterIterator->current());
    	
    	//加上非偶过滤器
    	$aCallbackFilterIterator->addCallback($noEven);
    	$aCallbackFilterIterator->next();
    	$this->assertEquals( 5 , $aCallbackFilterIterator->current());
    	$aCallbackFilterIterator->next();
    	$this->assertFalse($aCallbackFilterIterator->valid());
    	$this->assertNull( $aCallbackFilterIterator->current() );
    }
}

//测试公共函数作回调函数 , 不许出现奇数
function noOdd( \Iterator $aIterator ){
	if($aIterator->current() % 2 === 1){
		return false;
	}else{
		return true;
	}
}
?>
