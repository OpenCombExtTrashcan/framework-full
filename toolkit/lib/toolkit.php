<?php 
namespace jc\toolkit ;

use jc\system\Application;

ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_DEPRECATED) ;

$aToolkit = require __DIR__.'/jc.init.php' ;
$aToolkit instanceof Application ;


$aController = new Dispatch($aToolkit->request()) ;
$aController->mainRun() ;


