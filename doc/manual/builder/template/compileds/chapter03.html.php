<?php

$aDevice->write(<<<OUTPUT
<div>
	<h1><span class="title"></span>HTML模板</h1>
	<p>本章介绍jecat系统模板的使用方法.</p>
	<p>Jecat模板是html文件,当显示页面时,后台程序会读取这些文件,并把准备好的数据插入其中的指定位置,然后再显示到用户页面上.之所以使用html文件作模板是为了让程序与模板文件尽量分开,
	这样网站美工和程序员的工作就尽可能的分开了.</p>
	<p>为了方便美工页面排版和处理后台提供的数据,Jecat提供了很定制的html标签,比如&lt;if>,&lt;loop>,&lt;foreach>等标签.本章教程就是引导读者体验Jecat模板使用流程和标签的功能.</p>
</div>
OUTPUT
) ;
?>
