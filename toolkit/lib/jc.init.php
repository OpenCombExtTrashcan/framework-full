<?php 
namespace jc\toolkit ;

use jc\system\CLRequest;
use jc\system\ApplicationFactory;
use jc\mvc\view\UIFactory;

require dirname(dirname(__DIR__)).'/framework/inc.entrance.php' ;

$aApplication = ApplicationFactory::singleton()->create(__DIR__) ;
$aRequest = $aApplication->request() ;
if($aRequest instanceof CLRequest)
{
	$aRequest->defineParam('-p',array('--project')) ;
	
	$aRequest->reparseParams() ;
}

// 设置 class
$aApplication->classLoader()->addPackage("jc\\toolkit","/class/source","/class/compiled") ;

// 设置 template
UIFactory::singleton()->sourceFileManager()->addFolder(
	$aApplication->fileSystem()->findFolder("/ui/template")
) ;

return $aApplication ;
