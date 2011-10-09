<?php 
namespace {=$sNamespace} ;

use jc\system\ApplicationFactory;
use jc\mvc\view\UIFactory;

require __DIR__.'/framework/inc.entrance.php' ;

$aApplication = ApplicationFactory::singleton()->create(__DIR__) ;

// 设置 class
$aApplication->classLoader()->addPackage("{=$sNamespace}","/class/source","/class/compiled") ;

// 设置 template
UIFactory::singleton()->sourceFileManager()->addFolder(
	$aApplication->fileSystem()->findFolder("/ui/template")
) ;


return $aApplication ;
