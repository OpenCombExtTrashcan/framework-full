<?php
namespace jc\test\unit\testcase\jc\lang\compile;


use jc\lang\compile\DocComment ;

/**
 * Test class for jc\lang\compile\DocComment.
 * @for jc\lang\compile\DocComment
 */
class DocCommentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\lang\compile\DocComment
     */
    protected $aDocComment;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {}

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @todo Implement testDescription().
     */
    public function testDescription()
    {
    	$aDocComment = new DocComment("
		/**
 		 * this is description
 		 *  ...
 		 * *******************
 		 * @xxx ooo  
 		 *xxx
 		 *
 		 */
") ;
    	$this->assertEquals($aDocComment->description(),"this is description\r\n ...\r\n*******************\r\nxxx\r\n") ;
    }

    /**
     * @todo Implement testItem().
     */
    public function testItem()
    {
    	$aDocComment = new DocComment("
		/**
 		 * this is description
 		 *  ...
 		 * @var		XXXX
 		 * @author xdxd
 		 * *******************
 		 * @var OOOO
 		 *
 		 */
") ;
    	$this->assertEquals($aDocComment->item('var'),"XXXX") ;
    	$this->assertEquals($aDocComment->item('author'),"xdxd") ;
    }

    /**
     * @todo Implement testItems().
     */
    public function testItems()
    {
    	$aDocComment = new DocComment("
		/**
 		 * this is description
 		 *  ...
 		 * @var		XXXX
 		 * @author xdxd
 		 * *******************
 		 * @var OOOO
 		 *
 		 */
") ;
    	$this->assertEquals($aDocComment->items('var'),array("XXXX","OOOO")) ;
    	$this->assertEquals($aDocComment->items('author'),array("xdxd")) ;
    }

    /**
     * @todo Implement testItemIterator().
     */
    public function testItemIterator()
    {
    	$aDocComment = new DocComment("
		/**
 		 * this is description
 		 *  ...
 		 * @var		XXXX
 		 * @author xdxd
 		 * *******************
 		 * @var OOOO
 		 *
 		 */
") ;
    	$aIter = $aDocComment->itemIterator() ;
    	$this->assertEquals($aIter->current(),"var") ;
    	$aIter->next() ;
    	$this->assertEquals($aIter->current(),"author") ;
    	$aIter->next() ;
    	$this->assertEquals($aIter->current(),null) ;
    }
}
?>
