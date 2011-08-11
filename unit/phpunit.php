<?php
namespace jc\test\unit ;

use jc\fs\imp\LocalFile;

use jc\system\ClassLoader;

use jc\system\Application;

include __DIR__.'/inc.init.php' ;


// mock
// -------------
/*
$_SERVER['argv'][1] = '--skeleton-test' ;
$_SERVER['argv'][2] = "jc\\fs\\FileSystem" ;
*/
// $_SERVER['argv'][1] = "jc\\test\\unit\\testcase\\jc\\fs\\FileSystem" ;



if( !empty($_SERVER['argv'][1]) )
{
	if( $_SERVER['argv'][1]=='--skeleton-test' and !empty($_SERVER['argv'][2]) )
	{
		$sClassBasename = substr($_SERVER['argv'][2],strrpos($_SERVER['argv'][2],'\\')+1) ;
		$sClassNamespace = substr($_SERVER['argv'][2],0,strrpos($_SERVER['argv'][2],'\\')) ;
		
		// source class path
		if( empty($_SERVER['argv'][3]) )
		{
			$_SERVER['argv'][3] = '' ;
		} 
		
		// test class name
		if( empty($_SERVER['argv'][4]) )
		{
			$_SERVER['argv'][4] = 'jc\\test\\unit\\testcase\\' . $sClassNamespace . '\\' . $sClassBasename ;
		} 
		
		// test class path
		if( empty($_SERVER['argv'][5]) )
		{
			$sDir = __DIR__ . '/case/' . str_replace('\\','/',$sClassNamespace) ;
			if( !file_exists($sDir) )
			{
				mkdir($sDir,0755,true) ;
			}
			$_SERVER['argv'][5] = $sDir . '/' . $sClassBasename . '.php' ;
		}
		
		$_SERVER['argc'] = 6 ;
	}
	
	
	// 执行测试
	if( !preg_match('/^\-\-/',$_SERVER['argv'][1]) )
	{
		// 反射class的路径
		if( $aClassFile=Application::singleton()->classLoader()->searchClass($_SERVER['argv'][1]) and ($aClassFile instanceof LocalFile) )
		{
			$_SERVER['argv'][2] = $aClassFile->localPath() ;
		}
	}
}


include PATH_PEAR_ROOT.'/bin/phpunit' ;


?>