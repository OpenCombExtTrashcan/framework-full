<?php 
namespace jc\test\integration\mvc ;

// 
use jc\mvc\view\widget\CheckBtn;

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
		
		$checkbox1 = new CheckBtn('radio1','编辑区域',CheckBtn::RADIO ,CheckBtn::CHEACKED);
		$this->view->addWidget($checkbox1)->dataVerifiers()->add(
			new Length(6, 20)
		);
		$checkbox1->setValueFromString("fdfsfds1");
		$checkbox1->setFormName('name');
		
		$checkbox2 = new CheckBtn('radio2','编辑区域',CheckBtn::RADIO ,CheckBtn::CHEACKED);
		$this->view->addWidget($checkbox2)->dataVerifiers()->add(
			new Length(6, 20)
		);
		$checkbox2->setValueFromString("fdfsfds2");
		$checkbox2->setFormName('name');
		
		$checkbox3 = new CheckBtn('radio3','编辑区域',CheckBtn::RADIO ,CheckBtn::CHEACKED);
		$this->view->addWidget($checkbox3)->dataVerifiers()->add(
			new Length(6, 20)
		);
		$checkbox3->setValueFromString("fdfsfds3");
		$checkbox3->setFormName('name');
		
		$checkbox4 = new CheckBtn('radio4','编辑区域',CheckBtn::RADIO ,CheckBtn::CHEACKED);
		$this->view->addWidget($checkbox4)->dataVerifiers()->add(
			new Length(6, 20)
		);
		$checkbox4->setValueFromString("fdfsfds4");
		$checkbox4->setFormName('name');
		
		$checkbox5 = new CheckBtn('radio5','编辑区域',CheckBtn::RADIO ,CheckBtn::CHEACKED);
		$this->view->addWidget($checkbox5)->dataVerifiers()->add(
			new Length(6, 20)
		);
		$checkbox5->setValueFromString("fdfsfds5");
		$checkbox5->setFormName('name');
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