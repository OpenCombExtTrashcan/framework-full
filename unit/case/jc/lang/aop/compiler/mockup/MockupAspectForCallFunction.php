<?php
namespace jc\test\unit\testcase\jc\lang\aop\compiler\mockup ;

use jc\lang\aop\jointpoint\JointPointCallFunction ;

class MockupAspectForCallFunction
{
	/**
	 * @pointcut
	 */
	function someWorks()
	{
		return array(
			new JointPointCallFunction('callSomeFunction*','package\\\\name\\\\ClassA','someMethodA') ,
		) ;
	}
	    		
	/**
	 * @advice
	 * @for someWorks
	 */
	public function auth()
	{
		// define by Aspect::auth()
		echo __METHOD__ ;
	}	
	
	/**
	 * @advice around
	 * @for someWorks
	 */
	public function log()
	{
		// define by Aspect::log()
		echo __METHOD__, ": ", __LINE__ ;
		
		aop_call_origin_method() ;
		
		echo __METHOD__, ": ", __LINE__ ;
	}
		    		
	/**
	 * @advice before
	 * @for someWorks
	 */
	public function adviceA()
	{
		// TODO define by Aspect::adviceA()
	}	
		    		
	/**
	 * @advice around
	 * @for someWorks
	 */
	public function adviceB()
	{
		// TODO define by Aspect::adviceB()
		aop_call_origin_method() ;
	}			
	
	/**
	 * @advice after
	 * @for someWorks
	 */
	public function adviceC()
	{
		// TODO define by Aspect::adviceC()
		aop_call_origin_method() ;
	}	
}

?>