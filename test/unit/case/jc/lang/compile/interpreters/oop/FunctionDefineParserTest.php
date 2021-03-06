<?php
namespace jc\test\unit\testcase\jc\lang\compile\interpreters\oop;


use jc\lang\compile\object\ClosureToken;
use jc\lang\compile\interpreters\oop\State;
use jc\lang\compile\object\Token;
use jc\lang\compile\object\TokenPool;
use jc\lang\compile\interpreters\oop\FunctionDefineParser ;

/**
 * Test class for jc\lang\compile\interpreters\oop\FunctionDefineParser.
 * @for jc\lang\compile\interpreters\oop\FunctionDefineParser
 */
class FunctionDefineParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\lang\compile\interpreters\oop\FunctionDefineParser
     */
    protected $aFunctionDefineParser;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->aFunctionDefineParser = new FunctionDefineParser ;
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
    	// 添加一些mock token数据
/*
class ClassNameA{
	static private function methodNameA($fnCallback=function($arrArgv=array()){
		function globalFunctionNameA()
		{
			....
		}
	}, $anotherArgv="xxxx")
	{
		...
	}
	
	abstract public function methodNameB() ;
}

$fnCallback = function($arrArgv=array())
{
	...
}
*/
    	// class body
    	$aClassBodyStart = new ClosureToken(new Token(Token::T_BRACE_OPEN, '{', 0)) ;
    	$aClassBodyEnd = new ClosureToken(new Token(Token::T_BRACE_CLOSE, '}', 0)) ;
    	$aClassBodyStart->setTheOther($aClassBodyEnd) ;
    	
    	
    	// ClassNameA::methodNameA() body
    	$aMethodABodyStart = new ClosureToken(new Token(Token::T_BRACE_OPEN, '{', 0)) ;
    	$aMethodABodyEnd = new ClosureToken(new Token(Token::T_BRACE_CLOSE, '}', 0)) ;
    	$aMethodABodyStart->setTheOther($aMethodABodyEnd) ;
    	
    	// ClassNameA::methodNameA() argv list
    	$aMethodAArgvListStart = new ClosureToken(new Token(T_STRING,'(', 0)) ;
    	$aMethodAArgvListEnd = new ClosureToken(new Token(T_STRING, ')', 0)) ;
    	$aMethodAArgvListStart->setTheOther($aMethodAArgvListEnd) ;
    	
    	
    	// ClassNameA::methodNameB() body
    	$aMethodBBodyStart = new ClosureToken(new Token(Token::T_BRACE_OPEN, '{', 0)) ;
    	$aMethodBBodyEnd = new ClosureToken(new Token(Token::T_BRACE_CLOSE, '}', 0)) ;
    	$aMethodBBodyStart->setTheOther($aMethodBBodyEnd) ;
    	
    	// ClassNameA::methodNameB() argv list
    	$aMethodBArgvListStart = new ClosureToken(new Token(T_STRING,'(', 0)) ;
    	$aMethodBArgvListEnd = new ClosureToken(new Token(T_STRING, ')', 0)) ;
    	$aMethodBArgvListStart->setTheOther($aMethodBArgvListEnd) ;
    	
    	
    	// 匿名函数 body
    	$aAnonymousFunctionBodyStart = new ClosureToken(new Token(Token::T_BRACE_OPEN, '{', 0)) ;
    	$aAnonymousFunctionBodyEnd = new ClosureToken(new Token(Token::T_BRACE_CLOSE, '}', 0)) ;
    	$aAnonymousFunctionBodyStart->setTheOther($aAnonymousFunctionBodyEnd) ;
    	
    	// 匿名函数 argv list
    	$aAnonymousFunctionArgvListStart = new ClosureToken(new Token(T_STRING,'(', 0)) ;
    	$aAnonymousFunctionArgvListEnd = new ClosureToken(new Token(T_STRING, ')', 0)) ;
    	$aAnonymousFunctionArgvListStart->setTheOther($aAnonymousFunctionArgvListEnd) ;
    	
    	// 匿名函数B body
    	$aAnonymousFunctionBBodyStart = new ClosureToken(new Token(Token::T_BRACE_OPEN, '{', 0)) ;
    	$aAnonymousFunctionBBodyEnd = new ClosureToken(new Token(Token::T_BRACE_CLOSE, '}', 0)) ;
    	$aAnonymousFunctionBBodyStart->setTheOther($aAnonymousFunctionBBodyEnd) ;
    	
    	// 匿名函数B argv list
    	$aAnonymousFunctionBArgvListStart = new ClosureToken(new Token(T_STRING,'(', 0)) ;
    	$aAnonymousFunctionBArgvListEnd = new ClosureToken(new Token(T_STRING, ')', 0)) ;
    	$aAnonymousFunctionBArgvListStart->setTheOther($aAnonymousFunctionBArgvListEnd) ;
    	
    	
    	// globalFunctionNameA() body
    	$aGlobalFunctionNameABodyStart = new ClosureToken(new Token(Token::T_BRACE_OPEN, '{', 0)) ;
    	$aGlobalFunctionNameABodyEnd = new ClosureToken(new Token(Token::T_BRACE_CLOSE, '}', 0)) ;
    	$aGlobalFunctionNameABodyStart->setTheOther($aGlobalFunctionNameABodyEnd) ;
    	
    	// globalFunctionNameA() argv list
    	$aGlobalFunctionNameAArgvListStart = new ClosureToken(new Token(T_STRING,'(', 0)) ;
    	$aGlobalFunctionNameAArgvListEnd = new ClosureToken(new Token(T_STRING, ')', 0)) ;
    	$aGlobalFunctionNameAArgvListStart->setTheOther($aGlobalFunctionNameAArgvListEnd) ;
    	
    	// 构造 mock
    	// ----------------------------
    	$aTokenPool = new TokenPool() ;
    	$aTokenPool->add(new Token(T_CLASS, 'class', 0)) ;							// <<--- class define, 				position: 0
    	$aTokenPool->add(new Token(T_WHITESPACE, ' ', 0)) ;
    	$aTokenPool->add(new Token(T_STRING, 'ClassNameA', 0)) ;
    	$aTokenPool->add($aClassBodyStart) ;										// <<--- class body start,				position: 3
    	$aTokenPool->add(new Token(T_WHITESPACE, "\r\n\t", 0)) ;


    	$aTokenPool->add(new Token(T_STATIC,'static',0)) ;							// 5
    	$aTokenPool->add(new Token(T_WHITESPACE," ",0)) ;
    	$aTokenPool->add(new Token(T_PRIVATE,'private',0)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE," ",0)) ;
    	$aTokenPool->add(new Token(T_FUNCTION,'function',0)) ;						// <<--- function for methodNameA
    	$aTokenPool->add(new Token(T_WHITESPACE," ",0)) ;
    	$aTokenPool->add(new Token(T_STRING,'methodNameA',0)) ;
    	$aTokenPool->add($aMethodAArgvListStart) ;
    	$aTokenPool->add(new Token(T_VARIABLE,'$fnCallback',0)) ;
    	$aTokenPool->add(new Token(T_STRING,"=",0)) ;
    	$aTokenPool->add(new Token(T_FUNCTION,'function',0)) ;						// 15
    	$aTokenPool->add($aAnonymousFunctionArgvListStart) ;
    	$aTokenPool->add(new Token(T_VARIABLE,'$arrArgv',0)) ;
    	$aTokenPool->add(new Token(T_STRING,"=",0)) ;
    	$aTokenPool->add(new Token(T_ARRAY,"array",0)) ;
    	$aTokenPool->add(new Token(T_STRING,"(",0)) ;
    	$aTokenPool->add(new Token(T_STRING,")",0)) ;
    	$aTokenPool->add($aAnonymousFunctionArgvListEnd) ;
    	$aTokenPool->add($aAnonymousFunctionBodyStart) ;
    	$aTokenPool->add(new Token(T_WHITESPACE, "\r\n\t\t", 0)) ;
    	$aTokenPool->add(new Token(T_FUNCTION,'function',0)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE," ",0)) ;
    	$aTokenPool->add(new Token(T_STRING,'globalFunctionNameA',0)) ;
    	$aTokenPool->add($aAnonymousFunctionArgvListStart) ;
    	$aTokenPool->add($aAnonymousFunctionArgvListEnd) ;
    	$aTokenPool->add($aGlobalFunctionNameABodyStart) ;
    	$aTokenPool->add(new Token(T_WHITESPACE, "\r\n", 0)) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;    	
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new Token(T_STRING,"}",0)) ;
    	$aTokenPool->add($aGlobalFunctionNameABodyEnd) ;
    	$aTokenPool->add($aAnonymousFunctionBodyEnd) ;
    	$aTokenPool->add(new Token(T_STRING,",",0)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE," ",0)) ;
    	$aTokenPool->add(new Token(T_VARIABLE,'$anotherArgv',0)) ;
    	$aTokenPool->add(new Token(T_STRING,"=",0)) ;
    	$aTokenPool->add(new Token(T_STRING,'"xxxx"',0)) ;
    	$aTokenPool->add($aMethodAArgvListEnd) ;
    	$aTokenPool->add(new Token(T_WHITESPACE, "\r\n\t", 0)) ;
    	$aTokenPool->add($aMethodABodyStart) ;
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
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add($aMethodABodyEnd) ;
    	$aTokenPool->add(new Token(T_WHITESPACE, "\r\n\r\n\t", 0)) ;
    	
    	$aTokenPool->add(new Token(T_ABSTRACT,"abstract",0)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE," ",0)) ;
    	$aTokenPool->add(new Token(T_PUBLIC,"public",0)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE," ",0)) ;
    	$aTokenPool->add(new Token(T_FUNCTION,'function',0)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE," ",0)) ;
    	$aTokenPool->add(new Token(T_STRING,"methodNameB",0)) ;
    	$aTokenPool->add($aMethodBArgvListStart) ;
    	$aTokenPool->add($aMethodBArgvListEnd) ;			
    	$aTokenPool->add(new Token(T_WHITESPACE, " ", 0)) ;	
    	$aTokenPool->add(new Token(T_STRING,";",0)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE, "\r\n", 0)) ;	
    	
    	$aTokenPool->add($aClassBodyEnd) ;
    	$aTokenPool->add(new Token(T_WHITESPACE, "\r\n\r\n", 0)) ;
    	
    	$aTokenPool->add(new Token(T_VARIABLE,'$fnCallback',0)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE, " ", 0)) ;	
    	$aTokenPool->add(new Token(T_STRING, "=", 0)) ;	
    	$aTokenPool->add(new Token(T_WHITESPACE, " ", 0)) ;
    	$aTokenPool->add(new Token(T_FUNCTION,'function',0)) ;	
    	$aTokenPool->add($aAnonymousFunctionBArgvListStart) ;
    	$aTokenPool->add(new Token(T_VARIABLE,'$arrArgv',0)) ;
    	$aTokenPool->add(new Token(T_STRING,"=",0)) ;
    	$aTokenPool->add(new Token(T_ARRAY,"array",0)) ;
    	$aTokenPool->add(new Token(T_STRING,"(",0)) ;
    	$aTokenPool->add(new Token(T_STRING,")",0)) ;
    	$aTokenPool->add($aAnonymousFunctionBArgvListEnd) ;
    	$aTokenPool->add($aAnonymousFunctionBBodyStart) ;
    	$aTokenPool->add(new Token(T_WHITESPACE, "\r\n\t", 0)) ;
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
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add(new MockAnyTypeToken()) ;
    	$aTokenPool->add($aAnonymousFunctionBBodyEnd) ;
    	
    	
    	
    	// --------------------
    	// 测试
    	$aState = new State() ;
    	$aTokenIter = $aTokenPool->iterator() ;
    	foreach ($aTokenIter as $aToken)
    	{
    		// echo $aTokenIter->position(), "\r\n" ;
    		$this->aFunctionDefineParser->parse($aTokenPool, $aTokenIter, $aState) ;
    	}
    	
    	// 检验
    	$aMethodToken = $aTokenPool->findFunction("methodNameA") ;
    	$this->assertNotNull($aMethodToken) ;
    	$this->assertEquals($aMethodToken->name(),"methodNameA") ;
    	$this->assertTrue($aMethodToken->argListToken()===$aMethodAArgvListStart) ;
    	$this->assertTrue($aMethodToken->bodyToken()===$aMethodABodyStart) ;
    	$this->assertNotNull($aMethodToken->accessToken()) ;
    	$this->assertEquals($aMethodToken->accessToken()->tokenType(),T_PRIVATE) ;
    	$this->assertNotNull($aMethodToken->staticToken()) ;
    	$this->assertEquals($aMethodToken->staticToken()->tokenType(),T_STATIC) ;
    	$this->assertNull($aMethodToken->abstractToken()) ;
    	
    	$aMethodToken = $aTokenPool->findFunction("methodNameB") ;
    	$this->assertNotNull($aMethodToken) ;
    	$this->assertEquals($aMethodToken->name(),"methodNameB") ;
    	$this->assertTrue($aMethodToken->argListToken()===$aMethodBArgvListStart) ;
    	$this->assertNull($aMethodToken->bodyToken()) ;
    	$this->assertNotNull($aMethodToken->accessToken()) ;
    	$this->assertEquals($aMethodToken->accessToken()->tokenType(),T_PUBLIC) ;
    	$this->assertNull($aMethodToken->staticToken()) ;
    	$this->assertNotNull($aMethodToken->abstractToken()) ;
    	$this->assertEquals($aMethodToken->abstractToken()->tokenType(),T_ABSTRACT) ;
    	
    	// 不支持在函数内定义的函数
    	$this->assertNull($aTokenPool->findFunction("globalFunctionNameA")) ;
    	
    	// 全局匿名函数
    	$aMethodToken = $aTokenPool->findFunction("") ;
    	$this->assertNotNull($aMethodToken) ;
    	$this->assertNull($aMethodToken->nameToken()) ;
    	$this->assertTrue($aMethodToken->argListToken()===$aAnonymousFunctionBArgvListStart) ;
    	$this->assertTrue($aMethodToken->bodyToken()===$aAnonymousFunctionBBodyStart) ;
    	$this->assertNull($aMethodToken->accessToken()) ;
    	$this->assertNull($aMethodToken->staticToken()) ;
    	$this->assertNull($aMethodToken->abstractToken()) ;
    	
    }
    
    
}
?>
