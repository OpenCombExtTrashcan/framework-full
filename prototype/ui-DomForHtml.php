<?php
error_reporting(E_ALL) ;

$doc = new DOMDocument();
echo $doc->loadHTML("xxxxxxxx<div>yyyyyyyyy</div>")? "1": "0" ;

foreach ($doc->childNodes as $el)
{
	print_r($el->nodeName) ;
}

?>