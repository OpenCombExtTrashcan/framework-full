<?php 
namespace test ;


$t = microtime(true) ;

use jc\system\CLParams;
use jc\system\Application ;
use jc\system\Request ;
use jc\system\CLRequest;
use jc\system\HttpAppFactory;
use jc\system\ApplicationFactory;

// 初始化 jcat 框架
include "../../framework/inc.entrance.php" ;

echo strval(microtime(true) - $t), "\n" ;

$aApp = Application::createApplication() ;

$aApp->response()->output( microtime(true)-$t ) ;

$aRequest = $aApp->request() ;
if( $aRequest instanceof CLRequest )
{
	$aRequest->defineParam('key1','-k','xxx') ;
	$aRequest->defineParam('key2',array('-t','--tidy'),'ww') ;
	$aRequest->reparseParams() ;
}


$aController = $aApp->accessRouter()->createController($aRequest) ;

$aApp->out()->println($aRequest['key2']) ;



$aApp->out()->println( microtime(true)-$t ) ;

?>