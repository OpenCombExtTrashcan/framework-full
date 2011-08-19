<?php 
namespace jc\test\integration\ui ;

use jc\lang\Object;
use jc\ui\xhtml\Factory as UIFactory ;

$t = microtime(true) ;

$aApp = require_once dirname(__DIR__).'/jcat_init.php' ;

$aUI = $aApp->singletonInstance('jc\\ui\\xhtml\\UIFactory')->create() ;
$aUI->sourceFileManager()->setForceCompile(true) ;
$aUI->variables()->set('test' , 1 ) ;

$t2 = microtime(true) ;
$aUI->display("zengarden.template.html") ;
$t2 = microtime(true) - $t2 ;

echo "\r\n" ;
echo '模板引擎渲染：', $t2, "\r\n" ;
echo microtime(true) - $t, "\r\n" ;
echo (memory_get_peak_usage()/1024/1024), " MB\r\n" ;
?>