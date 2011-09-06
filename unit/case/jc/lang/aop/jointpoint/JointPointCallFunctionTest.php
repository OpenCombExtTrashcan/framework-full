<?php
namespace jc\test\unit\testcase\jc\lang\aop\jointpoint;


use jc\lang\aop\jointpoint\JointPointCallFunction ;
use jc\lang\compile\CompilerFactory;
use jc\io\InputStreamCache;
use jc\lang\compile\object\ClassDefine;

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
//        $this->aJointPointCallFunction = new JointPointCallFunction ;
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
					$this->callFunctionNameB();
					$this->callFunctionNameB($arg1, $arg2);
					callFunctionNameA();
					callFunctionNameA("text",2,true);
					ClassNameA::callFunctionNameB();
					ClassNameA::callFunctionNameB("text",2,true);
				}
				public function FunctionNameB()
				{
					$this->callFunctionNameB();
					$this->callFunctionNameB($arg1, $arg2);
					callFunctionNameA();
					callFunctionNameA("text",2,true);
					ClassNameA::callFunctionNameB();
					ClassNameA::callFunctionNameB("text",2,true);
				}
			}
			' ;
		$aClassCompiler = CompilerFactory::singleton()->create() ;
		$aCompilerInput = new InputStreamCache($sMockupCode) ;
		
		$aTokenPool = $aClassCompiler->scan( $aCompilerInput ) ;
		$aClassCompiler->interpret( $aTokenPool ) ;
		
    	$this->assertTrue(
    		JointPointCallFunction::createInstance(array('callFunctionNameA','package\\name\\aaa\\ClassNameA','FunctionNameA'))->matchExecutionPoint(
				$aTokenPool->findFunction('FunctionNameA','package\\name\\aaa\\ClassNameA')
			)
		) ;
		
		$this->assertTrue(
    		JointPointCallFunction::createInstance(array('callFunctionNameA','package\\name\\aaa\\ClassNameA','FunctionName'))->matchExecutionPoint(
				$aTokenPool->findFunction('FunctionNameA','package\\name\\aaa\\ClassNameA')
			)
		) ;
    	
    	$this->assertFalse(
    		JointPointCallFunction::createInstance(array('callFunctionNameA','package\\name\\aaa\\ClassNameA','FunctionNameA'))->matchExecutionPoint(
//				get
			)
		) ;
    	
		// 使用通配符
		$aJointPointCallFunction = JointPointCallFunction::createInstance(array('callFunctionNameA','package\\name\\aaa\\ClassNameA','FunctionName*')) ;
    	$this->assertTrue(
    		$aJointPointCallFunction->matchExecutionPoint(
				$aTokenPool->findFunction('callFunctionNameA','package\\name\\aaa\\ClassNameA')
			)
		) ;
    	$this->assertTrue(
    		$aJointPointCallFunction->matchExecutionPoint(
				$aTokenPool->findFunction('callFunctionNameA','package\\name\\aaa\\ClassNameA')
			)
		) ;
    }
}
?>
