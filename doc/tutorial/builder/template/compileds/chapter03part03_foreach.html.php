<?php

$aDevice->write(<<<OUTPUT
<div class='page'>
	<h1><span class="title"></span>foreach标签</h1>
	<blockquote class="prepare">
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
		* 如果你不想自己构建程序的目录,可以直接下载<a href='../code/template_p02.zip'>代码包</a><br />
	</blockquote>
	<p>我们经常使用PHP自带的foreach来遍历数组,Jecat的模板也同样提供了方便的foreach标签来简化数组遍历.</p>
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<p class='purpose'>我们要用foreach标签遍历一个数组的内容,把他们显示成一个表格</p>
		<ul class='todo'>
		<li>我们在te.php文件的显示模板语句(就是display方法)以前加上下面的代码:
		<pre class='code'>
				<code class='php'>
// 添加一个数组变量给模板
\$aUI->variables()->set('arrBooks' , array(
		'数据结构' => '26.00' ,
        '毛泽东传' => '55.00' ,
        '万物简史' => '36.00' ,)) ;</code>
			</pre>
			<p>上面代码的意思是:定义了一个名为arrBooks的变量,它的内容是一个数组,并且让它在模板中可用</p>
		</li>
		
		<li>
			进入template文件夹,打开template.html文件,添加如下代码:
			<pre class='code'>
				<code class='html'>
&lt;table>
	&lt;thead>
		&lt;tr>
			&lt;td>书名&lt;/td>
			&lt;td>单价&lt;/td>
		&lt;/tr>
	&lt;/thead>
	&lt;tbody>
		&lt;foreach for='\$arrBooks' key='title' item='price'>
			&lt;tr>
				&lt;td>&#123;=\$title}&lt;/td>
				&lt;td>&#123;=\$price}&lt;/td>
			&lt;/tr>
		&lt;/foreach>
	&lt;/tbody>
&lt;/table></code>
			</pre>
			<p>第9行就是foreach标签了,for属性的值是我们要遍历的数组,前面的PHP代码已经把这个数组定义好了,key属性的值是代表数组key的变量名,item属性是指数组元素值的变量名.</p>
			<p>第11行和第12行把每个数组元素输出到页面上,每次循环遍历不同的数组元素.</p>
		</li>
		</ul>
	</div>
	
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p>验证构建的代码是否正确</p>
		<ul>
			<li>运行你的浏览器,在地址栏输入这些:  http://你的域名/te/te.php 然后回车来访问你刚刚构建的页面</li>
			<li>页面的输出应该和你定义的数组内容一致.然后你可以尝试自己写一个数组让foreach标签来遍历,或者干脆多写几个数组,然后让foreach嵌套的来遍历.</li>
		</ul>
	</div>
	
	<blockquote class='prepare'>
		如果数组意外的为空怎么办?Jecat还提供了一个&lt;foreach:else/>标签,建议你去查查手册,看看它怎么用.真的很方便哦 ^_^.
	</blockquote>
</div>
OUTPUT
) ;
?>
