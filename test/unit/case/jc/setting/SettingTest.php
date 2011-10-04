<?php
namespace jc\test\unit\testcase\jc\setting;

use jc\setting\Setting;
use jc\test\unit\testcase\jc\setting\SettingClassForTest;

/**
 * Test class for jc\setting\Setting.
 * @for jc\setting\Setting
 */
class SettingTest extends \PHPUnit_Framework_TestCase
{
	
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
	
	public function testKeyIterator()
	{
	}
	
	public function testItemIterator()
	{
		$aSetting = new SettingClassForTest ();
		
		$aSetting->setItem ( 'testPath', 'testName1', 'testValue1' );
		$aSetting->setItem ( 'testPath', 'testName2', 1 );
		$aSetting->setItem ( 'testPath', 'testName3', false );
		
		//获得迭代器
		$aIter = $aSetting->itemIterator('testPath');
		
		$this->assertEquals ( 'testName1', $aIter->current () );
		$aIter->next ();
		$this->assertEquals ( 'testName2', $aIter->current () );
		$aIter->next ();
		$this->assertEquals ( 'testName3', $aIter->current () );
	}
	
	public function testItem()
	{
		$aSetting = new SettingClassForTest ();
		
		$aSetting->setItem ( 'testPath', 'testName1', 'testValue1' );
		$aSetting->setItem ( 'testPath', 'testName2', 1 );
		$aSetting->setItem ( 'testPath', 'testName3', false );
		
		//取已存在的想的值
		$this->assertEquals( 'testValue1', $aSetting->item('testPath','testName1' , 'defaultValue'));
		$this->assertEquals( 1, $aSetting->item('testPath','testName2'));
		$this->assertEquals( false, $aSetting->item('testPath','testName3'));
		
		//取不存在的值
		$this->assertNull($aSetting->item('testPath','testName4'));
		
		//取不存在的值,带默认值
		$this->assertEquals('defaultValue' , $aSetting->item('testPath','testName4','defaultValue'));
		
		//带默认值取不存在的值以后,那个值就存在了
		$this->assertEquals('defaultValue', $aSetting->item('testPath','testName4'));
	}
	
	/**
	 * @see testItem()
	 */
	public function testSetItem()
	{
		$this->testItem();
	}
	
	public function testHasItem()
	{
		$aSetting = new SettingClassForTest ();
		
		$aSetting->setItem ( 'testPath', 'testName1', 'testValue1' );
		$aSetting->setItem ( 'testPath', 'testName2', 1 );
		$aSetting->setItem ( 'testPath', 'testName3', false );
		
		//存在项
		$this->assertTrue($aSetting->hasItem('testPath', 'testName1'));
		$this->assertTrue($aSetting->hasItem('testPath', 'testName2'));
		$this->assertTrue($aSetting->hasItem('testPath', 'testName3'));
		
		//不存在的项
		$this->assertFalse($aSetting->hasItem('testPath', 'testName4'));
	}
	
	public function testDeleteItem()
	{
		$aSetting = new SettingClassForTest ();
		
		$aSetting->setItem ( 'testPath', 'testName1', 'testValue1' );
		$aSetting->setItem ( 'testPath', 'testName2', 1 );
		$aSetting->setItem ( 'testPath', 'testName3', false );
		
		//删除项
		$aSetting->deleteItem('testPath', 'testName1');
		$aSetting->deleteItem('testPath', 'testName2');
		$aSetting->deleteItem('testPath', 'testName3');
		
		//不存在的项
		$this->assertFalse($aSetting->hasItem('testPath', 'testName1'));
		$this->assertFalse($aSetting->hasItem('testPath', 'testName2'));
		$this->assertFalse($aSetting->hasItem('testPath', 'testName3'));
	}
}
?>
