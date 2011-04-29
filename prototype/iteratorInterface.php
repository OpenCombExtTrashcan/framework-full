<?php

class a implements \Iterator
{
	public function __construct($arr)
	{
		$this->arr = $arr ;
	}

	public function current () 
	{
		echo __METHOD__, "\r\n";
		return current($this->arr) ;
	}

	public function next () 
	{
		echo __METHOD__, "\r\n";
		return next($this->arr) ;
	}

	public function key () 
	{
		$k = key($this->arr) ;
		echo __METHOD__, "\r\n";
		return key($this->arr) ;
	}

	public function valid () 
	{
		echo __METHOD__, "\r\n";
		$a = key($this->arr) ;
		return key($this->arr)!==null ;
		
		return $this->postion++<count($this->arr) ;
		
		$bRet = each($this->arr)!==false ;
		if(each($this->arr)===false)
		{
			$v = end($this->arr) ;
		}
		else 
		{
			$v1 = prev($this->arr) ;
			$v2 = prev($this->arr) ;
		}
		return $bRet ;
	}

	public function rewind ()
	{
		$this->postion = 0 ;
		return reset($this->arr) ;
	}
	
	private $arr ;
	private $postion = 0 ;
}

class b extends a
{
	
}

?>