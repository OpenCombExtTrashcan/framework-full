<?php
namespace jc\test\unit\testcase\jc\lang\aop;


use jc\lang\aop\AOP ;

/**
 * Test class for jc\lang\aop\AOP.
 * @for jc\lang\aop\AOP
 */
class AOPTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\lang\aop\AOP
     */
    protected $aAOP;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->aAOP = new AOP ;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @todo Implement testAspects().
     */
    public function testAspects()
    {
		$this->assertTrue( $this->aAOP->aspects() instanceof IContainer ) ;
    }

    /**
     * @todo Implement testJointPointIterator().
     */
    public function testJointPointIterator()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testRegister().
     */
    public function testRegister()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testWeave().
     */
    public function testWeave()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testCreateClassCompiler().
     */
    public function testCreateClassCompiler()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testClassLoader().
     */
    public function testClassLoader()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testSetClassLoader().
     */
    public function testSetClassLoader()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
}
?>
