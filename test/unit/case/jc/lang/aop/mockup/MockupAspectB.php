<?php
namespace jc\test\unit\testcase\jc\lang\aop\mockup ;


class MockupAspectB
{	
	public function __construct($paramterA,$paramterB)
	{
		
	}
	
	public function someWorks()
	{
		
	}

	public function otherWorksA($paramterA,$paramterB)
	{
		
	}
	
	static private function otherWorksB()
	{
		
	}
	
	static public function otherWorksC()
	{
		
	}

	/**
	 * @advice someWorks
	 */
	public function auth()
	{
		
	}
	
	/**
	 * @advice someWorks
	 */
	public function log()
	{
		
	}

	/**
	 * @advice befoer
	 */
	public function codeCoverage()
	{
		
	}
}

?>