<?php
namespace jc\test\integration ;

// 初始化 jcat 框架
use jc\session\OriginalSession;
use jc\session\Session;
use jc\db\DB;
use jc\db\PDODriver;
use jc\ui\xhtml\UIFactory ;
use jc\system\Application;

// ini_set('display_errors', 1);

include __DIR__."/../../framework/inc.entrance.php" ;

$aApp = Application::singleton(true) ;

// UI
UIFactory::singleton()->sourceFileManager()->addFolder(__DIR__.'/templates') ;
//UIFactory::singleton()->sourceFileManager()->setForceCompile(true) ;

// 数据库
DB::singleton()->setDriver( new PDODriver("mysql:host=127.0.0.1;dbname=jc-example",'root','111111',array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")) ) ;

// 会话
$aSession = new OriginalSession() ;
$aSession->start() ;
Session::setSingleton($aSession) ;


return $aApp ;
?>
