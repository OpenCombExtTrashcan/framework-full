<?php
namespace jc\test\integration\mvc;

echo get_current_user() ;

use jc\mvc\view\widget\Select;
use jc\mvc\view\widget\Text;
use jc\mvc\view\widget\CheckBtn;
use jc\mvc\view\widget\Group;
use jc\verifier\Email;
use jc\mvc\controller\Controller;
use jc\mvc\view\View;
use jc\ui\xhtml\Factory as UIFactory;

$t = microtime ( true );

$aApp = require_once dirname ( __DIR__ ) . '/jcat_init.php';

class MyController extends Controller {
	protected function init() {
		$this->createView ( "view", "simple-text.template.html", 'jc\\mvc\\view\\FormView' );
		
		$radio = new CheckBtn('radio' , 'radiotest' , CheckBtn::RADIO);
		$this->view->addWidget ( $radio );
		
		$checkbox = new CheckBtn('checkbox' , 'radiotest' , CheckBtn::CHECKBOX);
		$this->view->addWidget ( $checkbox );
		
		$select = new Select ( 'select', '选择国家' );
		$this->view->addWidget ( $select );
		$select->setValueFromString ( "selectValueTest" );
		$select->addOption('a', 1);
		$select->addOption('b', 2);
		$select->addOption('c', 3);
		$select->addOption('d', 4);
		$select->setSize(4);
		
		$group = new Group('group' , 'testGroup');
		$this->view->addWidget ( $group );
		$group->addWidget($radio);
		$group->addWidget($checkbox);
		$group->addWidget($select);
		
		$checkbox2 = new CheckBtn('checkbox2' , 'radiotest' , CheckBtn::CHECKBOX);
		$this->view->addWidget ( $checkbox2 );
		
		$group2 = new Group('group2' , 'testGroup');
		$this->view->addWidget ( $group2 );
		$group2->addWidget($checkbox2);
		$group2->addWidget($group);
		var_dump($group2->valueToString());
		exit();
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