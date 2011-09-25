<?php
namespace jc\test\unit\testcase\jc\setting;

use jc\setting\Setting ;
use jc\test\unit\testcase\jc\setting\KeyClassForTest;

/**
 * Setting是抽象类，所以这里为了测试创建了假的子类，实现了空的抽象方法
 * @author anubis
 *
 */

class SettingClassForTest extends Setting
{
	private $aTestPathKey ;
	
	public function __construct()
	{
		$this->aTestPathKey = new KeyClassForTest();
	}
	
	public function key($sPath) 
	{
		if($sPath === '/testPath')
		{
			return $this->aTestPathKey;
		}
		return null;
	}
	
	public function createKey($sPath) {}
	
	public function hasKey($sPath) {}
	
	public function deleteKey($sPath) {}
}