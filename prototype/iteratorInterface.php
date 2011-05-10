<?php

$arr1 = array(1,2,3) ;
$arr2 = array('a','b','c','d') ;

$iter1 = new ArrayIterator($arr1) ;
$iter2 = new ArrayIterator($arr2) ;

$miter = new MultipleIterator(MultipleIterator::MIT_NEED_ANY) ;
$miter->attachIterator($iter1) ;
$miter->attachIterator($iter2) ;

foreach($miter as $v)
{
	print_r($v) ;
}
?>