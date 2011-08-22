<?php
namespace jc\test\unit\testcase\jc\compile\interpreters;


use jc\compile\object\TokenPool;
use jc\compile\object\Token;
use jc\compile\interpreters\ClosureObjectParser ;

/**
 * Test class for jc\compile\interpreters\ClosureObjectParser.
 * @for jc\compile\interpreters\ClosureObjectParser
 */
class ClosureObjectParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\compile\interpreters\ClosureObjectParser
     */
    protected $aClosureObjectParser;
    
    const some_position = 0 ;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->aClosureObjectParser = new ClosureObjectParser ;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @todo Implement testAnalyze().
     */
    public function testAnalyze()
    {
    	$aTokenPool = new TokenPool() ;
    	
    	$aTokenPool->add(new Token(T_STRING,'<html><body>',self::some_position)) ;
    	$aTokenPool->add(new Token(T_OPEN_TAG,'<?',self::some_position)) ;					// <<--  < ? idx:1
    	$aTokenPool->add(new Token(T_CLASS,'class',self::some_position)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE,' ',self::some_position)) ;
    	$aTokenPool->add(new Token(T_STRING,'ClassNameA',self::some_position)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE,"\r\n",self::some_position)) ;
    	$aTokenPool->add(new Token(Token::T_BRACE_OPEN,'ClassNameA',self::some_position)) ;	// <<-- { idx:6
    	$aTokenPool->add(new Token(T_FUNCTION,"function",self::some_position)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE,' ',self::some_position)) ;
    	$aTokenPool->add(new Token(T_STRING,"FunctionNameA",self::some_position)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE,' ',self::some_position)) ;
    	$aTokenPool->add(new Token(Token::T_BRACE_ROUND_OPEN,"(",self::some_position)) ;	// <<-- ( idx:11
    	$aTokenPool->add(new Token(T_VARIABLE,'$argvA',self::some_position)) ;
    	$aTokenPool->add(new Token(T_STRING,', ',self::some_position)) ;
    	$aTokenPool->add(new Token(T_VARIABLE,'$argvB',self::some_position)) ;
    	$aTokenPool->add(new Token(Token::T_BRACE_ROUND_CLOSE,")",self::some_position)) ;	// <<-- ) idx:15
    	$aTokenPool->add(new Token(T_WHITESPACE,"\r\n",self::some_position)) ;
    	$aTokenPool->add(new Token(Token::T_BRACE_OPEN,'}',self::some_position)) ;			// <<-- { idx:17
    	$aTokenPool->add(new Token(T_WHITESPACE,"\r\n",self::some_position)) ;
    	$aTokenPool->add(new Token(T_ECHO,"echo",self::some_position)) ;
    	$aTokenPool->add(new Token(T_STRING,"'hello world'",self::some_position)) ;
    	$aTokenPool->add(new Token(T_STRING,";",self::some_position)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE,"\r\n",self::some_position)) ;
    	$aTokenPool->add(new Token(Token::T_BRACE_CLOSE,'}',self::some_position)) ;			// <<-- } idx:23
    	$aTokenPool->add(new Token(T_WHITESPACE,"\r\n",self::some_position)) ;
    	$aTokenPool->add(new Token(Token::T_BRACE_CLOSE,'}',self::some_position)) ;			// <<-- } idx:25
    	$aTokenPool->add(new Token(T_WHITESPACE,"\r\n",self::some_position)) ;
    	$aTokenPool->add(new Token(T_CLOSE_TAG,'?>',self::some_position)) ;					// <<--  ? > idx:27
    	$aTokenPool->add(new Token(T_STRING,'</body></html>',self::some_position)) ;
    	
    	
    	// 分析
    	$this->aClosureObjectParser->analyze($aTokenPool) ;
    	
    	// 检验结果
    	
    	$aOpenTag = $aTokenPool->getByName(1) ;
    	$aBraceOpenA = $aTokenPool->getByName(6) ;
    	$aBraceRoundOpenA = $aTokenPool->getByName(11) ;
    	$aBraceRoundCloseA = $aTokenPool->getByName(15) ;
    	$aBraceOpenB = $aTokenPool->getByName(17) ;
    	$aBraceCloseB = $aTokenPool->getByName(23) ;
    	$aBraceCloseA = $aTokenPool->getByName(25) ;
    	$aCloseTag = $aTokenPool->getByName(27) ;
    	
    	$this->assertTrue($aOpenTag->theOther()===$aCloseTag) ;
    	$this->assertTrue($aCloseTag->theOther()===$aOpenTag) ;
    	
    	$this->assertTrue($aBraceOpenA->theOther()===$aBraceCloseA) ;
    	$this->assertTrue($aBraceCloseA->theOther()===$aBraceOpenA) ;
    	
    	$this->assertTrue($aBraceRoundOpenA->theOther()===$aBraceRoundCloseA) ;
    	$this->assertTrue($aBraceRoundCloseA->theOther()===$aBraceRoundOpenA) ;
    	
    	$this->assertTrue($aBraceOpenB->theOther()===$aBraceCloseB) ;
    	$this->assertTrue($aBraceCloseB->theOther()===$aBraceOpenB) ;
    }
}
?>
