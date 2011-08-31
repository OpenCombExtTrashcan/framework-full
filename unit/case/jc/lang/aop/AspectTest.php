<?php
namespace jc\test\unit\testcase\jc\lang\aop;


use jc\lang\compile\CompilerFactory;
use jc\system\Application ;
use jc\lang\aop\Aspect ;

/**
 * Test class for jc\lang\aop\Aspect.
 * @for jc\lang\aop\Aspect
 */
class AspectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\lang\aop\Aspect
     */
    protected $aAspect;

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
     * @todo Implement testCreateFromToken().
     */
    public function testCreateFromToken()
    {
		$aClassFile = Application::singleton()->classLoader()->searchClass('jc\\test\\unit\\testcase\\jc\\lang\\aop\\mockup\\MockupAspectA') ;
		
		$aClassCompiler = CompilerFactory::singleton()->create() ;
		$aTokenPool = $aClassCompiler->interpret( $aClassFile->openReader() ) ;

		$aClassToken = $aTokenPool->findClass('jc\\test\\unit\\testcase\\jc\\lang\\aop\\mockup\\MockupAspectA') ;
		Aspect::createFromToken($aClassToken) ;
		
		
    }

    /**
     * @todo Implement testPointcuts().
     */
    public function testPointcuts()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
}
?>