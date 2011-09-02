<?php
namespace jc\test\unit\testcase\jc\lang\aop\jointpoint;


use jc\lang\compile\CompilerFactory;
use jc\io\InputStreamCache;
use jc\lang\compile\object\ClassDefine;
use jc\lang\aop\jointpoint\JointPointMethodDefine ;

/**
 * Test class for jc\lang\aop\JointPointMethodDefine.
 * @for jc\lang\aop\JointPointMethodDefine
 */
class JointPointMethodDefineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\lang\aop\JointPointMethodDefine
     */
    protected $aJointPointMethodDefine;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {}

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @todo Implement testMatchExecutionPoint().
     */
    public function testMatchExecutionPoint()
    {
    	$sMockupCode = "<?php 
namespace package\\name\\aaa ;

class ClassNameA
{
	public function FunctionNameA()
	{
		
	}
	public function FunctionNameB()
	{
		
	}
}
" ;
		$aClassCompiler = CompilerFactory::singleton()->create() ;
		$aCompilerInput = new InputStreamCache($sMockupCode) ;
		
		$aTokenPool = $aClassCompiler->scan( $aCompilerInput ) ;
		$aClassCompiler->interpret( $aTokenPool ) ;

		
    	$this->assertTrue(
    		JointPointMethodDefine::createInstance(array('package\\name\\aaa\\ClassNameA','FunctionNameA'))->matchExecutionPoint(
				$aTokenPool->findFunction('FunctionNameA','package\\name\\aaa\\ClassNameA')
			)
		) ;
    	
		
    	$this->assertFalse(
    		JointPointMethodDefine::createInstance(array('package\\name\\aaa\\ClassNameA','FunctionNameA'))->matchExecutionPoint(
				$aTokenPool->findFunction('FunctionNameB','package\\name\\aaa\\ClassNameA')
			)
		) ;
    	
		
		// 使用通配符
		$aJointPointMethodDefine = JointPointMethodDefine::createInstance(array('package\\name\\aaa\\ClassNameA','FunctionName*')) ;
    	$this->assertTrue(
    		$aJointPointMethodDefine->matchExecutionPoint(
				$aTokenPool->findFunction('FunctionNameA','package\\name\\aaa\\ClassNameA')
			)
		) ;
    	$this->assertTrue(
    		$aJointPointMethodDefine->matchExecutionPoint(
				$aTokenPool->findFunction('FunctionNameB','package\\name\\aaa\\ClassNameA')
			)
		) ;
    	
    }
}
?>
