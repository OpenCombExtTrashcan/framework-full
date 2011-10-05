<?php
namespace jc\test\unit\testcase\jc\setting\imp;


use jc\setting\imp\FsKey ;

/**
 * Test class for jc\setting\imp\FsKey.
 * @for jc\setting\imp\FsKey
 */
class FsKeyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\setting\imp\FsKey
     */
    protected $aFsKey;

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
        $this->aFsKey = new FsKey ;
    }

    public function testSave()
    {
    	$this->aFsKey = new FsKey ;
    }
}
?>
