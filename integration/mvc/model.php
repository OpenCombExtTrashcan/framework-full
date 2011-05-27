<?php 
namespace jc\test\model ;

use jc\mvc\model\db\Model;
use jc\db\DB;
use jc\mvc\model\db\orm\operators\Selecter;
use jc\mvc\model\db\orm\ModelPrototype;


$aApp = require_once dirname(__DIR__).'/jcat_init.php' ;

$aModel = new Model(array(
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

$aModel->load() ;



$aModel = new Model(array(
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



$t = microtime(true) ;
$aModel->load() ;

echo microtime(true) - $t ;
?>