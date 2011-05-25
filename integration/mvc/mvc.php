<?php 
namespace jc\test\integration\mvc ;

// 
use jc\mvc\controller\Controller;
use jc\mvc\view\View;
use jc\ui\xhtml\Factory as UIFactory ;

$t = microtime(true) ;

$aApp = require_once dirname(__DIR__).'/jcat_init.php' ;

class MyChildController extends Controller
{
	protected function init()
	{
		$this->createView("childControllerView","simple-text.template.html") ;
	}
	
	public function process()
	{
		$this->childControllerView->render() ;
	}
} 

class MyController extends Controller
{
	protected function init()
	{
		$this->createView("view","simple-text.template.html") ;
		
		$this->add( new MyChildController() ) ;
	}
	
	public function process()
	{
		$this->view->render() ;
	}
} 

$aController = new MyController() ;
$aController->mainRun() ;

echo microtime(true) - $t, "\r\n" ;
echo (memory_get_peak_usage()/1024/1024), "mb\r\n" ;
?>