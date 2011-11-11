<?php
use jc\db\reflecter\imp\MockupReflecterFactory;


include __DIR__.'/inc.init.php' ;

$arrTable = array(
	  	'db1' => array(
	  		'table1' => array(
	  			'primaryName' => 'index1',
	  			'autoIncrement' => 0 ,
	  			'comment' => 'xxx' ,
	  
	  			'columns' => array(
	  				'column1' => array(
	  					'type' => 'int' ,
	  					'length' => 10 ,
	  					'allowNull' => false ,
	  					'defaultValue' => 0 ,
	  					'comment' => 'xxxx' ,
	  					'isAutoIncrement' => true ,
	  				),
	  				'column2' => array(
	  					'type' => 'int' ,
	  					'length' => 10 ,
	  					'allowNull' => true ,
	  					'defaultValue' => 0 ,
	  					'comment' => 'xxxx' ,
	  					'isAutoIncrement' => true ,
	  				),
	  				'column3' => array(
	  					'type' => 'int' ,
	  					'length' => 10 ,
	  					'allowNull' => true ,
	  					'defaultValue' => 0 ,
	  					'comment' => 'xxxx' ,
	  					'isAutoIncrement' => true ,
	  				),
	  			) ,
	  
	  			'indexes' => array(
	  				'index1' => array(
	  					'columns' => array('column1'),
						'isPrimary' => true,
						'isUnique' => true,
						'isFullText' => false,
	  				),
	  				'index2' => array(
	  					'columns' => array('column1','column2'),
						'isPrimary' => false,
						'isUnique' => true,
						'isFullText' => false,
	  				),
	  				'PRIMARY' => array(
	  					'columns' => array('column2','column3'),
						'isPrimary' => false,
						'isUnique' => true,
						'isFullText' => false,
	  				),
	  			) ,
	  		)
	  	)
	  );

$aFactory = new MockupReflecterFactory($arrTable);
$aDBReflecter1 = $aFactory->createDBReflecter('db1');
echo $aDBReflecter1->name();
var_dump($aDBReflecter1->isExist());
var_dump($aDBReflecter1->tableNameIterator());
$aDBReflecter2 = $aFactory->createDBReflecter('db2');
echo $aDBReflecter2->name();
var_dump($aDBReflecter2->isExist());

$aTableReflecter1 = $aFactory->createTableReflecter('table1');
var_dump($aTableReflecter1->isExist());
var_dump($aTableReflecter1->autoIncrement());
var_dump($aTableReflecter1->comment());
var_dump($aTableReflecter1->name());
var_dump($aTableReflecter1->primaryName());
var_dump($aTableReflecter1->columnNameIterator());

$aColumnReflecter1 = $aFactory->createColumnReflecter('table1', 'column1');
var_dump($aColumnReflecter1->isExist());
var_dump($aColumnReflecter1->allowNull());
var_dump($aColumnReflecter1->comment());
var_dump($aColumnReflecter1->defaultValue());
var_dump($aColumnReflecter1->isAutoIncrement());
var_dump($aColumnReflecter1->isBool());
var_dump($aColumnReflecter1->isFloat());
var_dump($aColumnReflecter1->isInts());
var_dump($aColumnReflecter1->isString());
var_dump($aColumnReflecter1->length());
var_dump($aColumnReflecter1->name());
var_dump($aColumnReflecter1->type());

$aIndexReflecter1 = $aFactory->createIndexReflecter('table1', 'index1');
var_dump($aIndexReflecter1->isExist());
var_dump($aIndexReflecter1->columnNames());
var_dump($aIndexReflecter1->isFullText());
var_dump($aIndexReflecter1->isPrimary());
var_dump($aIndexReflecter1->isUnique());
var_dump($aIndexReflecter1->name());



