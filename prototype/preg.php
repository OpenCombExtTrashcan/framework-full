<?php


$sSource = "ssssssd=\"d".chr(0)."d\"d {=\$xx='dd->ss'd();} {?\$xxdd->ssdd();} {*xxxdd} " ;
$sSource = base64_decode("eG1sbnM9Ijw8AAIDe1thSFIwY0RvdkwzZDNkeTUzTXk1dmNtY3ZNVGs1T1M5NGFIUnRiQT09XX0ABgU=") ;

$matches = array() ;
preg_match_all("|([\\w_\\.\\-]+)\\s*=\\s*([\"'])(.+)\\2|s", $sSource, $matches) ;
print_r($matches) ;
?>