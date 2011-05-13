<?php 
namespace jc\test\integration ;

use jc\util\CombinedIterator;

require_once dirname(__DIR__).'/jcat_init.php' ;


$empty = new \ArrayIterator(array()) ;

$iter1 = new \ArrayIterator(array(1,2,3)) ;
$iter2 = new \ArrayIterator(array('a','b','c','d')) ;
$iter3 = new \ArrayIterator(array('A','B','C','D','E')) ;


foreach (new CombinedIterator($empty,$iter1,$iter2,$empty,$iter3,$empty,$iter2,$empty) as $v)
{
	echo $v, "\r\n" ;
}

?>