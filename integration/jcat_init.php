<?php
namespace jc\test\integration ;

// 初始化 jcat 框架
use jc\system\Application;

include __DIR__."/../../framework/inc.entrance.php" ;

$aApp = Application::singleton() ;


return $aApp ;

?>