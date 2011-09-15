<?php
namespace jc\test\mvc ; 

use jc\mvc\model\db\orm\ModelAssociationMap;

////////////////////////////////////////////////
// 构建“关系图”

// 取得模型关系图的单件实例
$aAssocMap = ModelAssociationMap::singleton() ;

// 分别为每个数据表添加 ORM 配置
$aAssocMap->addOrm(
	array(
		'name' => 'user' ,
		'table' => 'users' ,
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
				'prop' => 'equbs' ,
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
		'belongsTo' => array(
			array(
				'prop' => 'category' ,
				'fromk' => 'cid' ,
				'tok' => 'cid' ,
				'model' => 'category'
			),
		),
		'hasAndBelongsToMany' => array(
			array(
				'prop' => 'authors' ,
			
				'fromk' => 'eid' ,
				'btok' => 'eid' ,	
			
				'bfromk' => 'uid' ,
				'tok' => 'uid' ,
			
				'bridge' => 'epubauthor' ,
			
				'model' => 'user',
			) ,
		),
	)
);

$aAssocMap->addOrm(
	array(
		'name' => 'category' ,
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

return $aAssocMap ;
?>