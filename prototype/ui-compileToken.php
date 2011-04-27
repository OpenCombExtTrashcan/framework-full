<?php 

$tidy = tidy_parse_string ("ssssssss 

<xxx dd=\"xds\"> x </xxx>ssss<span>ssss</span>",array('indent'=>true,'new-blocklevel-tags'=>'xxx','indent-spaces'=>4,'output-html'=>false,'output-xhtml'=>false)) ;

$tidy->cleanRepair();
echo $tidy ;
/*print_r(token_get_all("")) ;*/

?>