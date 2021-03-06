<?php

$aDevice->write(<<<OUTPUT
<div class='page'>
	<h1><span class="title"></span>模板宏</h1>
	<blockquote class="prepare">
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
		* 如果你不想自己构建程序的目录,可以直接下载<a href='../code/template_p03.zip'>代码包</a><br />
	</blockquote>
	<p>当我们需要在模板中使用PHP代码时,我们就会想起模板宏.</p>
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<p class='purpose'>我们先简单的把变量的值输出到页面上</p>
		<ul class='todo'>
		<li>我们在te.php文件的显示模板语句(就是display方法)以前加上下面的代码:
		<pre class='code'>
				<code class='php'>
// 添加一个数组变量给模板
\$aUI->variables()->set('sWhatIsThis' ,'Jecat') ;</code>
			</pre>
			<p>上面代码的意思是:定义了一个名为sWhatIsThis的变量,它的内容是一个字符串,并且让它在模板中可用</p>
		</li>
		
		<li>
			进入template文件夹,打开template.html文件,添加如下代码:
			<pre class='code'>
				<code class='html'>
&lt;div>&lt;span>We are using &#123;=\$sWhatIsThis}&lt;/span>&lt;/div></code>
			</pre>
			<p>如果你看过前2节,你一定已经熟悉这种方式了,上面的代码相当于在PHP代码中的:</p>
			<pre class='code'>
				<code class='php'>
&lt;div>&lt;span>We are using &lt;?php echo \$sWhatIsThis;?>&lt;/span>&lt;/div></code>
			</pre>
			<p>刷新你的页面试一下,如你所料,页面的底部会显示'We are using Jecat'</p>
		</li>
		</ul>
	</div>
	
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p class='purpose'>同样是把变量的值输出到页面上,这次我们换一种方式</p>
		<ul class='todo'>
		
		<li>修改我们刚才添加的模板内容
			<pre class='code'>
				<code class='html'>
&lt;div>&lt;span>We are using &#123;? echo \$sWhatIsThis}&lt;/span>&lt;/div></code>
			</pre>
			<p>上面的代码和step 1 中的代码的功能是一致的.</p>
		</li>
		</ul>
	</div>
	
	<h3 id='s3'>step 3.</h3>
	<div class='step'>
		<p>验证构建的代码是否正确</p>
		<ul>
			<li>运行你的浏览器,在地址栏输入这些:  http://你的域名/te/te.php 然后回车来访问你刚刚构建的页面</li>
			<li>页面的最后应该输出了We are using Jecat</li>
		</ul>
	</div>
	
	<blockquote class='prepare'>
		试试用&#123;#? XXX #}形式的宏处理更复杂的语句,比如for循环什么的.&#123;#? XXX #}是&#123;? XXX }形式的完整写法,前者可以在内部出现花括号"{}"的情况下也能正常使用,如果内容没有花括号,那么后者那样的简写形式也够用了.
		如果你2种形式都不喜欢,或者和你其他的页面内容有冲突,那么你可以自定义宏的语法形式,详情请参照Jecat文档.
	</blockquote>
</div>
OUTPUT
) ;
?>
