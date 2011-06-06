<?php 
namespace jc\doc\classes\builder ;

use jc\ui\xhtml;
use jc\fs;

class ClassesBuilder
{
	public function __construct()
	{
		$this->aUI = xhtml\Factory::singleton()->create() ;
		$this->aUI->variables()->set('aBuilder',$this) ;
	}
	
	public function load($sEntrance)
	{
		foreach(new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($sEntrance)) as $sPath)
		{
			if(preg_match('/.svn/',$sPath))
			{
				continue ;
			}
			if(preg_match('/.php$/i',$sPath))
			{
				// echo "loading class: ", $sPath, "\r\n" ;			
				include_once $sPath ;
			}
		}
	
		$this->arrClasses = array() ;
		$this->arrClassIndexies = array() ;
		
		// 加载所有类
		foreach(array_merge(get_declared_classes(),get_declared_interfaces()) as $sFullClassName)
		{
			if(!preg_match("|^jc\\\\|",$sFullClassName))
			{
				continue ;
			}
			
			$arrNamespaces = explode('\\',$sFullClassName) ;
			$sClassName = array_pop($arrNamespaces) ;
			
			$arrPackage =& $this->arrClasses ;
			while($sPackageName=array_shift($arrNamespaces))
			{
				if(!isset($arrPackage[$sPackageName]))
				{
					$arrPackage[$sPackageName] = array() ;
				}
				
				$arrPackage =& $arrPackage[$sPackageName] ;
			}
			
			$arrPackage[$sClassName] = new ClassInfo(new \ReflectionClass($sFullClassName)) ;
			$this->arrClassIndexies[$sFullClassName] =& $arrPackage[$sClassName] ;
		}
	
		unset($this->arrClasses['jc']['doc']) ;
		
		// 建立所有类的继承关系	
		foreach($this->arrClassIndexies as $aClassInfo)
		{
			// parent class
			if( $aParentClassRef = $aClassInfo->getParentClass() and isset($this->arrClassIndexies[$aParentClassRef->getName()]) )
			{
				$this->arrClassIndexies[$aParentClassRef->getName()]->addSubClass( $aClassInfo ) ;
			}
			
			// implements interfaces
			foreach( $aClassInfo->getInterfaces() as $aInterfaceRef )
			{
				if( isset($this->arrClassIndexies[$aInterfaceRef->getName()]) )
				{
					$this->arrClassIndexies[$aInterfaceRef->getName()]->addSubClass( $aClassInfo ) ;
				}
			}
		}
	}
	
	public function build($sFolder,$sPackageName='',$arrChildren=null)
	{
		if(!$arrChildren)
		{
			$arrChildren = $this->arrClasses ;
		}
		
		foreach($arrChildren as $sName=>$child)
		{
			// package
			if( is_array($child) )
			{
				$sName = $sPackageName? ($sPackageName.'\\'.$sName): $sName ;
				
				$sPath = $sFolder.'/'.str_replace('\\', '//', $sName) ;
				if( !file_exists($sPath) )
				{
					mkdir( $sPath ) ;
				}
				
				$aFile = new fs\File( $sPath.'/index.html' ) ;
				$aStream = $aFile->openWriter() ;
				
				// variable: arrChildren
				$this->aUI->variables()->set('arrChildren',$child);
				
				// variable: sBaseUri
				$this->aUI->variables()->set('sBaseUri',str_repeat('../',substr_count($sName,'\\')+1)) ;
		
				// variable: sFullPackageName
				$this->aUI->variables()->set('sFullPackageName',$sName) ;	
				
				// variable: arrPackagePath
				$arrPackagePath = array() ;
				$sPath = '' ;
				foreach(explode('\\',$sName) as $sSubName)
				{
					$sPath.= ($sPath?'\\':'').$sSubName ;
					$arrPackagePath[$sPath] = $sSubName ;
				}
				$this->aUI->variables()->set('arrPackagePath',$arrPackagePath) ;
				
				$this->aUI->display('Package.template.html',null,$aStream) ;

				$aStream->close () ;
				
				echo "build package: ", $sName, "\r\n" ;
					
				// 递归
				$this->build($sFolder,$sName,$child) ;
			}
			
			// class
			else if( $child instanceof ClassInfo )
			{
				$this->buildClass($sFolder,$child) ;
			}
		}
	}

	private function buildClass($sFolder,ClassInfo $aClass)
	{
		$aFile = new fs\File( $sFolder.'/'.str_replace('\\', '/', $aClass->getName()).'.html' ) ;
		$aStream = $aFile->openWriter() ;
		
		$this->aUI->variables()->set('aClass',$aClass) ;				
		$this->aUI->variables()->set('sBaseUri',str_repeat('../',substr_count($aClass->getNamespaceName(),'\\')+1)) ;
		$this->aUI->display('Class.template.html',null,$aStream) ;
		
		$aStream->close () ;
		
		echo "build class: ", $aClass->getName(), "\r\n" ;
	}
	
	public function classes()
	{
		return $this->arrClasses ;
	}
	
	static public function classUri($sClass)
	{
		return str_replace("\\", "/", $sClass).'.html' ;
	}
	
	static public function packageUri($sPackage)
	{
		return str_replace("\\", "/", $sPackage).'/index.html' ;
	}
	
	public function decomposePath($sPathInput)
	{
		$bReqClass = class_exists($sPathInput) ;
		
		$arrRet = array() ;
		$arrStack = explode('\\',$sPathInput) ;
		
		if($bReqClass)
		{
			$sClassName = array_pop($arrStack) ;
		}
		
		$sPath = '' ;
		while($sName=array_shift($arrStack))
		{
			$sPath.= ($sPath?'/':'').$sName ;
			$arrRet[$sPath.'/index.html'] = $sName ;
		}
		
		if($bReqClass)
		{
			$arrRet[$sPath.'/'.$sName.'.html'] = $sName ;
		}
		
		return $arrRet ;
	}
	
	private $arrClasses = array() ;
	private $arrClassIndexies = array() ;
	
	/**
	 * @var jc\ui\UI
	 */
	private $aUI ;
}

?>