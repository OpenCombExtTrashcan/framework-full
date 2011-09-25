<?php
namespace jc\test\unit\testcase\jc\setting;

use jc\setting\Key ;

/**
 * 
 * Key是抽象类，所以这里为了测试创建了假的子类，实现了空的抽象方法
 * @author anubis
 *
 */
class KeyClassForTest extends Key
{
	public function keyIterator() {}
	public function save() {}
}

?>