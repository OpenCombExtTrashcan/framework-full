<?php
namespace jc\test\unit\testcase\jc\setting;

use jc\setting\Setting ;
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
    	$aSetting = new SettingClassForTest();
    	
    	$aSetting->setItem('/testPath', 'testName1', 'testValue1');
    	$aSetting->setItem('/testPath', 'testName2', 1);
    	$aSetting->setItem('/testPath', 'testName3', false);
    	//获得迭代器
    	$aKeyIter = $aSetting->keyIterator('/testPath');
    	
    	$this->assertEquals('testValue1', $aKeyIter->current());
    	$aKeyIter->next();
    	$this->assertEquals(1, $aKeyIter->current());
    	$aKeyIter->next();
    	$this->assertEquals(false, $aKeyIter->current());
    }
    
    public function testItemIterator()
    {
    }

    public function testItem()
    {
    }

    public function testSetItem()
    {
    }

    public function testHasItem()
    {
    }

    public function testDeleteItem()
    {
    }
}
?>
