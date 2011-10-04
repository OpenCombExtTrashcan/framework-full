<?php
namespace jc\test\integration ;

// 初始化 jcat 框架
use jc\system\ApplicationFactory;
use jc\session\OriginalSession;
use jc\session\Session;
use jc\db\DB;
use jc\db\driver\PDODriver;
use jc\ui\xhtml\UIFactory ;
use jc\system\AppFactory;

// ini_set('display_errors', 1);

include __DIR__."/../../framework/inc.entrance.php" ;

$aApp = ApplicationFactory::singleton()->create(__DIR__) ;

// UI
UIFactory::singleton()->sourceFileManager()->addFolder($aApp->fileSystem()->findFolder('/templates')) ;
//UIFactory::singleton()->sourceFileManager()->setForceCompile(true) ;

// 数据库
//DB::singleton()->setDriver( new PDODriver("mysql:host=192.168.1.28;dbname=oc",'root','123456',array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")) ) ;

// 会话
$aSession = new OriginalSession() ;
$aSession->start() ;
Session::setSingleton($aSession) ;


return $aApp ;
?>
