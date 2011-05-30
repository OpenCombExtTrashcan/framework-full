<?php 
namespace jc\test\integration\ui ;

use jc\lang\Object;

use jc\ui\xhtml\Factory as UIFactory ;


$t = microtime(true) ;

$aApp = require_once dirname(__DIR__).'/jcat_init.php' ;

$aUI = $aApp->singletonInstance('jc\\ui\\xhtml\\Factory')->create() ;
$aUI->display("zengarden.template.html") ;

echo microtime(true) - $t, "\r\n" ;
echo (memory_get_peak_usage()/1024/1024), "mb\r\n" ;
?>