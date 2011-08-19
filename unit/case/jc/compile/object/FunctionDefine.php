<?php
namespace jc\test\unit\testcase\jc\compile\object;

use jc\compile\object\ClosureToken;
use jc\compile\object\Token;
use jc\compile\ClassCompileException;


/**
 * Test class for FunctionDefine.
 * Generated by PHPUnit on 2011-08-19 at 11:46:39.
 */
class FunctionDefine extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\compile\object\FunctionDefine
     */
    protected $aFunctionDefine;

    protected $aFunctionKeywordToken;
    protected $aFunctionNameToken;
    protected $aFunctionArgvListToken;
    protected $aFunctionBodyToken;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    	$this->aFunctionKeywordToken = new Token(T_CLASS, 'function', 100) ;
    	$this->aFunctionNameToken = new Token(T_STRING, 'SameFunctionName', 110) ;
    	$this->aFunctionArgvListToken = new ClosureToken(new Token(Token::T_BRACE_ROUND_OPEN, '(', 120)) ;
    	$this->aFunctionBodyToken = new ClosureToken(new Token(Token::T_BRACE_OPEN, '{', 130)) ;
    	
        $this->aFunctionDefine = new \jc\compile\object\FunctionDefine(
        		$this->aFunctionKeywordToken
        		, $this->aFunctionNameToken
        		, $this->aFunctionArgvListToken
        		, $this->aFunctionBodyToken
        ) ;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @todo Implement testArgListToken().
     */
    public function testArgListToken()
    {
        $this->assertTrue($this->aFunctionDefine->argListToken()===$this->aFunctionArgvListToken) ;
        
        // 换一个
        $aOtherArgListTokenA = new ClosureToken(new Token(Token::T_BRACE_ROUND_OPEN, '(', 120)) ;
        $this->aFunctionDefine->setArgListToken($aOtherArgListTokenA) ;
        $this->assertTrue($this->aFunctionDefine->argListToken()===$aOtherArgListTokenA) ;
        
        // 非法的参数
        $aOtherArgListTokenB = new ClosureToken(new Token(Token::T_BRACE_SQUARE_OPEN, '[', 120)) ;
        try{
        	$this->aFunctionDefine->setArgListToken($aOtherArgListTokenB) ;
        }
        catch (ClassCompileException $e)
        {}
        $this->assertNotNull($e) ;
        $this->assertTrue($this->aFunctionDefine->argListToken()===$aOtherArgListTokenA) ;		// << 仍然是 $aOtherArgListTokenA
    }

    /**
     * @see self::testArgListToken() ;
     */
    public function testSetArgListToken()
    {
        $this->testArgListToken() ;
    }

    /**
     * @todo Implement testAccessToken().
     */
    public function testAccessToken()
    {
        $this->assertNull($this->aFunctionDefine->accessToken()) ;
        
        foreach( array(T_PRIVATE=>'private',T_PROTECTED=>'protected',T_PUBLIC=>'public') as $nType=>$sSymbol)
        {
	        $aAccessToken = new Token($nType, $sSymbol, 120) ;
	        $this->aFunctionDefine->setAccessToken($aAccessToken) ;
	        $this->assertTrue($this->aFunctionDefine->accessToken()===$aAccessToken) ;
        }
        
        // 非法的参数
        $aToken = new Token(T_ABSTRACT, 'abstract', 120) ;
        try{
        	$this->aFunctionDefine->setAccessToken($aToken) ;
        }
        catch (ClassCompileException $e)
        {}
        $this->assertNotNull($e) ;
        $this->assertTrue($this->aFunctionDefine->accessToken()===$aAccessToken) ;		// << 仍然是上一个 $aAccessToken
    }

    /**
     * @see self::testAccessToken()
     */
    public function testSetAccessToken()
    {
        $this->testAccessToken() ;
    }

    /**
     * @see self::testStaticToken()
     */
    public function testSetStaticToken()
    {
        $this->testStaticToken() ;
    }

    /**
     * @todo Implement testStaticToken().
     */
    public function testStaticToken()
    {
        $this->assertNull($this->aFunctionDefine->staticToken()) ;
        
        $aStaticToken = new Token(T_STATIC, 'static', 120) ;
        $this->aFunctionDefine->setStaticToken($aStaticToken) ;
        $this->assertTrue($this->aFunctionDefine->staticToken()===$aStaticToken) ;
        
        // 非法的参数
        $aToken = new Token(T_ABSTRACT, 'abstract', 120) ;
        try{
        	$this->aFunctionDefine->setStaticToken($aToken) ;
        }
        catch (ClassCompileException $e)
        {}
        $this->assertNotNull($e) ;
        $this->assertTrue($this->aFunctionDefine->staticToken()===$aStaticToken) ;
    }

    /**
     * @see self::testAbstractToken()
     */
    public function testSetAbstractToken()
    {
        $this->testAbstractToken() ;
    }

    /**
     * @todo Implement testAbstractToken().
     */
    public function testAbstractToken()
    {
        $this->assertNull($this->aFunctionDefine->abstractToken()) ;
        
        $aAbstractToken = new Token(T_ABSTRACT, 'abstract', 120) ;
        $this->aFunctionDefine->setAbstractToken($aAbstractToken) ;
        $this->assertTrue($this->aFunctionDefine->abstractToken()===$aAbstractToken) ;
        
        // 非法的参数
        $aToken = new Token(T_STATIC, 'static', 120) ;
        try{
        	$this->aFunctionDefine->setAbstractToken($aToken) ;
        }
        catch (ClassCompileException $e)
        {}
        $this->assertNotNull($e) ;
        $this->assertTrue($this->aFunctionDefine->abstractToken()===$aAbstractToken) ;
    }

    /**
     * @todo Implement testSetDocToken().
     */
    public function testSetDocToken()
    {
    }

    /**
     * @todo Implement testDocToken().
     */
    public function testDocToken()
    {
        $this->assertNull($this->aFunctionDefine->docToken()) ;
        
        $aDocToken = new Token(T_DOC_COMMENT, '/**..**/', 120) ;
        $this->aFunctionDefine->setDocToken($aDocToken) ;
        $this->assertTrue($this->aFunctionDefine->docToken()===$aDocToken) ;
        
        // 非法的参数
        $aToken = new Token(T_STATIC, 'static', 120) ;
        try{
        	$this->aFunctionDefine->setDocToken($aToken) ;
        }
        catch (ClassCompileException $e)
        {}
        $this->assertNotNull($e) ;
        $this->assertTrue($this->aFunctionDefine->docToken()===$aDocToken) ;
    }
}
?>
