<?php 
namespace jc\test\model ;

$t = microtime(true) ;

use jc\db\DB;
use jc\mvc\model\db\orm\operators\Selecter;
use jc\mvc\model\db\orm\ModelPrototype;


$aApp = require_once dirname(__DIR__).'/jcat_init.php' ;

/*
{
	name: 'book' ,
	keys: 'bid' ,
	table: 'book' ,
	
	belongsTo: [
		{
			prop:author
			
		}
	]
}
*/
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
			
					'belongsTo' => array(
					) ,
				) ,
			) ,
			
			array(
				'prop' => 'publishing' ,
				'fromk' => 'publishing_cid' ,
				'tok' => 'cid' ,
				'model' => array(
					'name' => 'company' ,
					'keys' => 'cid' ,
					'table' => 'company' ,
			
					
					'hasOne' => array(
						array(
							'prop' => 'manager' ,
							'fromk' => 'manager_uid' ,
							'tok' => 'uid' ,
							'model' => array(
								'name' => 'user' ,
								'keys' => 'uid' ,
								'table' => 'user' ,
							) ,
						) ,
					),
				) ,
			) ,
			
		) ,
)) ;



$aSelecter = new Selecter() ;
$aSelecter->execute(
	$aApp->singletonInstance('jc\\db\\DB',true)
	, null, $aPrototype
) ;




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

$aSelecter = new Selecter() ;
$aSelecter->execute(
	$aApp->singletonInstance('jc\\db\\DB',true)
	, null, $aPrototype
) ;

echo microtime(true) - $t ;
?>