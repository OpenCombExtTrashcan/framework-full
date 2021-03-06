<?php 
namespace jc\doc\classes\builder ;

use jc\io\OutputStream;
use jc\fs\FileSystem;
use jc\system\ApplicationFactory;
use jc\fs\imp\LocalFileSystem;
use jc\system\Application;
use jc\ui\xhtml\UIFactory;
use jc\fs\FSO;

include_once __DIR__.'/../../../framework/inc.entrance.php' ;
$aApp = ApplicationFactory::singleton()->create(__DIR__) ;

$aApp->classLoader()->addPackage(__NAMESPACE__,null,'/') ;
UIFactory::singleton()->sourceFileManager()->addFolder( $aApp->fileSystem ()->findFolder('/template/') ) ;

$arrChapters = array(
	'manual_template_file.html' ,
	'manual_macro.html',
	'manual_tag.html',
	'manual_template_io.html',
	'manual_custom_macro_and_tag.html',
) ;

$aUI = UIFactory::singleton()->create() ;

foreach($arrChapters as $sChapterFilename)
{
	$aWriter = new OutputStream( fopen(__DIR__.'/../html/'.$sChapterFilename,'w') ) ;
	$aUI->display('frame.html',array('sBodyFile'=>$sChapterFilename),$aWriter) ;
	
	$aApp->response()->output("build html page: ../html/".$sChapterFilename) ;
}
?>