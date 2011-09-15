<?php 
namespace jc\test\io ;

$t = microtime(true) ;

require_once dirname(__DIR__).'/jcat_init.php' ;


echo "hello world!" ;


echo microtime(true) - $t ;
?>