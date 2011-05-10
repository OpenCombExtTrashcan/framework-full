<?php 
namespace jc\test\integration ;

use jc\util\CombinedIterator;

require_once dirname(__DIR__).'/jcat_init.php' ;




$iter1 = new \ArrayIterator(array(1,2,3)) ;
$iter2 = new \ArrayIterator(array('a','b','c','d')) ;
$iter3 = new \ArrayIterator(array()) ;
$iter4 = new \ArrayIterator(array('A','B','C','D','E')) ;

$citer = new CombinedIterator($iter1,$iter2,$iter3,$iter4) ;

foreach ($citer as $v)
{
	echo $v, "\r\n" ;
}

?>