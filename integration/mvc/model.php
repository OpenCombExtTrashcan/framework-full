<?php 
namespace jc\test\model ;

use jc\mvc\model\db\Model;
use jc\db\DB;
use jc\mvc\model\db\orm\operators\Selecter;
use jc\mvc\model\db\orm\ModelPrototype;


$start = microtime(true) ;
$t = microtime(true) ;

$aApp = require_once dirname(__DIR__).'/jcat_init.php' ;


echo "init framework: ", microtime(true) - $t, "<br />\r\n" ;
$t = microtime(true) ;

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
		
		'hasAndBelongsMany' => array(
			array(
				'prop' => 'buffs' ,
				'fromk' => 'uid' ,
				'btok' => 'uid' ,	
				'bfromk' => 'buffid' ,
				'tok' => 'id' ,
				'bridge' => 'myspace_mbuff' ,
			
				'model' => array(
					'name' => 'buff' ,
					'keys' => 'id' ,
					'table' => 'myspace_buff' ,
				) ,
			)
		),
),true) ;

$aModel->load() ;


echo "1st run: ", microtime(true) - $t, "<br />\r\n" ;
$t = microtime(true) ;

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
		
		'hasAndBelongsMany' => array(
			array(
				'prop' => 'buffs' ,
				'fromk' => 'uid' ,
				'btok' => 'uid' ,	
				'bfromk' => 'buffid' ,
				'tok' => 'id' ,
				'bridge' => 'myspace_mbuff' ,
			
				'model' => array(
					'name' => 'buff' ,
					'keys' => 'id' ,
					'table' => 'myspace_buff' ,
				) ,
			)
		),
),true) ;



$aModel->load() ;

echo "2nd run: ", microtime(true) - $t, "<br />\r\n" ;
echo "total: ", microtime(true) - $start, "<br />\r\n" ;
?>
<pre>
<?php //print_r( DB::singleton()->executeLog() ) ; ?>
</pre>