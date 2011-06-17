<?php 

use jc\db\PDODriver;
use jc\db\DB;

// 初始化 jcat 框架
require __DIR__."/../../../framework/inc.entrance.php" ;

$aApp = jc\system\AppFactory::createFactory()->create() ;


DB::singleton()->setDriver( new PDODriver("mysql:host=127.0.0.1;dbname=www",'root','1') ) ;

define('UnitTestDataFolder',dirname(__DIR__).'/data/') ;

require_once 'PHPUnit/Framework.php';

?>