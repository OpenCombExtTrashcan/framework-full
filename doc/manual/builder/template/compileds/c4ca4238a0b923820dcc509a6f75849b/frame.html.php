<?php

$aDevice->write(<<<OUTPUT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jecat API</title>
<link rel="stylesheet" type="text/css" href="styles/style.css" />
</head>
<body>

<div id="doc_index">
<div class='index_scroll'>
<div id='quick_index' class='indexs'>
<h3>速查手册</h3>
</div>
<div id='tur_index' class='indexs'>
<h3>教程</h3>
</div>
<div id='manual_index' class='indexs'>
<h3>文档</h3>
<ol>
	<li><a href="manual_start.html">开始</a>
	<ul>
		<li><a href='manual_install.html'>安装 JeCat Toolkit</a></li>
		<li><a href='manual_build_project.html'>创建 JeCat 项目</a></li>
	</ul>
	</li>
	<li><a href='manual_system.html'>系统</a>
	<ul>
		<li><a href='manual_jc_init_php.html'>jc.init.php文件</a></li>
		<li><a href='manual_applicmanual_n.html'>应用程序对象</a></li>
		<li><a href='manual_request_response.html'>请求/回应</a></li>
		<li><a href='manual_auto_include.html'>自动加载类</a></li>
		<li><a href='manual_const.html'>常量</a></li>
	</ul>
	</li>
	<li><a href='manual_file_system.html'>文件系统</a>
	<ul>
		<li><a href='manual_file_object.html'>创建文件系统对象</a></li>
		<li><a href='manual_file_controll.html'>文件操作</a>
		<ul>
			<li><a href='manual_new_file.html'>新建文件</a></li>
			<li><a href='manual_load_file.html'>取得已有文件对象</a></li>
			<li><a href='manual_read_file.html'>读取文件内容</a></li>
			<li><a href='manual_write_file.html'>向文件写入内容</a></li>
			<li><a href='manual_file_property.html'>文件各项属性</a></li>
		</ul>
		</li>
	</ul>
	</li>
	<li><a href='manual_cache_system.html'>缓存</a>
	<ul>
		<li><a href='manual_file_cache.html'>文件缓存</a></li>
		<li><a href='manual_data_cache.html'>数据库缓存</a></li>
		<li><a href='manual_high_speed_cache.html'>高速缓存</a></li>
	</ul>
	</li>
	<li><a href='manual_system_config.html'>系统配置</a>
	<ul>
		<li><a href='manual_config_base_on_file_system.html'>基于文件存储的系统配置</a>
		</li>
		<li><a href='manual_config_base_on_high_io.html'>高速IO的系统配置方案</a></li>
	</ul>
	</li>
	<li><a href='manual_session.html'>会话</a></li>
	<li><a href='manual_database.html'>数据库</a>
	<ul>
		<li><a href='manual_connect_database.html'>连接数据库</a></li>
		<li><a href='manual_select.html'>Select</a>
		<ul>
			<li><a href='manual_select_one_table.html'>单表查询</a></li>
			<li><a href='manual_select_where.html'>查询条件</a></li>
			<li><a href='manual_select_join.html'>Join 关联查询</a></li>
			<li><a href='manual_select_result.html'>动态结果集</a></li>
			<li><a href='manual_select_union.html'>Union 查询</a></li>
		</ul>
		</li>
		<li><a href='manual_insert.html'>Insert</a></li>
		<li><a href='manual_update.html'>Update</a></li>
		<li><a href='manual_delete.html'>Delete 删除</a></li>
		<li><a href='manual_database_debug.html'>数据库调试</a>
		<ul>
			<li><a href='manual_sql_history.html'>SQL执行历史</a></li>
			<li><a href='manual_database_error.html'>数据库执行异常</a></li>
		</ul>
		</li>
		<li><a href='manual_database_reflect.html'>数据库反射</a></li>
	</ul>
	</li>
	<li><a href='manual_template_engine.html'>模板引擎</a>
	<ul>
		<li><a href='manual_template_file.html'>模板文件</a></li>
		<li><a href='manual_macro.html'>宏</a></li>
		<li><a href='manual_tag.html'>标签</a></li>
		<li><a href='manual_template_io.html'>模板引擎的输入/输出</a></li>
		<li><a href='manual_custom_macro_and_tag.html'>自定义模板标签和宏</a></li>
		<li><a href='manual_template_weave.html'>模板编织</a></li>
	</ul>
	</li>
	<li><a href='manual_MVC.html'>MVC</a>
	<ul>
		<li><a href='manual_connect_database.html'>数据库模型</a>
		<ul>
			<li><a href='manual_table_prototype.html'>数据表原型</a></li>
			<li><a href='manual_table_relation.html'>数据表关联</a></li>
			<li><a href='manual_model_opration.html'>模型的基本操作</a></li>
			<li><a href='manual_model_list.html'>模型列表</a></li>
			<li><a href='manual_model_load_condition.html'>模型加载的条件</a></li>
		</ul>
		</li>
		<li><a href='manual_view.html'>视图</a>
		<ul>
			<li><a href='manual_bind_model.html'>绑定模型</a></li>
			<li><a href='manual_template_tag.html'>模板标签</a></li>
			<li><a href='manual_form_view.html'>表单视图</a></li>
		</ul>
		</li>
		<li><a href='manual_widget.html'>视图窗体(控件)</a>
		<ul>
			<li><a href='manual_form_widget.html'>表单控件</a></li>
			<li><a href='manual_pagination_widget.html'>分页控件</a></li>
		</ul>
		</li>
		<li><a href='manual_controller.html'>控制器</a></li>
		<li><a href='manual_data_exchange_and_verify.html'>数据交换和数据校验</a></li>
	</ul>
	</li>
	<li><a href='manual_patterns.html'>模式</a>
	<ul>
		<li><a href='manual_singleton_and_flyweight.html'>单件和享元</a></li>
		<li><a href='manual_bean.html'>Bean 对象</a></li>
		<li><a href='manual_iterator.html'>迭代器</a></li>
		<li><a href='manual_AOP.html'>面向方面(AOP)</a></li>
	</ul>
	</li>
	<li><a href='manual_appendices.html'>附录</a>
	<ul>
		<li><a href='manual_using_namespace.html'>PHP的命名空间</a></li>
	</ul>
	</li>
</ol>
</div>
</div>
<div id="doc_index_title">文档</div>
<div class='block'></div>
</div>

<div class="wrapper">
<div class="bodyText">
OUTPUT
) ;


$__include_aVariables = $aVariables ; 

$this->display(eval("if(!isset(\$__uivar_sBodyFile)){ \$__uivar_sBodyFile=&\$aVariables->getRef('sBodyFile') ;};
return \$__uivar_sBodyFile;"),$__include_aVariables,$aDevice) ; 
$aDevice->write(<<<OUTPUT
</div>
</div>
<script src='./scripts/jquery-1.6.2.min.js' type='text/javascript'></script>
<script src='./scripts/jquery.beautyOfCode-min.js' type='text/javascript'></script>
<script type="text/javascript">
\$(function(){
	\$.beautyOfCode.init({
		brushes: ['Xml', 'JScript', 'CSharp', 'Plain', 'Php' ,'Sql'],
		baseUrl: './',
		ready: function() {
			\$.beautyOfCode.beautifyAll();
		}
	});
});
</script>
<script src='./scripts/manual.js' type='text/javascript'></script>
</body>
</html>
OUTPUT
) ;
?>
