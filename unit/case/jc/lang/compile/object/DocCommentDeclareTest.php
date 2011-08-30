<?php
namespace jc\test\unit\testcase\jc\lang\compile\object;


use jc\lang\compile\ClassCompileException;
use jc\lang\compile\object\DocCommentDeclare ;
use jc\lang\compile\object\Token ;

/**
 * Test class for jc\lang\compile\object\DocCommentDeclare.
 * @for jc\lang\compile\object\DocCommentDeclare
 */
class DocCommentDeclareTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\lang\compile\object\DocCommentDeclare
     */
    protected $aDocCommentDeclare;

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
     * @todo Implement testDocComment().
     */
    public function testConstruct()
    {        
        $aDocToken = new Token(T_DOC_COMMENT, '/**..*/', 120) ;
        $aDocCommentDeclare = new DocCommentDeclare($aDocToken) ;
        
        // 非法的参数
        $aToken = new Token(T_STATIC, 'static', 120) ;
        $aDocCommentDeclare = null ;
        try{
        	$aDocCommentDeclare = new DocCommentDeclare($aToken) ;
        }
        catch (ClassCompileException $e)
        {}
        $this->assertNull($aDocCommentDeclare) ;
    }
    
    /**
     * @todo Implement testDocComment().
     */
    public function testDocComment()
    {
    	$sComment = "/**
 * hahaha
 * @var xxxx 
 */" ;
        $aDocToken = new Token(T_DOC_COMMENT, $sComment, 120) ;
        $aDocCommentDeclare = new DocCommentDeclare($aDocToken) ;
        
        $aDocComment = $aDocCommentDeclare->docComment() ;
        $this->assertNotNull($aDocComment) ;
        $this->assertInstanceOf('jc\\lang\\compile\\DocComment',$aDocComment) ;
        
        $this->assertEquals($aDocComment->source(),$sComment) ;
        $this->assertTrue($aDocCommentDeclare->docComment()===$aDocComment) ;
    }
}
?>
