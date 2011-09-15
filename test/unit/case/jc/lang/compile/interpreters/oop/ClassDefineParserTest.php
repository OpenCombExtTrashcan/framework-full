<?php
namespace jc\test\unit\testcase\jc\lang\compile\interpreters\oop;


use jc\lang\compile\object\ClosureToken;
use jc\lang\compile\interpreters\oop\State;
use jc\lang\compile\object\Token;
use jc\lang\compile\object\TokenPool;
use jc\lang\compile\interpreters\oop\ClassDefineParser ;

/**
 * Test class for jc\lang\compile\interpreters\oop\ClassDefineParser.
 * @for jc\lang\compile\interpreters\oop\ClassDefineParser
 */
class ClassDefineParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\lang\compile\interpreters\oop\ClassDefineParser
     */
    protected $aClassDefineParser;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->aClassDefineParser = new ClassDefineParser ;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @todo Implement testParse().
     */
    public function testParse()
    {
    	$aState = new State() ;
    	$aTokenPool = new TokenPool() ;
    	
    	// 添加一些mock token数据
    	$aClassBodyStart = new ClosureToken(new Token(Token::T_BRACE_OPEN, '{', 0)) ;
    	$aClassBodyEnd = new ClosureToken(new Token(Token::T_BRACE_CLOSE, '}', 0)) ;
    	$aClassBodyStart->setTheOther($aClassBodyEnd) ;
    	
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new Token(T_OPEN_TAG,'<?',4)) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;			// position: 4
    	
    	$aTokenPool->add(new Token(T_NAMESPACE, 'namespace', 0)) ;					// <<--- namespace declare start,  position: 5
    	$aTokenPool->add(new Token(T_WHITESPACE, ' ', 0)) ;
    	$aTokenPool->add(new Token(T_STRING, 'package', 0)) ;
    	$aTokenPool->add(new Token(T_NS_SEPARATOR, '\\', 0)) ;
    	$aTokenPool->add(new Token(T_STRING, 'name', 0)) ;
    	$aTokenPool->add(new Token(T_NS_SEPARATOR, '\\', 0)) ;
    	$aTokenPool->add(new Token(T_STRING, 'aaa', 0)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE, ' ', 0)) ;
    	$aTokenPool->add(new Token(Token::T_SEMICOLON, ';', 0)) ;					// <<--- namespace declare end, 	position: 13
    	
    	$aTokenPool->add(new MockAnyTypeToken()) ;									// position: 14
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;									// position: 17
    	
    	$aTokenPool->add(new Token(T_CLASS, 'class', 0)) ;							// <<--- class define, 				position: 18
    	$aTokenPool->add(new Token(T_WHITESPACE, ' ', 0)) ;
    	$aTokenPool->add(new Token(T_STRING, 'ClassNameA', 0)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE, ' ', 0)) ;
    	$aTokenPool->add(new Token(T_EXTENDS, 'extends', 0)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE, ' ', 0)) ;
    	$aTokenPool->add(new Token(T_STRING, 'ParentClassName', 0)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE, ' ', 0)) ;
    	$aTokenPool->add(new Token(T_IMPLEMENTS, 'implements', 0)) ;
    	$aTokenPool->add(new Token(T_STRING, 'InterfaceA', 0)) ;
    	$aTokenPool->add(new Token(Token::T_COLON, ',', 0)) ;
    	$aTokenPool->add(new Token(T_STRING, 'InterfaceB', 0)) ;
    	$aTokenPool->add($aClassBodyStart) ;										// <<--- class body start,				position: 30
    	
    	$aTokenPool->add(new MockAnyTypeToken()) ;									// position: 31
    	$aTokenPool->add(new MockAnyTypeToken()) ;    	
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;    	
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;									// position: 42
    	
    	$aTokenPool->add($aClassBodyEnd) ;											// <<--- class body end,				position: 43
    	
    	$aTokenPool->add(new Token(T_CLOSE_TAG,'?>',11)) ;							// position: 44
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;									// position: 46
    	
    	
    	// --------------------
    	// 测试
    	$aTokenIter = $aTokenPool->iterator() ;
    	
    	// empty
    	for($i=0;$i<18;$i++)
    	{
    		$this->aClassDefineParser->parse($aTokenPool, $aTokenIter, $aState) ;
    		$aTokenIter->next() ;
    		
    		$this->assertNull($aState->currentClass()) ;
    		$this->assertEquals($aTokenIter->position(), $i+1) ;
    	}
    
    	// class define 
    	$this->aClassDefineParser->parse($aTokenPool, $aTokenIter, $aState) ;
    	$aTokenIter->next() ;
    		
    	$this->assertNotNull($aState->currentClass()) ;
    	$this->assertEquals($aTokenIter->position(), 19) ;
    	$this->assertEquals($aState->currentClass()->name(),"ClassNameA") ;    	
    
    	for($i=0;$i<24;$i++)
    	{
    		$this->aClassDefineParser->parse($aTokenPool, $aTokenIter, $aState) ;
    		$aTokenIter->next() ;
    		
	    	$this->assertNotNull($aState->currentClass()) ;
	    	$this->assertEquals($aState->currentClass()->name(),"ClassNameA") ;
    		$this->assertEquals($aTokenIter->position(), 19+$i+1) ;
    	}
    	
    	// class body end 
    	$this->aClassDefineParser->parse($aTokenPool, $aTokenIter, $aState) ;
    	$aTokenIter->next() ;
    	
    	$this->assertNull($aState->currentClass()) ;
    	$this->assertEquals($aTokenIter->position(), 44) ; 		
    
    	for($i=0;$i<3;$i++)
    	{
    		$this->assertEquals($aTokenIter->position(), 44+$i) ; 	
    		
    		$this->aClassDefineParser->parse($aTokenPool, $aTokenIter, $aState) ;
    		$aTokenIter->next() ;
    		
    		$this->assertNull($aState->currentClass()) ;
    	}
    }
}
?>