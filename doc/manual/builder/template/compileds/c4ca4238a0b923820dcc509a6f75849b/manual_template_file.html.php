<?php

$aDevice->write(<<<OUTPUT
<div id="wikipage">
<h1><span class="title"></span>模板文件</h1>

<h2>模板文件的内容</h2>
<p>Jecat的模板文件是HTML文件,唯独不同的是文件的内容可能带有一些Jecat框架扩展的标签,这些标签会在"翻译"模板文件的时候被转换成php语言或者html普通标签,
	他们都包含一系列特定的功能,他们存在的意义无非是节省开发者的时间.模板文件的内容看起来就像下面这样:</p>
<pre class='code'>
	<code class='html'>
&lt;div id="pp_thumbContainer">
	&lt;model:foreach>
		&lt;div class="album">
			&lt;foreach for='\$theModel->child("photos")->childIterator()' item='photo'>
				&lt;div class="content">
					&lt;img src="data/public/album/&#123;=\$photo['file']}" alt="data/public/album/&#123;=\$photo['file']}"/>
					&lt;span>&#123;=\$photo['title']}&lt;/span>
				&lt;/div>
			&lt;/foreach>
			&lt;div class="descr">
				&#123;=\$theModel['title']}
			&lt;/div>
			&lt;if \$bManageAccess>
				&lt;div class="pp_manage">&lt;a href="/?c=album.albumManage&aid=&#123;=\$theModel['aid']}">管理相册&lt;/a>&lt;/div>
			&lt;/if>
		&lt;/div>
	&lt;/model:foreach>
	&lt;div id="pp_back" class="pp_back">返回相册列表&lt;/div>
	&lt;if \$bManageAccess>
		&lt;div id="pp_new">&lt;a href="/?c=album.addAlbum">建立新相册&lt;/a>&lt;/div>
	&lt;/if>
&lt;/div>
	</code>
</pre>
<blockquote class="prepare">
	由于Jecat的标签和HTML的标签混合编写,所以代码的可读性非常重要,上面的代码缩进整齐合理,就降低了维护时的复杂程度,哪怕你正在开发只有自己才会维护的项目,也一定要注意这些代码的格式
</blockquote>
<h2>模板文件的位置</h2>
<p>一般情况下,模板文件会被放置在名为template的文件夹下,而这个文件夹一般都放在项目或模块或插件的根目录下.当然你可以在自己的项目中修改这些文件和文件夹的位置,不过还是建议你采取通用的做法.</p>
<h2>模板文件的加载</h2>
<p>首先要让Jecat知道去哪里寻找模板文件,下面的代码就是这个作用,它告诉UIFactory类:项目根目录(/)下的"template"文件夹就是模板存放的地址.</p>
<pre class='code'>
	<code class='php'>
use jc\\ui\\xhtml\\UIFactory;
	...
UIFactory::singleton()->sourceFileManager()->addFolder( \$aApp->fileSystem ()->findFolder('/template/') ) ;
	</code>
</pre>
<p>这样在使用这些模板的地方就可以轻松的加载template文件夹里面的模板文件了,甚至不需要编写特定的代码.比如MVC中的视图类就可以根据视图的名字自动找到对应的模板文件并加载.</p>
</div>
OUTPUT
) ;
?>
