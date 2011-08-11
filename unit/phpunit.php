#! /usr/bin/php5
<?php
namespace jc\test\unit ;

include __DIR__.'/inc.init.php' ;

/*
$_SERVER['argv'][1] = '--skeleton-test' ;
$_SERVER['argv'][2] = "jc\\system\\Application" ;
*/

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
}


include PATH_PEAR_ROOT.'/bin/phpunit' ;
?>