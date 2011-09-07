<?php
namespace jc\test\unit\testcase\jc\lang\aop\jointpoint;

use jc\lang\aop\jointpoint\JointPointCallFunction ;
use jc\lang\compile\CompilerFactory;
use jc\io\InputStreamCache;
use jc\lang\compile\object\ClassDefine;
use jc\lang\compile\object\CallFunction;

/**
 * Test class for jc\lang\aop\jointpoint\JointPointCallFunction.
 * @for jc\lang\aop\jointpoint\JointPointCallFunction
 */
class JointPointCallFunctionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\lang\aop\jointpoint\JointPointCallFunction
     */
    protected $aJointPointCallFunction;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testMatchExecutionPoint()
    {
    	$sMockupCode = '<?php 
			namespace package\\name\\aaa ;
			
			class ClassNameA
			{
				public function FunctionNameA()
				{
					callFunctionNameA();
					callFunctionNameA("text",2,true);
					$this->callFunctionNameB();
					$this->callFunctionNameB($arg1, $arg2);
					ClassNameA::callFunctionNameB();
					ClassNameA::callFunctionNameB("text",2,true);
				}
				public function FunctionNameB()
				{
					callFunctionNameA();
					callFunctionNameA("text",2,true);
					$this->callFunctionNameB();
					$this->callFunctionNameB($arg1, $arg2);
					ClassNameA::callFunctionNameB();
					ClassNameA::callFunctionNameB("text",2,true);
				}
			}
			' ;
    	
    	
		$aClassCompiler = CompilerFactory::singleton()->create() ;
		$aCompilerInput = new InputStreamCache($sMockupCode) ;
		
		$aTokenPool = $aClassCompiler->scan( $aCompilerInput ) ;
		$aClassCompiler->interpret( $aTokenPool ) ;
		
		
		$arrCallFucntionTokens = array();
		foreach($aTokenPool->iterator() as $aToken)
		{
			if($aToken instanceof CallFunction){
				$arrCallFucntionTokens[] = $aToken; 
			}
		}
		
    	$this->assertTrue(
    		JointPointCallFunction::createInstance(array('callFunctionNameA','package\\name\\aaa\\ClassNameA','FunctionNameA'))->matchExecutionPoint(
    			$arrCallFucntionTokens[0]
			)
		) ;
		
		$this->assertTrue(
    		JointPointCallFunction::createInstance(array('callFunctionNameA','package\\name\\aaa\\ClassNameA','FunctionNameB'))->matchExecutionPoint(
				$arrCallFucntionTokens[7]
			)
		) ;
    	
    	$this->assertTrue(
    		JointPointCallFunction::createInstance(array('callFunctionNameB','package\\name\\aaa\\ClassNameA','FunctionNameA'))->matchExecutionPoint(
    			$arrCallFucntionTokens[2]
			)
		) ;
		
		$this->assertTrue(
    		JointPointCallFunction::createInstance(array('callFunctionNameB','package\\name\\aaa\\ClassNameA','FunctionNameB'))->matchExecutionPoint(
    			$arrCallFucntionTokens[9]
			)
		) ;
		
    	$this->assertTrue(
    		JointPointCallFunction::createInstance(array('callFunctionNameB','package\\name\\aaa\\ClassNameA','FunctionNameA'))->matchExecutionPoint(
    			$arrCallFucntionTokens[4]
			)
		) ;
		
		$this->assertTrue(
    		JointPointCallFunction::createInstance(array('callFunctionNameB','package\\name\\aaa\\ClassNameA','FunctionNameB'))->matchExecutionPoint(
    			$arrCallFucntionTokens[11]
			)
		) ;
    	
		// 使用通配符
		
		$this->assertTrue(
    		JointPointCallFunction::createInstance(array('callFunctionNameA','package\\name\\aaa\\ClassNameA','FunctionName*'))->matchExecutionPoint(
    			$arrCallFucntionTokens[6]
			)
		) ;
		
		$this->assertTrue(
    		JointPointCallFunction::createInstance(array('callFunctionNameB','package\\name\\aaa\\ClassNameA','FunctionName*'))->matchExecutionPoint(
    			$arrCallFucntionTokens[1]
			)
		) ;
		
		$this->assertTrue(
    		JointPointCallFunction::createInstance(array('callFunctionName*','package\\name\\aaa\\ClassNameA','FunctionNameA'))->matchExecutionPoint(
    			$arrCallFucntionTokens[1]
			)
		) ;
		$this->assertTrue(
    		JointPointCallFunction::createInstance(array('callFunctionName*','package\\name\\aaa\\ClassNameA','FunctionNameA'))->matchExecutionPoint(
    			$arrCallFucntionTokens[3]
			)
		) ;
		$this->assertTrue(
    		JointPointCallFunction::createInstance(array('callFunctionName*','package\\name\\aaa\\ClassNameA','FunctionNameA'))->matchExecutionPoint(
    			$arrCallFucntionTokens[5]
			)
		) ;
		
		$this->assertTrue(
    		JointPointCallFunction::createInstance(array('callFunctionName*','package\\name\\aaa\\ClassNameA','FunctionName*'))->matchExecutionPoint(
    			$arrCallFucntionTokens[0]
			)
		) ;
		$this->assertTrue(
    		JointPointCallFunction::createInstance(array('callFunctionName*','package\\name\\aaa\\ClassNameA','FunctionName*'))->matchExecutionPoint(
    			$arrCallFucntionTokens[4]
			)
		) ;
		$this->assertTrue(
    		JointPointCallFunction::createInstance(array('callFunctionName*','package\\name\\aaa\\ClassNameA','FunctionName*'))->matchExecutionPoint(
    			$arrCallFucntionTokens[6]
			)
		) ;
		$this->assertTrue(
    		JointPointCallFunction::createInstance(array('callFunctionName*','package\\name\\aaa\\ClassNameA','FunctionName*'))->matchExecutionPoint(
    			$arrCallFucntionTokens[7]
			)
		) ;
		$this->assertTrue(
    		JointPointCallFunction::createInstance(array('callFunctionName*','package\\name\\aaa\\ClassNameA','FunctionName*'))->matchExecutionPoint(
    			$arrCallFucntionTokens[10]
			)
		) ;
		
    }

    /**
     * @see testMatchExecutionPoint()
     */
    public function testSetWeaveMethodNamePattern()
    {
    	$this->testMatchExecutionPoint();
    }

    /**
     * @see testMatchExecutionPoint()
     */
    public function testWeaveMethodNamePattern()
    {
    	$this->testMatchExecutionPoint();
    }

    /**
     * @see testMatchExecutionPoint()
     */
    public function testWeaveMethodNameRegexp()
    {
    	$this->testMatchExecutionPoint();
    }
}
?>
