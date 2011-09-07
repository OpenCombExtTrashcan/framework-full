<?php
namespace jc\test\unit\testcase\jc\lang\aop\compiler\mockup ;


use jc\lang\aop\JointPoint;

class MockupAspect
{	
	/**
	 * @pointcut
	 */
	public function someWorks()
	{
		return array(
			JointPoint::createMethodDefine('xxx','ooo') 
		) ;
	}

	/**
	 * @advice 
	 * @for someWorks
	 */
	public function auth()
	{
		
	}
	
	/**
	 * @for someWorks
	 * @for otherWorksA
	 */
	public function log()
	{
		
	}

	/**
	 * @advice before
	 */
	public function profile()
	{
		
	}


	/**
	 * @advice before
	 * @for someWorks
	 * @for otherWorksA
	 */
	public function codeCoverage()
	{
		
	}

}

?>