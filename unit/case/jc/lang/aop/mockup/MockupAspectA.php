<?php
namespace jc\test\unit\testcase\jc\lang\aop\mockup ;


use jc\lang\aop\JointPoint;

class MockupAspectA
{	
	public function __construct($paramterA=null,$paramterB=null)
	{
	}
	
	/**
	 * @pointcut
	 */
	public function someWorks()
	{
		return array(
			JointPoint::createCallFunction('xxx','ooo') ,
			JointPoint::createAccessProperty('*','OooXxx') ,
			JointPoint::createNewObject('OooXxx') ,
			JointPoint::createThrowException('OooXxx') ,
		) ;
	}
	
	/**
	 * @pointcut
	 */
	public function otherWorks($paramterA=null)
	{
		
	}
	
	/**
	 * @pointcut
	 */
	private function otherWorksA($paramterA=null)
	{
		
	}
	
	static public function otherWorksB()
	{
		
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