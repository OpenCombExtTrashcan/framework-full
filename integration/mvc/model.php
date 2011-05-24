<?php 
namespace jc\test\model ;

use jc\mvc\model\db\orm\ModelPrototype;


require_once dirname(__DIR__).'/jcat_init.php' ;


$t = microtime(true) ;


$aPrototype = ModelPrototype::createFromCnf(array(
		'name' => 'book' ,
		'keys' => 'bid' ,
		'table' => 'book' ,

		'belongsTo' => array(
			array(
				'prop' => 'author' ,
				'fromk' => 'author_uid' ,
				'tok' => 'uid' ,
				'model' => array(
					'name' => 'user' ,
					'keys' => 'uid' ,
					'table' => 'user' ,
				) ,
			) ,
		) ,
)) ;







echo microtime(true) - $t ;
?>