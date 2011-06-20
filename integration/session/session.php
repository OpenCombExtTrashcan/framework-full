<?php 
namespace jc\test\session ;

use jc\mvc\model\Model;

use jc\auth\IdManager;
use jc\session\Session;



$aIdMgr = IdManager::fromSession( Session::singleton() ) ;

$aUserInfo = new Model() ;
$aId = new Id( $aUserInfo, array() ) ;
$aIdMgr->addId($aId) ;

?>