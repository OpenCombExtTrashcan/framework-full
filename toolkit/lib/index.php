<?php 
namespace lib ;

use jc\system\Application;

ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_DEPRECATED) ;

$aApplication = require __DIR__.'/jc.init.php' ;
if( !$aApplication or !$aApplication instanceof Application )
{
	echo "the jc.init.php file has broken." ;
	exit() ;
}



$aApplication->response()->output("hello word") ;


