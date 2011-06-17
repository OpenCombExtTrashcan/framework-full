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


$aUser = new Model(
	array(
		'name' => 'user' ,
		'keys' => 'uid' ,
		'table' => 'user' ,
		'hasOne' => array(
			array(
				'prop' => 'info' ,
				'fromk' => 'uid' ,
				'tok' => 'uid' ,
			
				'model' => array(
					'name' => 'userinfo' ,
					'keys' => 'uid' ,
					'table' => 'userinfo' ,
				)
			)
		) ,
		'hasAndBelongsToMany' => array(
			array(
				'prop' => 'friends' ,
				'fromk' => 'uid' ,
				'tok' => 'uid' ,
				'bfromk' => 'uid' ,
				'btok' => 'fuid' ,	
				'bridge' => 'userfriends' ,
			
				'model' => array(
					'name' => 'user' ,
					'keys' => 'uid' ,
					'table' => 'user' ,
				)
			) ,
			array(
				'prop' => 'author' ,
				'fromk' => 'uid' ,
				'tok' => 'uid' ,
				'btok' => 'eid' ,	
				'bfromk' => 'eid' ,
				'bridge' => 'epubauthor' ,
			
				'model' => array(
					'name' => 'equb' ,
					'keys' => 'eid' ,
					'table' => 'equb' ,
				)
			)
		),
	)
,true) ;

$aUserinfo = new Model(
	array(
		'name' => 'userinfo' ,
		'keys' => 'uid' ,
		'table' => 'userinfo' ,
		'hasOne' => array(
			array(
				'prop' => 'user' ,
				'fromk' => 'uid' ,
				'tok' => 'uid' ,
				'model' => array(
					'name' => 'user' ,
					'keys' => 'uid' ,
					'table' => 'user' ,
				),
			),
		),
	)
,true) ;


$aUserfriend = new Model(
	array(
		'name' => 'userfriend' ,
		'keys' => 'ufid' ,
		'table' => 'serfriend' ,
		'hasOne' => array(
			array(
				'prop' => 'user' ,
				'fromk' => 'uid' ,
				'tok' => 'uid' ,
				'model' => array(
					'name' => 'user' ,
					'keys' => 'uid' ,
					'table' => 'user' ,
				),
			),
			array(
				'prop' => 'friend' ,
				'fromk' => 'fuid' ,
				'tok' => 'uid' ,
				'model' => array(
					'name' => 'user' ,
					'keys' => 'uid' ,
					'table' => 'user' ,
				),
			),
		),
	)
,true) ;

$aEpub = new Model(
	array(
		'name' => 'epub' ,
		'keys' => 'eid' ,
		'table' => 'epub' ,
		'hasOne' => array(
			array(
				'prop' => 'author' ,
				'fromk' => 'eid' ,
				'tok' => 'eid' ,
				'model' => array(
					'name' => 'epubauthor' ,
					'keys' => 'eid' ,
					'table' => 'epubauthor' ,
				),
			),
			array(
				'prop' => 'categories' ,
				'fromk' => 'cid' ,
				'tok' => 'cid' ,
				'model' => array(
					'name' => 'epubcategories' ,
					'keys' => 'cid' ,
					'table' => 'epubcategories' ,
				),
			),
		),
	)
,true) ;

$aEpubauthor = new Model(
	array(
		'name' => 'epubauthor' ,
		'keys' => 'aid' ,
		'table' => 'epubauthor' ,
		'hasOne' => array(
			array(
				'prop' => 'user' ,
				'fromk' => 'uid' ,
				'tok' => 'uid' ,
				'model' => array(
					'name' => 'user' ,
					'keys' => 'uid' ,
					'table' => 'user' ,
				),
			),
			array(
				'prop' => 'epub' ,
				'fromk' => 'eid' ,
				'tok' => 'eid' ,
				'model' => array(
					'name' => 'epub' ,
					'keys' => 'eid' ,
					'table' => 'epub' ,
				),
			),
		),
	)
,true) ;

$aEpubcategories = new Model(
	array(
		'name' => 'epubcategories' ,
		'keys' => 'cid' ,
		'table' => 'epubcategories' ,
		'hasOne' => array(
			array(
				'prop' => 'epub' ,
				'fromk' => 'cid' ,
				'tok' => 'cid' ,
				'model' => array(
					'name' => 'epub' ,
					'keys' => 'eid' ,
					'table' => 'epub' ,
				),
			),
		),
	)
,true) ;

$aUser->data('username') ;
$aUser->username ;
$aUser['username'] ;


$aUser->data('userinfo.email') ;
$aUser['userinfo.xnenene.xssss.email'] ;


$aModel->delete() ;


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
		
		'hasAndBelongsToMany' => array(
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
		)
),true) ;



$aModel->load() ;

echo "2nd run: ", microtime(true) - $t, "<br />\r\n" ;
echo "total: ", microtime(true) - $start, "<br />\r\n" ;
?>
<pre>
<?php //print_r( DB::singleton()->executeLog() ) ; ?>
</pre>