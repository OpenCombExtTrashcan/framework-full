<?php
namespace jc\test\unit\testcase\jc\lang\aop\compiler;


use jc\io\OutputStreamBuffer;

use jc\lang\aop\Advice;

use jc\io\InputStreamCache;

use jc\lang\aop\jointpoint\JointPointMethodDefine;

use jc\lang\aop\Pointcut;

use jc\lang\aop\Aspect;

use jc\lang\aop\AOP;

use jc\lang\compile\CompilerFactory;

use jc\system\Application;

use jc\lang\aop\compiler\FunctionDefineGenerator ;

/**
 * Test class for jc\lang\aop\compiler\FunctionDefineGenerator.
 * @for jc\lang\aop\compiler\FunctionDefineGenerator
 */
class FunctionDefineGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\lang\aop\compiler\FunctionDefineGenerator
     */
    protected $aFunctionDefineGenerator;

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
    {}

    /**
     * @todo Implement testGenerateTargetCode().
     */
    public function testGenerateTargetCode()
    {
    	$aAop = new AOP() ;
    	$aAop->register("jc\\test\\unit\\testcase\\jc\\lang\\aop\\compiler\\mockup\\MockupAspectForFunctionDefine") ;
    			
		
    	$aFunctionDefineGenerator = new FunctionDefineGenerator() ;
    	$aFunctionDefineGenerator->setAop($aAop) ;
    	
    	$sClassDefine = "
<?php
namespace package\\name ;
    	
class ClassA
{
	function someMethodA(\$argv1,array \$argv1=array())
	{
		echo __METHOD__ ;
	}
}

?>
" ;

		$aClassCompiler = CompilerFactory::singleton()->create() ;
		$aTokenPool = $aClassCompiler->scan( new InputStreamCache($sClassDefine) ) ;
		$aClassCompiler->interpret( $aTokenPool ) ;
    	
		$aFunctionDefineGenerator->generateTargetCode(
			$aTokenPool, $aTokenPool->findFunction('someMethodA','package\\name\\ClassA')
		) ;
		

		// 编译结果写入文件
		$aCompiledStream = new OutputStreamBuffer() ;
		foreach($aTokenPool->iterator() as $aToken)
		{
			$aCompiledStream->write($aToken->targetCode()) ;
		}
		echo $aCompiledStream->bufferBytes() ;
    	
    }

    /**
     * @todo Implement testAop().
     */
    public function testAop()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
}
?>
