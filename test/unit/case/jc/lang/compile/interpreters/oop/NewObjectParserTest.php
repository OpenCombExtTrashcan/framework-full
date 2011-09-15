<?php
namespace jc\test\unit\testcase\jc\lang\compile\interpreters\oop;


use jc\lang\compile\interpreters\oop\NewObjectParser ;
use jc\lang\compile\CompilerFactory;
use jc\io\InputStreamCache;
use jc\lang\compile\object\ClassDefine;
use jc\lang\compile\interpreters\oop\State;
use jc\lang\compile\object\Token;
use jc\lang\compile\object\NewObject;

/**
 * Test class for jc\lang\compile\interpreters\oop\NewObjectParser.
 * @for jc\lang\compile\interpreters\oop\NewObjectParser
 */
class NewObjectParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\lang\compile\interpreters\oop\NewObjectParser
     */
    protected $aNewObjectParser;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    	$sMockupCode = '<?php 
			namespace package\\name\\aaa ;
			
			class ClassNameA
			{
				public function FunctionNameA()
				{
					$sObjectName = "Object";
					/*newObject:noArgvs*/$aTestObject1 = new Object();
					
					/*newObject:hasArgvs*/$aTestObject2 = new Object("new fdsfds()" 
											, new Object() 
											, new $sObjectName("new Object()" , 2, true) 
											,true);
				}
			}
			
			class Object{};
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
		$aNewObjectParser = new NewObjectParser();
    	$aTokenPoolIter = $this->aTokenPool->iterator();
    	
    	//让解释器解释上面的实例代码
    	foreach( $aTokenPoolIter as $aToken)
    	{
			$aNewObjectParser->parse($this->aTokenPool , $aTokenPoolIter , new State());
    	}
    	
    	//查看实例代码是否被正确解释
    	$aClassDefineToken = $this->aTokenPool->findClass('package\\name\\aaa\\ClassNameA');
    	$aFunctionDefineToken = $this->aTokenPool->findFunction('FunctionNameA' , 'package\\name\\aaa\\ClassNameA');
    	
    	$aTokenPoolIter = $this->aTokenPool->iterator();
    	foreach( $aTokenPoolIter as $aToken)
    	{
			$sCommentSourceCode = $aToken->sourceCode();
			if($sCommentSourceCode == '/*newObject:noArgvs*/')
			{
				do{
					$aTokenPoolIter->next();
				}while($aToken = $aTokenPoolIter->current() and $aToken->sourceCode() !== 'new' );
				
				$this->assertTrue($aToken instanceof NewObject);
				
			}else if($sCommentSourceCode == '/*newObject:hasArgvs*/')
			{
				$arrTokens = array();
				foreach($aTokenPoolIter as $aToken)
				{
					if($aToken->sourceCode() === 'new')
					{
						$arrTokens[] = $aToken;
					}
				}
				
				$aClassDefineToken = $this->aTokenPool->findClass('package\\name\\aaa\\ClassNameA');
    			$aFunctionDefineToken = $this->aTokenPool->findFunction('FunctionNameA' , 'package\\name\\aaa\\ClassNameA');
				
				foreach ($arrTokens as $aNewObjectToken)
				{
					$this->assertTrue($aNewObjectToken instanceof  NewObject);
					
					$this->assertTrue($aNewObjectToken->belongsClass() === $aClassDefineToken);
					$this->assertTrue($aNewObjectToken->belongsFunction() === $aFunctionDefineToken);
				}
			}
    	}
    }
}
?>
