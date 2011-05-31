<?php
namespace jc\test\integration ;

// 初始化 jcat 框架
use jc\db\DB;
use jc\db\PDODriver;
use jc\ui\xhtml\Factory as UIFactory ;
use jc\system\Application;

include __DIR__."/../../framework/inc.entrance.php" ;


$aApp = new Application() ;
Application::setSingleton($aApp) ;

// UI
UIFactory::singleton()->sourceFileManager()->addFolder(__DIR__.'/templates') ;

// 数据库
//DB::singleton()->setDriver( new PDODriver("mysql:host=127.0.0.1;dbname=nvwa",'root','123456') ) ;

return $aApp ;
?>