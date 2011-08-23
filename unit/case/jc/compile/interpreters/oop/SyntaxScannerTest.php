<?php
namespace jc\test\unit\testcase\jc\compile\interpreters\oop;


use jc\compile\object\ClosureToken;
use jc\compile\interpreters\oop\State;
use jc\compile\object\Token;
use jc\compile\object\TokenPool;
use jc\compile\interpreters\oop\SyntaxScanner ;

/**
 * Test class for jc\compile\interpreters\oop\SyntaxScanner.
 * @for jc\compile\interpreters\oop\SyntaxScanner
 */
class SyntaxScannerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\compile\interpreters\oop\SyntaxScanner
     */
    protected $aSyntaxScanner;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->aSyntaxScanner = new SyntaxScanner ;
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
    	// 添加一些mock token数据
/*
<?
namespace package\name\aaa ;

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
?>
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
    	$aTokenPool->add(new Token(T_OPEN_TAG, '<?', 0)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE, "\r\n", 0)) ;
    	$aTokenPool->add(new Token(T_NAMESPACE, 'namespace', 0)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE, ' ', 0)) ;
    	$aTokenPool->add(new Token(T_STRING, 'package', 0)) ;
    	$aTokenPool->add(new Token(T_NS_SEPARATOR, '\\', 0)) ;
    	$aTokenPool->add(new Token(T_STRING, 'name', 0)) ;
    	$aTokenPool->add(new Token(T_NS_SEPARATOR, '\\', 0)) ;
    	$aTokenPool->add(new Token(T_STRING, 'aaa', 0)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE, ' ', 0)) ;
    	$aTokenPool->add(new Token(Token::T_SEMICOLON, ';', 0)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE, "\r\n", 0)) ;
    	
    	$aTokenPool->add(new Token(T_CLASS, 'class', 0)) ;							// <<--- class define, 				position: 
    	$aTokenPool->add(new Token(T_WHITESPACE, ' ', 0)) ;
    	$aTokenPool->add(new Token(T_STRING, 'ClassNameA', 0)) ;
    	$aTokenPool->add($aClassBodyStart) ;										// <<--- class body start,				position: 
    	$aTokenPool->add(new Token(T_WHITESPACE, "\r\n\t", 0)) ;


    	$aTokenPool->add(new Token(T_STATIC,'static',0)) ;							// 
    	$aTokenPool->add(new Token(T_WHITESPACE," ",0)) ;
    	$aTokenPool->add(new Token(T_PRIVATE,'private',0)) ;
    	$aTokenPool->add(new Token(T_WHITESPACE," ",0)) ;
    	$aTokenPool->add(new Token(T_FUNCTION,'function',0)) ;						// <<--- function for methodNameA
    	$aTokenPool->add(new Token(T_WHITESPACE," ",0)) ;
    	$aTokenPool->add(new Token(T_STRING,'methodNameA',0)) ;
    	$aTokenPool->add($aMethodAArgvListStart) ;
    	$aTokenPool->add(new Token(T_VARIABLE,'$fnCallback',0)) ;
    	$aTokenPool->add(new Token(T_STRING,"=",0)) ;
    	$aTokenPool->add(new Token(T_FUNCTION,'function',0)) ;						// 
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
    	
    	$aTokenPool->add(new Token(T_WHITESPACE, "\r\n", 0)) ;
    	$aTokenPool->add(new Token(T_CLOSE_TAG, "?>", 0)) ;
    	
    	
    	// --------------------
    	// 测试
    	$this->aSyntaxScanner->analyze($aTokenPool) ;
    	
    	// 检验
    	$aClassToken = $aTokenPool->findClass("package\\name\\aaa\\ClassNameA") ;
    	$this->assertNotNull($aClassToken) ;
    	
    	$aMethodToken = $aTokenPool->findFunction("methodNameA","package\\name\\aaa\\ClassNameA") ;
    	$this->assertNotNull($aMethodToken) ;
    	$this->assertEquals($aMethodToken->name(),"methodNameA") ;
    	$this->assertTrue($aMethodToken->argListToken()===$aMethodAArgvListStart) ;
    	$this->assertTrue($aMethodToken->bodyToken()===$aMethodABodyStart) ;
    	$this->assertNotNull($aMethodToken->accessToken()) ;
    	$this->assertEquals($aMethodToken->accessToken()->tokenType(),T_PRIVATE) ;
    	$this->assertNotNull($aMethodToken->staticToken()) ;
    	$this->assertEquals($aMethodToken->staticToken()->tokenType(),T_STATIC) ;
    	$this->assertNull($aMethodToken->abstractToken()) ;
    	$this->assertTrue($aMethodToken->belongsClass()===$aClassToken) ;
    	$this->assertNotNull($aMethodToken->belongsNamespace()) ;
    	
    	$aMethodToken = $aTokenPool->findFunction("methodNameB","package\\name\\aaa\\ClassNameA") ;
    	$this->assertNotNull($aMethodToken) ;
    	$this->assertEquals($aMethodToken->name(),"methodNameB","package\\name\\aaa\\ClassNameA") ;
    	$this->assertTrue($aMethodToken->argListToken()===$aMethodBArgvListStart) ;
    	$this->assertNull($aMethodToken->bodyToken()) ;
    	$this->assertNotNull($aMethodToken->accessToken()) ;
    	$this->assertEquals($aMethodToken->accessToken()->tokenType(),T_PUBLIC) ;
    	$this->assertNull($aMethodToken->staticToken()) ;
    	$this->assertNotNull($aMethodToken->abstractToken()) ;
    	$this->assertEquals($aMethodToken->abstractToken()->tokenType(),T_ABSTRACT) ;
    	$this->assertTrue($aMethodToken->belongsClass()===$aClassToken) ;
    	$this->assertNotNull($aMethodToken->belongsNamespace()) ;
    	
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
