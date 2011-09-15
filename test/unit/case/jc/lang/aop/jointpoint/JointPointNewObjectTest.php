<?php
namespace jc\test\unit\testcase\jc\lang\aop\jointpoint;


use jc\lang\aop\jointpoint\JointPointNewObject ;
use jc\lang\compile\CompilerFactory;
use jc\io\InputStreamCache;
use jc\lang\compile\object\ClassDefine;
use jc\lang\compile\object\CallFunction;

/**
 * Test class for jc\lang\aop\jointpoint\JointPointNewObject.
 * @for jc\lang\aop\jointpoint\JointPointNewObject
 */
class JointPointNewObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\lang\aop\jointpoint\JointPointNewObject
     */
    protected $aJointPointNewObject;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
//        $this->aJointPointNewObject = new JointPointNewObject ;
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
					$aTestObject1 = new testObject();
					$aTestObject2 = new testObject("()",2,true);
					$aTestObject2 = new testObject("()",new testObject("()",1,false),true);
				}
				public function FunctionNameB()
				{
					$aTestObject1 = new testObject();
					$aTestObject2 = new testObject("()",2,true);
					$aTestObject2 = new testObject("()",new testObject("()",1,false),true);
				}
			}
			
			class testObject{}
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
    		JointPointNewObject::createInstance(array('callFunctionNameA','package\\name\\aaa\\ClassNameA','FunctionNameA'))->matchExecutionPoint(
    			$arrCallFucntionTokens[0]
			)
		) ;
		
		$this->assertTrue(
    		JointPointNewObject::createInstance(array('callFunctionNameA','package\\name\\aaa\\ClassNameA','FunctionNameB'))->matchExecutionPoint(
				$arrCallFucntionTokens[7]
			)
		) ;
    	
    	$this->assertTrue(
    		JointPointNewObject::createInstance(array('callFunctionNameB','package\\name\\aaa\\ClassNameA','FunctionNameA'))->matchExecutionPoint(
    			$arrCallFucntionTokens[2]
			)
		) ;
		
		$this->assertTrue(
    		JointPointNewObject::createInstance(array('callFunctionNameB','package\\name\\aaa\\ClassNameA','FunctionNameB'))->matchExecutionPoint(
    			$arrCallFucntionTokens[9]
			)
		) ;
		
    	$this->assertTrue(
    		JointPointNewObject::createInstance(array('callFunctionNameB','package\\name\\aaa\\ClassNameA','FunctionNameA'))->matchExecutionPoint(
    			$arrCallFucntionTokens[4]
			)
		) ;
		
		$this->assertTrue(
    		JointPointNewObject::createInstance(array('callFunctionNameB','package\\name\\aaa\\ClassNameA','FunctionNameB'))->matchExecutionPoint(
    			$arrCallFucntionTokens[11]
			)
		) ;
    	
		// 使用通配符
		
		$this->assertTrue(
    		JointPointNewObject::createInstance(array('callFunctionName*','package\\name\\aaa\\ClassNameA','FunctionNameA'))->matchExecutionPoint(
    			$arrCallFucntionTokens[0]
			)
		) ;
		
		$this->assertTrue(
    		JointPointNewObject::createInstance(array('*','package\\name\\aaa\\ClassNameA','FunctionNameA'))->matchExecutionPoint(
    			$arrCallFucntionTokens[1]
			)
		) ;
		
		$this->assertTrue(
    		JointPointNewObject::createInstance(array('callFunctionName*','package\\name\\aaa\\ClassNameA','FunctionNameA'))->matchExecutionPoint(
    			$arrCallFucntionTokens[2]
			)
		) ;
		
		$this->assertTrue(
    		JointPointNewObject::createInstance(array('*','package\\name\\aaa\\ClassNameA','FunctionNameA'))->matchExecutionPoint(
    			$arrCallFucntionTokens[3]
			)
		) ;
		
		$this->assertTrue(
    		JointPointNewObject::createInstance(array('callFunctionName*','package\\name\\aaa\\ClassNameA','FunctionNameA'))->matchExecutionPoint(
    			$arrCallFucntionTokens[4]
			)
		) ;
    }

//    /**
//     * @todo Implement testTransRegexp().
//     */
//    public function testTransRegexp()
//    {
//        // Remove the following lines when you implement this test.
//        $this->markTestIncomplete(
//          'This test has not been implemented yet.'
//        );
//    }
//
//    /**
//     * @todo Implement testNewObjectPattern().
//     */
//    public function testNewObjectPattern()
//    {
//        // Remove the following lines when you implement this test.
//        $this->markTestIncomplete(
//          'This test has not been implemented yet.'
//        );
//    }
//
//    /**
//     * @todo Implement testSetNewObjectRegexp().
//     */
//    public function testSetNewObjectRegexp()
//    {
//        // Remove the following lines when you implement this test.
//        $this->markTestIncomplete(
//          'This test has not been implemented yet.'
//        );
//    }
//
//    /**
//     * @todo Implement testSetNewObjectPattern().
//     */
//    public function testSetNewObjectPattern()
//    {
//        // Remove the following lines when you implement this test.
//        $this->markTestIncomplete(
//          'This test has not been implemented yet.'
//        );
//    }
}
?>
