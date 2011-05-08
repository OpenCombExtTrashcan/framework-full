<?php 
namespace xxx ;

class a 
{
	static public function singleton ($bCreateNew=true)
	{
		$sClass = get_called_class() ;

		if( !empty(self::$arrGlobalInstancs[$sClass]) and $bCreateNew ) 
		{
			self::$arrGlobalInstancs[$sClass] = new static() ;
		}
		
		return self::$arrGlobalInstancs[$sClass] ;
	}
	static public function setSingleton (self $aInstance)
	{
		if( $aInstance instanceof static )
		{
			$sClass = get_called_class() ;
			self::$arrGlobalInstancs[$sClass] = $aInstance ;
		}
	}
	
	static private $arrGlobalInstancs = array() ;
}
class b extends a
{
	
}

b::singleton() ;
?>