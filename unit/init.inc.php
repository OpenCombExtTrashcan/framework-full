<?php 
namespace jc\test\unit ;

use jc\system\AppFactory;

// 添加 pear 各模组所需要的 include path
define('jc\\test\\unit\\PATH_JC_ROOT',dirname(dirname(__DIR__))) ;
define('jc\\test\\unit\\PATH_PEAR_ROOT',PATH_JC_ROOT.'/pear') ;
define('jc\\test\\unit\\PATH_PEAR_LIB',PATH_PEAR_ROOT.'/share/pear') ;

set_include_path( get_include_path() . PATH_SEPARATOR . PATH_PEAR_LIB ) ;

// 初始化 jecat 框架
include PATH_JC_ROOT."/framework/inc.entrance.php" ;

return AppFactory::createFactory()->create(__DIR__) ; 
?>