<?php
namespace jc\test\unit\testcase\jc\pattern\iterate;

use jc\pattern\iterate\ArrayIterator;
use jc\pattern\iterate\ReveseIterator;

/**
 * Test class for jc\pattern\iterate\ReveseIterator.
 * @for jc\pattern\iterate\ReveseIterator
 */
class ReveseIteratorTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @var jc\pattern\iterate\ReveseIterator
	 */
	protected $aReveseIterator;
	
	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->testArrayNum = array (1, 2, 3, 4, 5 );
		//使用jecat的arrayIterator
		$this->testArrayNumIterator = new ArrayIterator ( $this->testArrayNum );
		
		$this->testArrayLetter = array ( 'a','b','c','d','e' );
		$this->testArrayLetterIterator = new ArrayIterator ( $this->testArrayLetter );
		$this->testArrayLetterIterator->next();
		$this->testArrayLetterIterator->next();
	}
	
	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}
	
	public function testNext() {
		//创建测试用的ReveseIterator实例
		$testNumReveseIterator = new ReveseIterator($this->testArrayNumIterator);
		$this->assertTrue( $testNumReveseIterator->valid());
		$this->assertEquals( 1 , $testNumReveseIterator->current());
		$testNumReveseIterator->rewind();
		$this->assertTrue( $testNumReveseIterator->valid());
		$this->assertEquals( 5 , $testNumReveseIterator->current());
		$testNumReveseIterator->next() ;
		$this->assertTrue( $testNumReveseIterator->valid());
		$this->assertEquals( 4 , $testNumReveseIterator->current());
		$testNumReveseIterator->next() ;
		$this->assertTrue( $testNumReveseIterator->valid());
		$this->assertEquals( 3 , $testNumReveseIterator->current());
		$testNumReveseIterator->next() ;
		$this->assertTrue( $testNumReveseIterator->valid());
		$this->assertEquals( 2 , $testNumReveseIterator->current());
		$testNumReveseIterator->next() ;
		$this->assertTrue( $testNumReveseIterator->valid());
		$this->assertEquals( 1 , $testNumReveseIterator->current());
		$testNumReveseIterator->next() ;
		$this->assertfalse( $testNumReveseIterator->valid());
		$this->assertNull($testNumReveseIterator->current());
		
		$testLetterReveseIterator = new ReveseIterator($this->testArrayLetterIterator);
		$this->assertTrue( $testLetterReveseIterator->valid());
		$this->assertEquals( 'c' , $testLetterReveseIterator->current());
		$testLetterReveseIterator->rewind();
		$this->assertTrue( $testLetterReveseIterator->valid());
		$this->assertEquals( 'e' , $testLetterReveseIterator->current());
		$testLetterReveseIterator->next() ;
		$this->assertTrue( $testLetterReveseIterator->valid());
		$this->assertEquals( 'd' , $testLetterReveseIterator->current());
		$testLetterReveseIterator->next() ;
		$this->assertTrue( $testLetterReveseIterator->valid());
		$this->assertEquals( 'c' , $testLetterReveseIterator->current());
		$testLetterReveseIterator->next() ;
		$this->assertTrue( $testLetterReveseIterator->valid());
		$this->assertEquals( 'b' , $testLetterReveseIterator->current());
		$testLetterReveseIterator->next() ;
		$this->assertTrue( $testLetterReveseIterator->valid());
		$this->assertEquals( 'a' , $testLetterReveseIterator->current());
		$testLetterReveseIterator->next() ;
		$this->assertfalse( $testLetterReveseIterator->valid());
		$this->assertNull($testLetterReveseIterator->current());
		
	}
	
	public function testPrev() {
		//创建测试用的ReveseIterator实例
		$testNumReveseIterator = new ReveseIterator($this->testArrayNumIterator);
		$this->assertTrue( $testNumReveseIterator->valid());
		$this->assertEquals( 1 , $testNumReveseIterator->current());
		$testNumReveseIterator->prev() ;
		$this->assertTrue( $testNumReveseIterator->valid());
		$this->assertEquals( 2 , $testNumReveseIterator->current());
		$testNumReveseIterator->last() ;
		$this->assertTrue( $testNumReveseIterator->valid());
		$this->assertEquals( 1 , $testNumReveseIterator->current());
		$testNumReveseIterator->prev() ;
		$this->assertTrue( $testNumReveseIterator->valid());
		$this->assertEquals( 2 , $testNumReveseIterator->current());
		$testNumReveseIterator->prev() ;
		$this->assertTrue( $testNumReveseIterator->valid());
		$this->assertEquals( 3 , $testNumReveseIterator->current());
		$testNumReveseIterator->prev() ;
		$this->assertTrue( $testNumReveseIterator->valid());
		$this->assertEquals( 4 , $testNumReveseIterator->current());
		$testNumReveseIterator->prev() ;
		$this->assertTrue( $testNumReveseIterator->valid());
		$this->assertEquals( 5 , $testNumReveseIterator->current());
		$testNumReveseIterator->prev() ;
		$this->assertfalse( $testNumReveseIterator->valid());
		$this->assertNull($testNumReveseIterator->current());
		
		$testLetterReveseIterator = new ReveseIterator($this->testArrayLetterIterator);
		$this->assertTrue( $testLetterReveseIterator->valid());
		$this->assertEquals( 'c' , $testLetterReveseIterator->current());
		$testLetterReveseIterator->prev() ;
		$this->assertTrue( $testLetterReveseIterator->valid());
		$this->assertEquals( 'd' , $testLetterReveseIterator->current());
		$testLetterReveseIterator->last() ;
		$this->assertTrue( $testLetterReveseIterator->valid());
		$this->assertEquals( 'a' , $testLetterReveseIterator->current());
		$testLetterReveseIterator->prev() ;
		$this->assertTrue( $testLetterReveseIterator->valid());
		$this->assertEquals( 'b' , $testLetterReveseIterator->current());
		$testLetterReveseIterator->prev() ;
		$this->assertTrue( $testLetterReveseIterator->valid());
		$this->assertEquals( 'c' , $testLetterReveseIterator->current());
		$testLetterReveseIterator->prev() ;
		$this->assertTrue( $testLetterReveseIterator->valid());
		$this->assertEquals( 'd' , $testLetterReveseIterator->current());
		$testLetterReveseIterator->prev() ;
		$this->assertTrue( $testLetterReveseIterator->valid());
		$this->assertEquals( 'e' , $testLetterReveseIterator->current());
		$testLetterReveseIterator->prev() ;
		$this->assertfalse( $testLetterReveseIterator->valid());
		$this->assertNull($testLetterReveseIterator->current());
	}
}
?>
