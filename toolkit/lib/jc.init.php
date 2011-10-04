<?php 
namespace jc\toolkit ;

use jc\system\CLRequest;

use jc\mvc\view\UIFactory;
use jc\system\ApplicationFactory;

require dirname(dirname(__DIR__)).'/framework/inc.entrance.php' ;

$aToolkit = ApplicationFactory::singleton()->create(__DIR__) ;

// 设置参数
$aReq = $aToolkit->request() ;
if( $aReq instanceof CLRequest )
{
	$aReq->defineParam('-p',"--project") ;
	$aReq->reparseParams() ;
}

// 设置 class
$aToolkit->classLoader()->addPackage("jc\\toolkit","/class/source","/class/compiled") ;

// 设置 template
UIFactory::singleton()->sourceFileManager()->addFolder(
	$aToolkit->fileSystem()->findFolder("/ui/template")
) ;


return $aToolkit ;
