<?php 
namespace jc\test\model ;

use jc\mvc\model\db\Model;
use jc\db\DB;
use jc\mvc\model\db\orm\operators\Selecter;
use jc\mvc\model\db\orm\ModelPrototype;


$aApp = require_once dirname(__DIR__).'/jcat_init.php' ;

$aModel = new Model(array(
		'name' => 'feed' ,
		'keys' => 'feedid' ,
		'table' => 'myspace_feed' ,

		'belongsTo' => array(
			array(
				'prop' => 'user' ,
				'fromk' => 'uid' ,
				'tok' => 'uid' ,
				'model' => array(
					'name' => 'user' ,
					'keys' => 'uid' ,
					'table' => 'myspace_space' ,
				) ,
			) ,
		) ,
)) ;

$aModel->load() ;



$aModel = new Model(array(
		'name' => 'feed' ,
		'keys' => 'feedid' ,
		'table' => 'myspace_feed' ,

		'belongsTo' => array(
			array(
				'prop' => 'user' ,
				'fromk' => 'uid' ,
				'tok' => 'uid' ,
				'model' => array(
					'name' => 'user' ,
					'keys' => 'uid' ,
					'table' => 'myspace_space' ,
				) ,
			) ,
		) ,
)) ;



$t = microtime(true) ;
$aModel->load() ;

echo microtime(true) - $t ;
?>