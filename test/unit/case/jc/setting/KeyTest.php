<?php
namespace jc\test\unit\testcase\jc\setting;

use jc\test\unit\testcase\jc\setting\KeyClassForTest ;

/**
 * Test class for jc\setting\Key.
 * @for jc\setting\Key
 */
class KeyTest extends \PHPUnit_Framework_TestCase
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

    /**
     * @see testSetItem()
     */
    public function testItem()
    {
    	$this->testSetItem();
    }

    public function testSetItem()
    {
    	$aKey = new KeyClassForTest();
    	$aKey->setItem('testName1','testValue1');
    	$aKey->setItem('testName2','testValue2' );
    	$aKey->setItem('testName3',1);
    	$aKey->setItem('testName4',false);
    	
    	//值存在，item方法给出默认值参数的情况
    	$this->assertEquals('testValue1', $aKey->item('testName1' , 'testDefaultValue'));
    	//值存在，没有给出默认值的情况
    	$this->assertEquals('testValue2', $aKey->item('testName2' ));
    	$this->assertEquals(1, $aKey->item('testName3'));
    	$this->assertEquals(false, $aKey->item('testName4'));
    	//值不存在，给出默认值参数的情况
		$this->assertEquals('testDefaultValue', $aKey->item('notExistName1' , 'testDefaultValue'));
		//值不存在，没有给出默认值参数的情况
		$this->assertNull($aKey->item('notExistName2'));
    }

    public function testHasItem()
    {
    	$aKey = new KeyClassForTest();
    	$aKey->setItem('testName1','testValue1');
    	//项存在的情况
    	$this->assertTrue($aKey->hasItem('testName1'));
    	//项不存在的情况
    	$this->assertFalse($aKey->hasItem('testName2'));
    }

    public function testDeleteItem()
    {
        $aKey = new KeyClassForTest();
    	$aKey->setItem('testName1','testValue1');
    	//删除一个项
    	$aKey->deleteItem('testName1');
    	$this->assertFalse($aKey->hasItem('testName1'));
    }

    public function testItemIterator()
    {
    	$aKey = new KeyClassForTest();
    	$aKey->setItem('testName1','testValue1');
    	$aKey->setItem('testName2','testValue2' );
    	$aKey->setItem('testName3',1);
    	$aKey->setItem('testName4',false);
    	//取得迭代器
    	$itemIter = $aKey->itemIterator();
    	$this->assertEquals('testName1', $itemIter->current());
    	$itemIter->next();
    	$this->assertEquals('testName2', $itemIter->current());
    	$itemIter->next();
    	$this->assertEquals('testName3', $itemIter->current());
    	$itemIter->next();
    	$this->assertEquals('testName4', $itemIter->current());
    }
}
?>
