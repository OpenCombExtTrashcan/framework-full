<?php
namespace jc\test\unit\testcase\jc\lang\aop;


use jc\lang\Exception;
use jc\lang\compile\CompilerFactory;
use jc\system\Application ;
use jc\lang\compile\object\FunctionDefine;
use jc\lang\aop\Advice ;

/**
 * Test class for jc\lang\aop\Advice.
 * @for jc\lang\aop\Advice
 */
class AdviceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\lang\aop\Advice
     */
    protected $aAdvice;

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
    	$sAspectNameA = 'jc\\test\\unit\\testcase\\jc\\lang\\aop\\mockup\\MockupAspectA' ;
    	$sAspectNameB = 'jc\\test\\unit\\testcase\\jc\\lang\\aop\\mockup\\MockupAspectB' ;
    	
		$aAspectFileA = Application::singleton()->classLoader()->searchClass($sAspectNameA) ;
		$aAspectFileB = Application::singleton()->classLoader()->searchClass($sAspectNameB) ;
		
		$aClassCompiler = CompilerFactory::singleton()->create() ;
		$aTokenPoolForAspectA = $aClassCompiler->interpret( $aAspectFileA->openReader() ) ;
		$aTokenPoolForAspectB = $aClassCompiler->interpret( $aAspectFileB->openReader() ) ;
		
		// 默认 position
		$aAdvice = Advice::createFromToken($aTokenPoolForAspectA->findFunction('auth',$sAspectNameA)) ;
		$this->assertInstanceOf("jc\\lang\\aop\\Advice",$aAdvice) ;
		$this->assertEquals("auth", $aAdvice->name()) ;
		$this->assertEquals(Advice::after, $aAdvice->position()) ;
		
		// docComment 中无 advice 申明
		$aAdvice = Advice::createFromToken($aTokenPoolForAspectA->findFunction('log',$sAspectNameA)) ;
		$this->assertInstanceOf("jc\\lang\\aop\\Advice",$aAdvice) ;
		$this->assertEquals("log", $aAdvice->name()) ;
		$this->assertEquals(Advice::after, $aAdvice->position()) ;
		
		// 指定 position
		$aAdvice = Advice::createFromToken($aTokenPoolForAspectA->findFunction('profile',$sAspectNameA)) ;
		$this->assertInstanceOf("jc\\lang\\aop\\Advice",$aAdvice) ;
		$this->assertEquals("profile", $aAdvice->name()) ;
		$this->assertEquals(Advice::before, $aAdvice->position()) ;
		
		// 错误的 position
		$aAdvice = null ;
		$on = false ;
		try{
			$aAdvice = Advice::createFromToken($aTokenPoolForAspectB->findFunction('codeCoverage',$sAspectNameB)) ;
			$this->assertTrue(false,"没有触发预期中的异常") ;
		}
		catch (Exception $e)
		{
			$on = true ;
		}
		$this->assertTrue($on,"没有触发预期中的异常") ;
		$this->assertNull($aAdvice) ;

    }
}
?>
