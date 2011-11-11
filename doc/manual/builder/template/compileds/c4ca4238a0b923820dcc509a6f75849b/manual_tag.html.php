<?php

$aDevice->write(<<<OUTPUT
<div id="wikipage">
<h1><span class="title"></span>标签</h1>

<h2>什么是标签</h2>
<p>Jecat的标签和宏很相似,他们实际上都是PHP代码,但是标签的功能更加固定,都是些特别常用的功能.比如if标签.标签存在的目的是让美工也可以解决一些简单的业务逻辑.</p>
<h2>流程控制类型的标签</h2>
<p>if标签的写法:</p>
<pre class='code'>
	<code class='php'>
&#123;? \$bBoolVar = false}
&lt;if !\$bBoolVar>
	&lt;span>您没有权限使用此功能&lt;/span>
&lt;if:else \$bBoolVar />
	&lt;a href='#'>修改密码&lt;/a>
&lt;/if>
	</code>
</pre>
<p>if标签可以使用php语句作为判断条件,就像在写PHP代码一样.上面的代码中,if:else后面有条件语句,所以当作elseif处理,如果没有条件语句就当作else处理</p>
<p>loop标签的写法,loop相当于php的for</p>
<pre class='code'>
	<code class='php'>
&lt;loop end='10' var='i'>
	&#123;=\$i}
&lt;/loop>
	</code>
</pre>
<p>end属性类似for语句的"\$i&lt;=10;"部分,而var属性的值会成为一个变量的名字,声明这个变量相当与在for循环中的"\$i=0;"部分
	所以上面的语句将输出0到10</p>
<blockquote class="prepare">
	loop循环的end属性代指for循环中的"&lt;=",而不是"&lt;",这一点一定要注意,上面例子中的循环被执行了11次而不是10次
</blockquote>
<p>loop还有step和start属性,比如你在php中写出这样的for循环</p>
<pre class='code'>
	<code class='php'>
for(\$i=3;\$i<10;\$i+2)&#123;
	echo \$i;
}
	</code>
</pre>
<p>那么翻译成loop标签就是这样:</p>
<pre class='code'>
	<code class='php'>
&lt;loop start='3' end='9' var='i' step='2'>
	&#123;=\$i}
&lt;/loop>
	</code>
</pre>
<p>Jecat还提供while标签和foreach等标签,还有控制循环流程的continue,break标签,他们的作用和在PHP中的一样:</p>
<pre class='code'>
	<code class='php'>
&#123;? \$arrVar = array(1,2,3)}
&lt;foreach for='\$arrVar' item='value'>
	&lt;if "\$value==2" >
		&lt;continue />
	&lt;/if>
	&#123;=\$value}
&lt;/foreach>
//结果是"1 2"
	</code>
</pre>

<h2>功能性标签</h2>
<p>include标签可以加载额外的模板文件</p>
<pre class='code'>
	<code class='php'>
&lt;include file="footer.html" file.type="expression" />
	</code>
</pre>
<p>css标签可以加载css文件,js标签可以加载js标签</p>
<pre class='code'>
	<code class='php'>
&lt;css src='album.css' />
&lt;js src='album.js' />
	</code>
</pre>
<p>他们会自动的加载template文件夹同级的css文件夹和js文件夹中的文件,无论你在哪里使用这些标签,加载这些文件的html标签都会被添加到当前页面的head标签中</p>
<p>如果你使用Jecat的MVC系统的话,你还会接触到类似widget和views这样的标签,widget是Jecat提供的页面控件,
	views标签所在位置会被当前视图的子视图替换,这些就属于MVC的高级功能了,详细情况MVC手册部分</p>
</div>
OUTPUT
) ;
?>
