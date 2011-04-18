<?php 
namespace jc\test\integration ;

// 
use jc\ui\xhtml\Factory as UIFactory ;

$t = microtime(true) ;

require_once dirname(__DIR__).'/jcat_init.php' ;


$aUI = UIFactory::singleton()->create() ;


echo microtime(true) - $t ;
?>