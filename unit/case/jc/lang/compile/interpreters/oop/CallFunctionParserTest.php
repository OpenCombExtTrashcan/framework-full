<?php
namespace jc\test\unit\testcase\jc\lang\compile\interpreters\oop;

use jc\lang\compile\object\CallFunction;

use jc\lang\compile\CompilerFactory;
use jc\io\InputStreamCache;
use jc\lang\compile\object\ClassDefine;
use jc\lang\compile\interpreters\oop\CallFunctionParser ;
use jc\lang\compile\interpreters\oop\State;
use jc\lang\compile\object\Token;

/**
 * Test class for jc\lang\compile\interpreters\oop\CallFunctionParser.
 * @for jc\lang\compile\interpreters\oop\CallFunctionParser
 */
class CallFunctionParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\lang\compile\interpreters\oop\CallFunctionParser
     */
    protected $aCallFunctionParser;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    	//  /*nextTokenIsCallFunction*/ 和 /*nextTokenIsCallMethod*/为标记 ,方便后面定位
    	$sMockupCode = '<?php 
			namespace package\\name\\aaa ;
			
			class ClassNameA
			{
				public function FunctionNameA()
				{
					if(true){}
					$array = array("()" ,"Function");
					/*nextTokenIsCallFunction*/callFunctionNameA("()");
					/*nextTokenIsCallFunction*/callFunctionNameA("text",2,true);
					/*nextTokenIsCallMethod*/$this->callFunctionNameB();
					/*nextTokenIsCallMethod*/$this->callFunctionNameB($arg1, "()");
					/*nextTokenIsCallMethod*/ClassNameA::callFunctionNameB();
					/*nextTokenIsCallMethod*/ClassNameA::callFunctionNameB("()",2,true);
				}
			}
			' ;
    	
    	
		$aClassCompiler = CompilerFactory::singleton()->create() ;
		$aCompilerInput = new InputStreamCache($sMockupCode) ;
		
		$this->aTokenPool = $aClassCompiler->scan( $aCompilerInput ) ;
		$aClassCompiler->interpret( $this->aTokenPool ) ;
		
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testParse()
    {
    	$aCallFunctionParser = new CallFunctionParser();
    	$aTokenPoolIter = $this->aTokenPool->iterator();
    	foreach( $aTokenPoolIter as $aToken)
    	{
			$aCallFunctionParser->parse($this->aTokenPool , $aTokenPoolIter , new State());
    	}
    	
    	$aTokenPoolIter = $this->aTokenPool->iterator();
    	foreach( $aTokenPoolIter as $aToken)
    	{
    		if($aToken->tokenType()===T_COMMENT)
    		{
				$sCommentSourceCode = $aToken->sourceCode();
				if($sCommentSourceCode == '/*nextTokenIsCallFunction*/')
				{
					$aTokenPoolIter->next();
					$aCallFunctionToken = $aTokenPoolIter->current();
					$this->assertTrue($aCallFunctionToken instanceof  CallFunction);
					
				}else if($sCommentSourceCode == '/*nextTokenIsCallMethod*/')
				{
					$aTokenPoolIter->next();
					$aClassToken = $aTokenPoolIter->current();
					$aTokenPoolIter->next();
					$aAccessToken = $aTokenPoolIter->current();
					$aTokenPoolIter->next();
					$aCallFunctionToken = $aTokenPoolIter->current();
					$this->assertTrue($aCallFunctionToken instanceof  CallFunction);
					
					$this->assertTrue($aCallFunctionToken->classToken() === $aClassToken);
					$this->assertTrue($aCallFunctionToken->accessToken() === $aAccessToken);
				}
    		}
    	}
    }
}
?>