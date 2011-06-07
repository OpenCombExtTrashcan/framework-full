<?php 
namespace jc\test\integration\mvc ;

// 
use jc\verifier\Length;
use jc\mvc\view\widget\Text;
use jc\mvc\controller\Controller;
use jc\mvc\view\View;
use jc\ui\xhtml\Factory as UIFactory ;

$t = microtime(true) ;

$aApp = require_once dirname(__DIR__).'/jcat_init.php' ;

class MyController extends Controller
{
	protected function init()
	{
		$this->createView("view","simple-text.template.html",'jc\\mvc\\view\\FormView') ;
		$this->view->addWidget(new Text('username'))->dataVerifiers()->add(
			new Length(1, 2)
		) ;
	}
	
	public function process()
	{
		// print_r($this->aParams) ;
		if( $this->view->isSubmit($this->aParams) )
		{
			$this->view->loadWidgets($this->aParams) ;
			
			if( !$this->view->verifyWidgets() )
			{
				
			}
			
		}
		
		else 
		{
		}
		
		$this->view->render() ;
	}
} 

$aController = new MyController() ;
$aController->mainRun( $aApp->request() ) ;


echo microtime(true) - $t, "\r\n" ;
echo (memory_get_peak_usage()/1024/1024), "mb\r\n" ;
?>