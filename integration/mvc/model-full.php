<?php 
namespace jc\test\mvc ; 

use jc\mvc\model\db\orm\ModelAssociationMap;
use jc\mvc\model\db\Model;
use jc\db\DB;
use jc\mvc\model\db\orm\operators\Selecter;
use jc\mvc\model\db\orm\ModelPrototype;

$start = microtime(true) ;
$t = microtime(true) ;

$aApp = require_once dirname(__DIR__).'/jcat_init.php' ;


echo "init framework: ", microtime(true) - $t, "<br />\r\n" ;
$t = microtime(true) ;

// 加载 orm 配置
require_once __DIR__.'/model-orm-cnf.php' ;


////////////////////////////////////////////////
// 使用“关系图” 创建模型对象

// 从关系图中取出关系片段
$aAssocMap = ModelAssociationMap::singleton() ;
$aFragment = $aAssocMap->fragment('epub',
		array(
			'categories' ,
			'author'=>array(
				'friends'
			) ,
		)
) ;


//////////////////////////////////////////////////////////////////
// 新建模型

$aEBook = new Model($aFragment) ;		// 用“片段”创建模型

$aEBook->epub_name = '架构之美' ;
$aEBook->epub_content = '本书围绕5个主题领域来组织本书的内容：概述、企业应用、系统、最终用户应用和编程语言。本书让最优秀的设计师和架构师来描述他们选择的软件架构，剥开架构的各层，展示他们如何让软件做到实现功能、可靠、易用、高效率、可维护、可移植和优雅。' ;
$aEBook->update_time = date('Y-m-d G:i:s') ;

$aEBook['categories.category_name'] = '软件工程' ;
$aEBook['categories.update_time'] = date('Y-m-d G:i:s') ;

$aAuthor1 = $aEBook->child('author')->createChild() ;
$aAuthor1->user_loginId = 'Till Adam' ;
$aAuthor1->user_register_time = time() ;
$aAuthor1->update_time = date('Y-m-d G:i:s') ;

$aUser = $aAuthor1->child('friends')->createChild() ;
$aUser->user_loginId = 'Alee' ;
$aUser->user_register_time = time() ;
$aUser->update_time = date('Y-m-d G:i:s') ;

if( !$aEBook->save() )
{
	echo "无法保存模型." ;
	exit() ;
}

//////////////////////////////////////////////////////////////////
// 加载模型

$aEBook = new Model($aFragment) ;		// 用“片段”创建模型

if( !$aEBook->load('架构之美','epub_name') )
{
	echo "无法加载数据。" ;
	exit() ;
}

//////////////////////////////////////////////////////////////////
// 修改/保存模型
$aEBook->setData('epub_name','架构之美(中译版)') ;

$aEBook["categories.update_time"] = date('Y-m-d G:i:s') ;

$aAuthor = $aEBook->child('author')->child(0) ;
$aAuthor->user_passwd = '111111' ;

if( !$aEBook->save() )
{
	echo "无法保存模型" ;
	exit() ;
}



//////////////////////////////////////////////////////////////////
// 删除模型

if( !$aEBook->delete() )
{
	echo "无法删除模型" ;
	exit() ;
}

echo "2nd run: ", microtime(true) - $t, "<br />\r\n" ;
echo "total: ", microtime(true) - $start, "<br />\r\n" ;
?>
<pre>
<?php //print_r( DB::singleton()->executeLog() ) ; ?>
</pre>