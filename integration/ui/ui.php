<?php 
namespace jc\test\integration ;

// 
use jc\ui\xhtml\Factory as UIFactory ;

$t = microtime(true) ;

require_once dirname(__DIR__).'/jcat_init.php' ;
UIFactory::singleton()->sourceFileManager()->addFolder(__DIR__.'/templates') ;

$aUI = UIFactory::singleton()->create() ;
$aUI->display("zengarden.template.html") ;


echo microtime(true) - $t ;
?>