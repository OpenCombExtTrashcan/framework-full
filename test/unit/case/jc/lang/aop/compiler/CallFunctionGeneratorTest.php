<?php
namespace jc\test\unit\testcase\jc\lang\aop\compiler;


use jc\io\OutputStreamBuffer;
use jc\io\InputStreamCache;
use jc\lang\compile\CompilerFactory;
use jc\lang\aop\AOP;
use jc\lang\aop\compiler\CallFunctionGenerator ;

/**
 * Test class for jc\lang\aop\compiler\CallFunctionGenerator.
 * @for jc\lang\aop\compiler\CallFunctionGenerator
 */
class CallFunctionGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\lang\aop\compiler\CallFunctionGenerator
     */
    protected $aCallFunctionGenerator;

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
    	$aAop->register("jc\\test\\unit\\testcase\\jc\\lang\\aop\\compiler\\mockup\\MockupAspectForCallFunction") ;
    		
		
    	$aFunctionDefineGenerator = new CallFunctionGenerator() ;
    	$aFunctionDefineGenerator->setAop($aAop) ;
    	
    	$sClassDefine = "
<?php
namespace package\\name ;
    	
class ClassA
{
	function someMethodA(\$argv1,array \$argv1=array())
	{
		callSomeFunctionA(\$argv1) ;
		callSomeFunctionA() ;
	}
}

?>
" ;
    	
		$aClassCompiler = CompilerFactory::singleton()->create() ;
		$aTokenPool = $aClassCompiler->scan( new InputStreamCache($sClassDefine) ) ;
		$aClassCompiler->interpret( $aTokenPool ) ;
    	
		// 切入第1个 callSomeFunctionA
		$aFunctionDefineGenerator->generateTargetCode(
			$aTokenPool, $aTokenPool->findTokenBySource('callSomeFunctionA')
		) ;
		// 切入第2个 callSomeFunctionA
		$aFunctionDefineGenerator->generateTargetCode(
			$aTokenPool, $aTokenPool->findTokenBySource('callSomeFunctionA')
		) ;
		

		// 编译结果写入文件
		$aCompiledStream = new OutputStreamBuffer() ;
		foreach($aTokenPool->iterator() as $aToken)
		{
			$aCompiledStream->write($aToken->targetCode()) ;
		}
		echo $aCompiledStream->bufferBytes() ;
    	
    }
    
}
?>
