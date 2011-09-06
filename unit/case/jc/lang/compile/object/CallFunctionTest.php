<?php
namespace jc\test\unit\testcase\jc\lang\compile\object;


use jc\lang\compile\object\CallFunction ;
use jc\lang\compile\object\Token;

/**
 * Test class for jc\lang\compile\object\CallFunction.
 * @for jc\lang\compile\object\CallFunction
 */
class CallFunctionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\lang\compile\object\CallFunction
     */
    protected $aCallFunction;

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

    /**
     * @see testArgvToken()
     */
    public function testSetArgvToken()
    {
    	$this->testArgvToken();
    }

    public function testArgvToken()
    {
    	$aFunctionNameToken = new Token( T_STRING , 'FunctionNameA' , 0);
    	$aArgToken = new Token( T_STRING , '"test"' , 0);
    	$aCallFunction = new CallFunction( $aFunctionNameToken, $aArgToken);
    	$this->assertEquals( $aArgToken , $aCallFunction->argvToken());
    }

    /**
     * @see testClassToken()
     */
    public function testSetClassToken()
    {
    	$this->testClassToken();
    }

    public function testClassToken()
    {
    	$aFunctionNameToken = new Token( T_STRING , 'FunctionNameA' , 0);
    	$aClassNameToken = new Token( T_CLASS , 'class ClassNameA{}' , 0);
    	$aCallFunction = new CallFunction( $aFunctionNameToken, new Token( T_STRING , '"test"' , 0) , $aClassNameToken);
    	$this->assertEquals( $aClassNameToken , $aCallFunction->classToken());
    }

    /**
     * @see testAccessToken()
     */
    public function testSetAccessToken()
    {
        $this->testAccessToken();
    }

    public function testAccessToken()
    {
    	$aFunctionNameToken = new Token( T_STRING , 'FunctionNameA' , 0);
    	$aAccessToken = new Token( T_STRING , '::' , 0);
    	$aCallFunction = new CallFunction( $aFunctionNameToken, new Token( T_STRING , '"test"' , 0)  , null , $aAccessToken );
    	$this->assertEquals( $aAccessToken , $aCallFunction->accessToken());
    }
}
?>
