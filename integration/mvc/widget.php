<?php 
namespace jc\test\integration\widget ;

use jc\mvc\view\DataExchanger;
use jc\mvc\model\db\Model;
use jc\message\Message;
use jc\verifier\Length;
use jc\verifier\Same;
use jc\verifier\Email;
use jc\mvc\view\widget\CheckBtn;
use jc\mvc\view\widget\Select;
use jc\mvc\view\widget\Group;
use jc\mvc\view\widget\RadioGroup;
use jc\mvc\view\widget\Text;
use jc\mvc\controller\Controller;
use jc\mvc\view\View;
use jc\ui\xhtml\Factory as UIFactory ;

$t = microtime(true) ;

$aApp = require_once dirname(__DIR__).'/jcat_init.php' ;

class WidgetController extends Controller
{
	protected function init()
	{
		$this->createView("widgetTestView","widget-test.template.html",'jc\\mvc\\view\\FormView') ;
		
		///测试group代码 , 模拟用户注册
		$username = new Text('username' , '用户名' ,Text::TEXT);
		$this->widgetTestView->addWidget ( $username )->dataVerifiers()->add(
			Length::flyweight(2 , 3)
		);
		$email = new Text('email' , '邮件' ,Text::TEXT);
		$this->widgetTestView->addWidget ( $email )->dataVerifiers()->add(
			Length::flyweight(6 , 13)
		)->add(
			Email::singleton()
		);
		$password1 = new Text('password1' , '确认密码1' ,Text::PASSWORD);
		$this->widgetTestView->addWidget ( $password1 )->dataVerifiers()->add(
			Length::flyweight(6,8) 
		);
		$password2 = new Text('password2' , '确认密码2' ,Text::PASSWORD);
		$this->widgetTestView->addWidget ( $password2 )->dataVerifiers()->add(
			Length::flyweight(6,8)
		);
		$group = new Group('passwordGroup' , '密码核对');
		$group->addWidget($password1);
		$group->addWidget($password2);
		$this->widgetTestView->addWidget ( $group )->dataVerifiers()->add(
			Same::singleton(), "两次输入的密码不相等"
		);
		
		$select = new Select('select' , '选择居住地' ,1,false);
		$this->widgetTestView->addWidget ( $select )->dataVerifiers()->add(
			NotNull::singleton(), "请选择居住地"
		);
		
		$checkbox1 = new CheckBtn('checkbox1', '电影' , CheckBtn::CHECKBOX , 'movie');
		$this->widgetTestView->addWidget ( $checkbox1 );
		
		$checkbox2 = new CheckBtn('checkbox2', '足球' , CheckBtn::CHECKBOX , 'football');
		$this->widgetTestView->addWidget ( $checkbox1 );
	}
	
public function process()
	{
		if( $this->widgetTestView->isSubmit($this->aParams) )
		{
			do{
				$this->widgetTestView->loadWidgets($this->aParams) ;
				
				if( !$this->widgetTestView->verifyWidgets() )
				{
					$aMsgQueue = $this->messageQueue() ;
					$this->widgetTestView->render() ;
					return ;
				}
			
				$this->widgetTestView->exchangeData(DataExchanger::WIDGET_TO_MODEL) ;
				
				new Message(Message::success,"表单提交完成") ;
				
			} while(0) ;
		}
		
		else 
		{
			$this->widgetTestView->render() ;
		}

	}
} 

$aController = new WidgetController() ;
$aController->mainRun( $aApp->request() ) ;
echo microtime(true) - $t, "\r\n" ;
echo (memory_get_peak_usage()/1024/1024), "mb\r\n" ;

?>