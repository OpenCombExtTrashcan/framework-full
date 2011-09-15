<?php
namespace jc\test\unit\testcase\jc\lang\aop\mockup ;

use jc\lang\compile\object\Token;
use jc\lang\aop\jointpoint\JointPoint;

class MockupJointPoint extends JointPoint
{
	public function __construct()
	{}
	
	public function matchExecutionPoint(Token $aToken)
	{
		return true ;
	}
}

?>