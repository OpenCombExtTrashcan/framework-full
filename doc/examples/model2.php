<?php
/*****************************************************************************
这个PHP文件演示了如何临时配置一个数据库模型(db model)的原型(prototype)，并用这个“临时原型”创建数据库模型，
而不需要为整个系统配置完整的“关系图”(association map)。
*****************************************************************************/
namespace jc\doc\examples ;

use jc\mvc\model\db\Model;
use jc\mvc\model\db\orm\ModelAssociationMap;


// 载入公共文件
$aApp = require __DIR__.'/common.php' ;

// 定义一个 orm配置
$arrEpubOrmConf = array(
	'name' => 'epub' ,
	'keys' => 'eid' ,
	'table' => 'epub' ,

	'hasOne' => array(
		array(
			'prop' => 'category' ,
			'fromk' => 'cid' ,
			'tok' => 'cid' ,
			'model' => array(
				'name' => 'category' ,
				'keys' => 'cid' ,
				'table' => 'epubcategories' ,
			),
		),
	),
	
	'hasAndBelongsToMany' => array(
		array(
			'prop' => 'authors' ,
			'fromk' => 'eid' ,
			'tok' => 'eid' ,
			'bfromk' => 'uid' ,
			'btok' => 'uid' ,	
			'bridge' => 'epubauthor' ,
			'model' => array(
				'name' => 'user' ,
				'keys' => 'uid' ,
				'table' => 'user' ,
			),
		) ,
	),
) ;

// 用 orm配置 创建模型
$aEpub = new Model($arrEpubOrmConf) ;



// 查询数据
$aModel->load( 521 ) ;

// 输出模型中的数据
print $aModel->username ;


?>