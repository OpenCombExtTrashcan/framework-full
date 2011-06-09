<?php
namespace jc\test\integration\mvc;

// 
use jc\mvc\view\widget\Select;
use jc\verifier\Length;
use jc\mvc\view\widget\Text;
use jc\mvc\controller\Controller;
use jc\mvc\view\View;
use jc\ui\xhtml\Factory as UIFactory;

$t = microtime ( true );

$aApp = require_once dirname ( __DIR__ ) . '/jcat_init.php';

class MyController extends Controller {
	protected function init() {
		$this->createView ( "view", "simple-text.template.html", 'jc\\mvc\\view\\FormView' );
		
		$select = new Select ( 'select', '选择国家' );
		$this->view->addWidget ( $select )->dataVerifiers ()->add ( new Length ( 6, 20 ) );
		$select->setValueFromString ( "selectValueTest" );
		$select->addOption('a', 1);
		$select->addOption('b', 2);
		$select->addOption('c', 3);
		$select->addOption('d', 4);
	}
	
	public function process() {
		// print_r($this->aParams) ;
		if ($this->view->isSubmit ( $this->aParams )) {
			$this->view->loadWidgets ( $this->aParams );
			
			if (! $this->view->verifyWidgets ()) {
			
			}
		
		} 

		else {
		}
		
		$this->view->render ();
	}
}

$aController = new MyController() ;
$aController->mainRun( $aApp->request() ) ;


echo microtime(true) - $t, "\r\n" ;
echo (memory_get_peak_usage()/1024/1024), "mb\r\n" ;
?>