<?php 
namespace jc\test\unit ;

use jc\system\ApplicationFactory ;

// 添加 pear 各模组所需要的 include path
define('jc\\test\\unit\\PATH_JC_ROOT',dirname(dirname(__DIR__)).'/framework') ;
define('jc\\test\\unit\\PATH_PEAR_ROOT',__DIR__.'/pear') ;
define('jc\\test\\unit\\PATH_PEAR_LIB',PATH_PEAR_ROOT.'/share/pear') ;

set_include_path( get_include_path() . PATH_SEPARATOR . PATH_PEAR_LIB ) ;

// 初始化 jecat 框架
include PATH_JC_ROOT."/inc.entrance.php" ;

return ApplicationFactory::singleton()->create(__DIR__) ; 
?>