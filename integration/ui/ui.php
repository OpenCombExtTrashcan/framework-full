<?php 
namespace jc\test\integration\ui ;

use jc\lang\Object;

use jc\ui\xhtml\Factory as UIFactory ;

$t = microtime(true) ;

$aApp = require_once dirname(__DIR__).'/jcat_init.php' ;
$aApp->singletonInstance('jc\\ui\\xhtml\\Factory')->sourceFileManager()->addFolder(dirname(__DIR__).'/templates') ;

$aUI = $aApp->singletonInstance('jc\\ui\\xhtml\\Factory')->create() ;
$aUI->variables()->set('GLOBAL',array(1,2,3,4,7,array(4,1,2,4,5))) ;
$aUI->variables()->set('GLOBAL',array(1,2,3,4,7,array(4,1,2,4,5))) ;
$aUI->display("zengarden.template.html") ;

echo microtime(true) - $t, "\r\n" ;
echo (memory_get_peak_usage()/1024/1024), "mb\r\n" ;
?>