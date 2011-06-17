<?php 
namespace jc\test\model ;

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



////////////////////////////////////////////////
// 构建“关系图”

// 取得模型关系图的单件实例
$aAssocMap = ModelAssociationMap::singleton() ;

// 分别为每个数据表添加 ORM 配置
$aAssocMap->addOrm(
	array(
		'table' => 'user' ,
		'hasOne' => array(
			array(
				'prop' => 'info' ,
				'fromk' => 'uid' ,
				'tok' => 'uid' ,
				'model' => 'userinfo'
			),
		) ,
		'hasAndBelongsToMany' => array(
			array(
				'prop' => 'friends' ,
				'fromk' => 'uid' ,
				'tok' => 'uid' ,
				'bfromk' => 'uid' ,
				'btok' => 'fuid' ,	
				'bridge' => 'userfriends' ,
				'model' => 'user',
			) ,
			array(
				'prop' => 'equb' ,
				'fromk' => 'uid' ,
				'tok' => 'uid' ,
				'btok' => 'eid' ,	
				'bfromk' => 'eid' ,
				'bridge' => 'epubauthor' ,
				'model' => 'equb',
			),
		),
	)
) ;


$aAssocMap->addOrm(
	array(
		'name' => 'userinfo' ,
		'keys' => 'uid' ,
		'table' => 'userinfo' ,
		'belongsTo' => array(
			array(
				'prop' => 'user' ,
				'fromk' => 'uid' ,
				'tok' => 'uid' ,
				'model' => 'user'
			),
		),
	)
);


$aAssocMap->addOrm(
	array(
		'name' => 'epub' ,
		'keys' => 'eid' ,
		'table' => 'epub' ,
		'hasOne' => array(
			array(
				'prop' => 'categories' ,
				'fromk' => 'cid' ,
				'tok' => 'cid' ,
				'model' => 'epubcategories'
			),
		),
		'hasAndBelongsToMany' => array(
			array(
				'prop' => 'author' ,
				'fromk' => 'eid' ,
				'tok' => 'eid' ,
				'bfromk' => 'uid' ,
				'btok' => 'uid' ,	
				'bridge' => 'epubauthor' ,
				'model' => 'user',
			) ,
		),
	)
);

$aAssocMap->addOrm(
	array(
		'name' => 'epubcategories' ,
		'keys' => 'cid' ,
		'table' => 'epubcategories' ,
		'belongsTo' => array(
			array(
				'prop' => 'epub' ,
				'fromk' => 'cid' ,
				'tok' => 'cid' ,
				'model' => 'epub'
			),
		),
	)
);
////////////////////////////////////////////////
// 使用“关系图” 创建模型对象

// 从关系图中取出关系片段
$aFragment = $aAssocMap->fragment('epub',
		array(
			'categories' ,
			'author'=>array(
				'friends'
			) ,
		)
) ;

// 用“片段”创建模型
$aEBook = new Model($aFragment) ;

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



echo "2nd run: ", microtime(true) - $t, "<br />\r\n" ;
echo "total: ", microtime(true) - $start, "<br />\r\n" ;
?>
<pre>
<?php //print_r( DB::singleton()->executeLog() ) ; ?>
</pre>