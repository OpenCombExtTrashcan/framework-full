<?php 
namespace jc\test\integration\ui ;

use jc\lang\Object;

use jc\ui\xhtml\Factory as UIFactory ;

$t = microtime(true) ;

require_once dirname(__DIR__).'/jcat_init.php' ;
UIFactory::singleton()->sourceFileManager()->addFolder(dirname(__DIR__).'/templates') ;

$aUI = UIFactory::singleton()->create() ;
$aUI->variables()->set('GLOBAL',array(1,2,3,4,7,array(4,1,2,4,5))) ;
$aUI->display("zengarden.template.html") ;

echo microtime(true) - $t, "\r\n" ;
echo (memory_get_peak_usage()/1024/1024), "mb\r\n" ;
?>