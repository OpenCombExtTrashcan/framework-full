<?php
namespace jc\test\unit\testcase\jc\setting\imp;

use jc\setting\imp\FsSetting;
use jc\test\unit\testcase\jc\setting\imp\mock\MockupFolder;

/**
 * Test class for jc\setting\imp\FsSetting.
 * @for jc\setting\imp\FsSetting
 */
class FsSettingTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var jc\setting\imp\FsSetting
	 */
	protected $aFsSetting;
	
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
	
	/**
	 * @see testCreateKey()
	 */
	public function testKey()
	{
	}
	
	public function testCreateKey()
	{
		//key存在 item.php 存在的情况
		$aFolder = new MockupFolder ( true );
		$aFsSetting = new FsSetting ( $aFolder );
		$aKey = $aFsSetting->createKey ( '/testCreateKey' );
		
		$this->assertEquals ( $aKey, $aFsSetting->key ( '/testCreateKey' ) );
	//key存在 item.php 不存在的情况
	

	//key不存在的情况
	
		
	}
	
	public function testHasKey()
	{
	}
	
	/**
	 * @todo Implement testDeleteKey().
	 */
	public function testDeleteKey()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete ( 'This test has not been implemented yet.' );
	}
	
	/**
	 * @todo Implement testItem().
	 */
	public function testItem()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete ( 'This test has not been implemented yet.' );
	}
	
	/**
	 * @todo Implement testKeyIterator().
	 */
	public function testKeyIterator()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete ( 'This test has not been implemented yet.' );
	}
	
	/**
	 * @todo Implement testTrimRootSlash().
	 */
	public function testTrimRootSlash()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete ( 'This test has not been implemented yet.' );
	}
}
?>
