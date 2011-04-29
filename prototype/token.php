<?php
$source = <<<STRING
ddd
<x aaa="xx\\"dd'ss\\<?php ?>dddss">
ddd
</x>
sss
STRING;

$arr = token_get_all("<?php ".$source."?>") ;
array_shift($arr) ;
array_pop($arr) ;

foreach($arr as &$token)
{
	if( is_int($token[0]) )
	{
		$token[] = token_name($token[0]) ;
	}
}
print_r($arr) ;

?>