<?php
namespace jc\test\integration\ui;

use jc\lang\Object;
use jc\ui\xhtml\Factory as UIFactory;
use jc\setting\imp\FsSetting;

$t = microtime ( true );

$aApp = require_once dirname ( __DIR__ ) . '/jcat_init.php';

$aUI = $aApp->singletonInstance ( 'jc\\ui\\xhtml\\UIFactory' )->create ();
$aUI->sourceFileManager ()->setForceCompile ( true );
$aUI->variables ()->set ( 'test', 1 );

$t2 = microtime ( true );
$aUI->display ( "zengarden.template.html" );
$t2 = microtime ( true ) - $t2;

$aFolder = $aApp->filesystem ()->findFolder ( '/ui' );
$aSetting = new FsSetting ( $aFolder );
$aKey1 = $aSetting->createKey('testKey');
$aKey1->setItem('testItem1', '55');
$aKey2 = $aSetting->createKey('testKey/testKey');
$aKey2->setItem('testItem2', false);
$aKey3 = $aSetting->createKey('testKey/testKey/testKey');
$aKey3->setItem('testItem3', 11);
$aKey4 = $aSetting->createKey('testKey/testKey/testKeya');
$aKey4->setItem('testItem4', '44');
$aKey8 = $aSetting->createKey('testKey/testKey/testKey1');
$aKey8->setItem('testItem4', '44');
$aKey9 = $aSetting->createKey('testKey/testKey/testKey2');
$aKey9->setItem('testItem4', '44');
$aKey10 = $aSetting->createKey('testKey/testKey/testKey3');
$aKey10->setItem('testItem4', '44');
$aKey5 = $aSetting->createKey('testKey/testKey/testKey/testKey/testKey');
$aKey5->setItem('testItem5', '543535');
$aKey6 = $aSetting->createKey('testKey/testKey/testKey/testKey/testKey/testKey');
$aKey6->setItem('testItem6', 'fdjskafds');
$aKey7 = $aSetting->createKey('testKey/testKey/testKey/testKey/testKey/testKey/testKey');
$aKey7->setItem('testItem7', true);

$aSetting->deleteKey('testKey');
//$aSetting->deleteItem('testKey/testKey/testKey', 'testItem4');

echo "\r\n";
echo '模板引擎渲染：', $t2, "\r\n";
echo microtime ( true ) - $t, "\r\n";
echo (memory_get_peak_usage () / 1024 / 1024), " MB\r\n";

?>