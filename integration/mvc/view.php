<?php 
namespace jc\test\integration\mvc ;

// 
use jc\ui\xhtml\Factory as UIFactory ;

$t = microtime(true) ;

require_once dirname(__DIR__).'/jcat_init.php' ;
UIFactory::singleton()->sourceFileManager()->addFolder(dirname(__DIR__).'/ui/templates') ;

$aUI = UIFactory::singleton()->create() ;
$aUI->display("zengarden.template.html") ;


echo microtime(true) - $t, "\r\n" ;
echo (memory_get_peak_usage()/1024/1024), "mb\r\n" ;
?>