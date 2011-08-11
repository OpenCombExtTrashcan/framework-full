<?php 
namespace jc\test\unit ;

use jc\fs\imp\LocalFileSystem;
use jc\system\ApplicationFactory ;

// 添加 pear 各模组所需要的 include path
define('jc\\test\\unit\\PATH_JC_ROOT',dirname(dirname(__DIR__)).'/framework') ;
define('jc\\test\\unit\\PATH_PEAR_ROOT',__DIR__.'/pear') ;
define('jc\\test\\unit\\PATH_DATA_ROOT',__DIR__.'/data') ;
define('jc\\test\\unit\\PATH_PEAR_LIB',PATH_PEAR_ROOT.'/share/pear') ;

set_include_path( PATH_PEAR_LIB . PATH_SEPARATOR . get_include_path() ) ;

// 初始化 jecat 框架
include PATH_JC_ROOT."/inc.entrance.php" ;

$aApp = ApplicationFactory::singleton()->create(__DIR__) ;

$aApp->fileSystem()->mount('/unitcase',new LocalFileSystem(__DIR__.'/case')) ;
$aApp->classLoader()->addPackage('jc\\test\\unit\\testcase\\jc',null,'/unitcase/jc') ;

return $aApp ;
?>
