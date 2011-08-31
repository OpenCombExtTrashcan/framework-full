<?php
namespace jc\test\unit\testcase\jc\lang\aop;


use jc\lang\aop\Advice;

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
    	$sAspectNameA = 'jc\\test\\unit\\testcase\\jc\\lang\\aop\\mockup\\MockupAspectA' ;
    	$sAspectNameB = 'jc\\test\\unit\\testcase\\jc\\lang\\aop\\mockup\\MockupAspectB' ;
    	
		$aAspectFileA = Application::singleton()->classLoader()->searchClass($sAspectNameA) ;
		$aAspectFileB = Application::singleton()->classLoader()->searchClass($sAspectNameB) ;
		
		$aClassCompiler = CompilerFactory::singleton()->create() ;
		$aTokenPoolForAspectA = $aClassCompiler->interpret( $aAspectFileA->openReader() ) ;
		$aTokenPoolForAspectB = $aClassCompiler->interpret( $aAspectFileB->openReader() ) ;
		
		$aAspect = Aspect::createFromToken($aTokenPoolForAspectA->findClass($sAspectNameA)) ;
		
		// pointcuts and advices
		// ---------------
		$aPointcutIter = $aAspect->pointcuts()->iterator() ;
		
		// 第一项 pointcut ----------
		$aPointcut = $aPointcutIter->current() ;
		$this->assertEquals('someWorks',$aPointcut->name()) ;
		//  插入了 2 个 advice。 注意， "log" 没有申明 advice ，所以没有被当作一个 Advice，实际编译过程中被编译器忽略 
		$aAdviceIter = $aPointcut->advices()->iterator() ;
		$aAdvice = $aAdviceIter->current() ;
		$this->assertEquals('auth',$aAdvice->name()) ;
		$this->assertEquals(Advice::after,$aAdvice->position()) ;
		
		$aAdviceIter->next() ;
		$aAdvice = $aAdviceIter->current() ;
		$this->assertEquals('codeCoverage',$aAdvice->name()) ;
		$this->assertEquals(Advice::before,$aAdvice->position()) ;
		
		$aAdviceIter->next() ;
		$aAdvice = $aAdviceIter->current() ;
		$this->assertNull($aAdvice) ;
		
		
		// 第二项 pointcut ----------
		$aPointcutIter->next() ;
		$aPointcut = $aPointcutIter->current() ;
		$this->assertEquals('otherWorks',$aPointcut->name()) ;
		//  没有插入 advice
		$aAdviceIter = $aPointcut->advices()->iterator() ;
		$aAdvice = $aAdviceIter->current() ;
		$this->assertNull($aAdvice) ;
		
		
		// 第三项 pointcut ----------
		$aPointcutIter->next() ;
		$aPointcut = $aPointcutIter->current() ;
		$this->assertEquals('otherWorksA',$aPointcut->name()) ;
		//  插入了 1 个 advice
		$aAdviceIter = $aPointcut->advices()->iterator() ;
		$aAdvice = $aAdviceIter->current() ;
		$this->assertEquals('codeCoverage',$aAdvice->name()) ;
		$this->assertEquals(Advice::before,$aAdvice->position()) ;
		
		$aAdviceIter->next() ;
		$aAdvice = $aAdviceIter->current() ;
		$this->assertNull($aAdvice) ;
		
		
		// 没有了 ----------
		$aPointcutIter->next() ;
		$aPointcut = $aPointcutIter->current() ;
		$this->assertNull($aPointcut) ;
		
		
    }

    /**
     * @todo Implement testPointcuts().
     */
    public function testPointcuts()
    {
    	$aAspect = new Aspect ;
    	
    	$this->assertInstanceOf("jc\\pattern\\composite\\IContainer", $aAspect->pointcuts()) ;
    }
}
?>