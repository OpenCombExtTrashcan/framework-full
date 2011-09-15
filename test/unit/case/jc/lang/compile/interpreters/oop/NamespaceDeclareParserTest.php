<?php
namespace jc\test\unit\testcase\jc\lang\compile\interpreters\oop;


use jc\lang\compile\object\Token;
use jc\lang\compile\object\TokenPool;
use jc\lang\compile\interpreters\oop\State;
use jc\lang\compile\interpreters\oop\NamespaceDeclareParser ;

/**
 * Test class for jc\lang\compile\interpreters\oop\NamespaceDeclareParser.
 * @for jc\lang\compile\interpreters\oop\NamespaceDeclareParser
 */
class NamespaceDeclareParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\lang\compile\interpreters\oop\NamespaceDeclareParser
     */
    protected $aNamespaceDeclareParser;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->aNamespaceDeclareParser = new NamespaceDeclareParser ;
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
    	
    	$aTokenPool->add(new MockAnyTypeToken()) ;			// position: 14
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;    	
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;			// position: 22
    	
    	$aTokenPool->add(new Token(T_NAMESPACE, 'namespace', 0)) ;					// <<--- namespace declare start, 	position: 23
    	$aTokenPool->add(new Token(T_WHITESPACE, ' ', 0)) ;
    	$aTokenPool->add(new Token(T_STRING, 'package', 0)) ;
    	$aTokenPool->add(new Token(T_NS_SEPARATOR, '\\', 0)) ;
    	$aTokenPool->add(new Token(T_STRING, 'name', 0)) ;
    	$aTokenPool->add(new Token(T_NS_SEPARATOR, '\\', 0)) ;
    	$aTokenPool->add(new Token(T_STRING, 'bbb', 0)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE, ' ', 0)) ;
    	$aTokenPool->add(new Token(Token::T_SEMICOLON, ';', 0)) ;					// <<--- namespace declare end,		position: 31
    	
    	$aTokenPool->add(new MockAnyTypeToken()) ;			// position: 32
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;    	
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;			// position: 40
    	
    	$aTokenPool->add(new Token(T_CLOSE_TAG,'?>',11)) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;			// position: 43
    	
    	
    	// --------------------
    	// 测试
    	$aTokenIter = $aTokenPool->iterator() ;
    	
    	// empty
    	for($i=0;$i<5;$i++)
    	{
    		$this->aNamespaceDeclareParser->parse($aTokenPool, $aTokenIter, $aState) ;
    		$aTokenIter->next() ;
    		
    		$this->assertNull($aState->currentNamespace()) ;
    		$this->assertEquals($aTokenIter->position(), $i+1) ;
    		
    	}
    
    	// namespace for: package\name\aaa
    	$this->aNamespaceDeclareParser->parse($aTokenPool, $aTokenIter, $aState) ;
    	$aTokenIter->next() ;
    		
    	$this->assertNotNull($aState->currentNamespace()) ;
    	$this->assertEquals($aState->currentNamespace()->name(),"package\\name\\aaa") ;
    	$this->assertEquals($aTokenIter->position(), 6) ;
    
    	for($i=0;$i<17;$i++)
    	{
    		$this->aNamespaceDeclareParser->parse($aTokenPool, $aTokenIter, $aState) ;
    		$aTokenIter->next() ;
    		
    		$this->assertNotNull($aState->currentNamespace()) ;
    		$this->assertEquals($aState->currentNamespace()->name(),"package\\name\\aaa") ;   
    		
    		$this->assertEquals($aTokenIter->position(), 6+$i+1) ; 		
    	}
    	
    	// namespace for: package\name\bbb
    	$this->aNamespaceDeclareParser->parse($aTokenPool, $aTokenIter, $aState) ;
    	$aTokenIter->next() ;
    	
    	$this->assertNotNull($aState->currentNamespace()) ;
    	$this->assertEquals($aState->currentNamespace()->name(),"package\\name\\bbb") ;
    	$this->assertEquals($aTokenIter->position(), 24) ; 		
    
    	for($i=0;$i<20;$i++)
    	{
    		$this->assertEquals($aTokenIter->position(), 24+$i) ; 	
    		
    		$this->aNamespaceDeclareParser->parse($aTokenPool, $aTokenIter, $aState) ;
    		$aTokenIter->next() ;
    		
    		$this->assertNotNull($aState->currentNamespace()) ;
    		$this->assertEquals($aState->currentNamespace()->name(),"package\\name\\bbb") ;
    	}
    }
}


?>