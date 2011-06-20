<?php
namespace jc\test\integration\widget;

use jc\mvc\view\DataExchanger;
use jc\mvc\model\db\Model;
use jc\message\Message;
use jc\verifier\Length;
use jc\verifier\Same;
use jc\verifier\Email;
use jc\verifier\NotNull;
use jc\mvc\view\widget\CheckBtn;
use jc\mvc\view\widget\Select;
use jc\mvc\view\widget\SelectList;
use jc\mvc\view\widget\Group;
use jc\mvc\view\widget\RadioGroup;
use jc\mvc\view\widget\Text;
use jc\mvc\view\widget\FileUpdate;
use jc\mvc\controller\Controller;
use jc\mvc\view\View;
use jc\ui\xhtml\Factory as UIFactory;

$t = microtime ( true );

$aApp = require_once dirname ( __DIR__ ) . '/jcat_init.php';

class WidgetController extends Controller {
	protected function init() {
		$this->createView ( "widgetTestView", "widget-test.template.html", 'jc\\mvc\\view\\FormView' );
		
		///测试group代码 , 模拟用户注册
		$username = new Text ( 'username', '用户名', Text::TEXT );
		$this->widgetTestView->addWidget ( $username )->dataVerifiers ()->add ( Length::flyweight ( 2, 3 ) );
		$email = new Text ( 'email', '邮件', Text::TEXT );
		$this->widgetTestView->addWidget ( $email )->dataVerifiers ()->add ( Length::flyweight ( 6, 13 ) )->add ( Email::singleton () );
		$password1 = new Text ( 'password1', '确认密码1', Text::PASSWORD );
		$this->widgetTestView->addWidget ( $password1 )->dataVerifiers ()->add ( Length::flyweight ( 6, 8 ) );
		$password2 = new Text ( 'password2', '确认密码2', Text::PASSWORD );
		$this->widgetTestView->addWidget ( $password2 )->dataVerifiers ()->add ( Length::flyweight ( 6, 8 ) );
		$group = new Group ( 'passwordGroup', '密码核对' );
		$group->addWidget ( $password1 );
		$group->addWidget ( $password2 );
		$this->widgetTestView->addWidget ( $group )->dataVerifiers ()->add ( Same::singleton (), "两次输入的密码不相等" );
		
		$select = new Select ( 'select', '选择省', 1 );
		$select->addOption ( null, "请选择...", true );
		$select->addOption ( "fda", "342" );
		$select->addOption ( "asf", "fdsa" );
		$select->addOption ( "fda", "543" );
		$select->addOption ( "fdffa", "fdsa" );
		$select->addOption ( "selectvalue", "selectvalue" );
		$select->addOption ( "5434", "fvfvasf" );
		$select->addOption ( "fdasf", "fda" );
		$this->widgetTestView->addWidget ( $select )->dataVerifiers ()->add ( NotNull::singleton (), "请选择省" );
		
		$selectlist = new SelectList ( 'selectlist', '选择城市', 6 );
		$selectlist->addOption ( "fda1", "342" );
		$selectlist->addOption ( "asf2", "fdsa" );
		$selectlist->addOption ( "selectlistvalue3", "selectlistvalue");
		$selectlist->addOption ( "fda4", "543" );
		$selectlist->addOption ( "fda5", "fdsa" );
		$selectlist->addOption ( "543a6", "fvfvasf" );
		$selectlist->addOption ( "fdafadsf7", "fda" );
		$this->widgetTestView->addWidget ( $selectlist )->dataVerifiers ()->add ( NotNull::singleton (), "请选择城市" );
		
		$checkbox1 = new CheckBtn ( 'checkbox1', '电影', CheckBtn::CHECKBOX, 'movie' );
		$this->widgetTestView->addWidget ( $checkbox1 );
		
		$checkbox2 = new CheckBtn ( 'checkbox2', '足球', CheckBtn::CHECKBOX, 'football' );
		$this->widgetTestView->addWidget ( $checkbox2 );
		
		$fileupdate = new FileUpdate ( 'fileupdate', '文件上传' );
		$this->widgetTestView->addWidget ( $fileupdate );
	}
	
	public function process() {
		if ($this->widgetTestView->isSubmit ( $this->aParams )) {
			do {
				$this->widgetTestView->loadWidgets ( $this->aParams );
				
				if (! $this->widgetTestView->verifyWidgets ()) {
					$aMsgQueue = $this->messageQueue ();
					$this->widgetTestView->render ();
					return;
				}
				
				$this->widgetTestView->exchangeData ( DataExchanger::WIDGET_TO_MODEL );
				
				new Message ( Message::success, "表单提交完成" );
			
			} while ( 0 );
		} 

		else {
			$this->widgetTestView->render ();
		}
	
	}
}

$aController = new WidgetController ();
$aController->mainRun ( $aApp->request () );
echo microtime ( true ) - $t, "\r\n";
echo (memory_get_peak_usage () / 1024 / 1024), "mb\r\n";

?>