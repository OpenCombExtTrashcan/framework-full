<?php
namespace jc\toolkit ;

use jc\mvc\controller\Controller;

class Help extends Controller
{
	protected function init()
	{
		$this->createView('txt','Help.txt') ;
	}
}

?>