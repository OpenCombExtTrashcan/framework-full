<?php 
namespace jc\test\integration\mvc ;

// 
use jc\mvc\view\DataExchanger;

use jc\mvc\model\db\Model;

use jc\message\Message;
use jc\verifier\Length;
use jc\mvc\view\widget\CheckBtn;
use jc\mvc\view\widget\Select;
use jc\mvc\view\widget\Group;
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
		
		$radio = new CheckBtn('radio' , 'radiotest' , CheckBtn::RADIO);
		$this->view->addWidget ( $radio );
		$radio->setValue('radio');
		
		$checkbox = new CheckBtn('checkbox' , 'radiotest' , CheckBtn::CHECKBOX);
		$this->view->addWidget ( $checkbox );
		$checkbox->setValue('checkboxValue');
		
		$select = new Select ( 'select', '选择国家' );
		$this->view->addWidget ( $select );
		$select->addOption('a', 1);
		$select->addOption('b', 2);
		$select->addOption('c', 3);
		$select->addOption('d', 4);
		$select->setSize(4);
		$select->setValueFromString ( "selectValueTest" );
		
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
		$values = $group2->valueToString();
		$group2->setValueFromString($values);
		var_dump($group->valueToString());
		exit();
		
		
//		var_dump($group2->valueToString());
//		exit();
		
//		
//		$this->aModel = new Model(array(
//				'name' => 'feed' ,
//				'keys' => 'feedid' ,
//				'table' => 'myspace_feed' ,
//		
//				'belongsTo' => array(
//					array(
//						'prop' => 'user' ,
//						'fromk' => 'uid' ,
//						'tok' => 'uid' ,
//						'model' => array(
//							'name' => 'user' ,
//							'keys' => 'uid' ,
//							'table' => 'myspace_space' ,
//						) ,
//					) ,
//				) ,
//				
//				'hasAndBelongsMany' => array(
//					array(
//						'prop' => 'buffs' ,
//						'fromk' => 'uid' ,
//						'btok' => 'uid' ,	
//						'bfromk' => 'buffid' ,
//						'tok' => 'id' ,
//						'bridge' => 'myspace_mbuff' ,
//					
//						'model' => array(
//							'name' => 'buff' ,
//							'keys' => 'id' ,
//							'table' => 'myspace_buff' ,
//						) ,
//					)
//				),
//		),true) ;
//		$this->view->setModel($this->aModel) ;
		
		
		
		
		
		
	}
	
	public function process()
	{
		// print_r($this->aParams) ;
		if( $this->view->isSubmit($this->aParams) )
		{
			do{
				$this->view->loadWidgets($this->aParams) ;
				
				if( !$this->view->verifyWidgets() )
				{
					$aMsgQueue = $this->messageQueue() ;
					$this->view->render() ;
					return ;
				}
			
				$this->view->exchangeData(DataExchanger::WIDGET_TO_MODEL) ;
				
				
				new Message(Message::success,"表单提交完成") ;
				
			} while(0) ;			
		}
		
		else 
		{
			$this->view->render() ;
		}
	}
} 

$aController = new MyController() ;
$aController->mainRun( $aApp->request() ) ;


echo microtime(true) - $t, "\r\n" ;
echo (memory_get_peak_usage()/1024/1024), "mb\r\n" ;
?>