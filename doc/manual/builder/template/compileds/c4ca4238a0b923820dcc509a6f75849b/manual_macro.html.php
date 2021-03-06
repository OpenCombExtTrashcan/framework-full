<?php

$aDevice->write(<<<OUTPUT
<div id="wikipage">
<h1><span class="title"></span>宏</h1>

<h2>什么是宏</h2>
<p>Jecat的宏就是模板中花括号包含的语句,比如下面几行代码都是宏:</p>
<pre class='code'>
	<code class='php'>
&#123;? echo '这里是执行PHP语句'}
&#123;= '这里是输出文字'}
&#123;* 这里是注释}
	</code>
</pre>
<p>花括号中的代码会当作PHP语句来执行,简单来说,Jecat的宏实际上就是在html模板中执行PHP代码.宏主要用来在模板中输出变量值</p>
<h2>&#123;? 开头的宏</h2>
<p>这种宏支持直接执行PHP语句,下面是一种使用这种宏的例子:</p>
<pre class='code'>
	<code class='php'>
...
&#123;? \$iter = \$theCoder->childrenIterator('widget') }
...
&#123;? ob_flush() }
...
&#123;? \\oc\\ext\\developtoolbox\\coder\\mvc\\View::create(\$arrView,'\$this->view'.\$arrData['name'])->generate(\$theOutputDevPool,\$theDevice)}
...
	</code>
</pre>
<h2>&#123;= 开头的宏</h2>
<p>相当于PHP语句echo</p>
<pre class='code'>
	<code class='php'>
...
&#123;=addslashes(\$arrData['name'])}
...
&#123;="echo something"}
...
	</code>
</pre>
<h2>&#123;* 开头的宏</h2>
<p>宏的块注释,注释中无论写什么都会被忽略</p>
<pre class='code'>
	<code class='php'>
...
&#123;* 
	&lt;form>
	&lt;input value='被注释的html标签'/>
	&lt;/form>
	
	&#123;= "被注释的宏"}
	
	&lt;if true>被注释的Jecat标签&lt;/if>
}
...
	</code>
</pre>
</div>
OUTPUT
) ;
?>
