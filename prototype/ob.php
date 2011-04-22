<?php

function ob_func_1($in,$status)
{
	//$arr = debug_backtrace() ;
	return $in.'1' ;
}
function ob_func_2($in,$status)
{
	//$arr = debug_backtrace() ;
	return $in . '2' ;
}
function ob_func_3($in,$status)
{
	//$arr = debug_backtrace() ;
	//return $in . '3' ;
//$h = fopen('php://stdout', "w");
//fwrite($h,$in) ;
return $in.'3' ;
}



ob_start("ob_func_1") ;
ob_start("ob_func_2") ;
ob_start("ob_func_3") ;

$h = fopen('php://stdout', "w");
fwrite($h,"yyy") ;


//echo "xxx" ;


?>