<?php 
namespace jc\test\integration\mvc ;

// 
use jc\mvc\view\DataExchanger;

use jc\mvc\model\db\Model;

use jc\message\Message;
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
		$this->view->addWidget(new Text('username',"用户名"))->dataVerifiers()->add(
			new Length(1, 2)
		) ;
		$this->view->dataExchanger()->link('username','username') ;
		
		
		
		$this->aModel = new Model(array(
				'name' => 'feed' ,
				'keys' => 'feedid' ,
				'table' => 'myspace_feed' ,
		
				'belongsTo' => array(
					array(
						'prop' => 'user' ,
						'fromk' => 'uid' ,
						'tok' => 'uid' ,
						'model' => array(
							'name' => 'user' ,
							'keys' => 'uid' ,
							'table' => 'myspace_space' ,
						) ,
					) ,
				) ,
				
				'hasAndBelongsMany' => array(
					array(
						'prop' => 'buffs' ,
						'fromk' => 'uid' ,
						'btok' => 'uid' ,	
						'bfromk' => 'buffid' ,
						'tok' => 'id' ,
						'bridge' => 'myspace_mbuff' ,
					
						'model' => array(
							'name' => 'buff' ,
							'keys' => 'id' ,
							'table' => 'myspace_buff' ,
						) ,
					)
				),
		),true) ;
		$this->view->setModel($this->aModel) ;
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