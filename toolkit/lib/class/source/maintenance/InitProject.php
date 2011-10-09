<?php
namespace jc\toolkit\maintenance ;

use jc\io\ShellPrintStream;

use jc\io\OutputStream;

use jc\mvc\view\UIFactory;

use jc\io\ShellInputStream;

use jc\system\Application;

use jc\fs\imp\LocalFileSystem;

use jc\mvc\controller\Controller;

class InitProject extends Controller
{
	
	protected function init()
	{
		$this->aParams->set('noframe',true) ;
	}
	
	public function process()
	{		
		$sProjectDir = $this->aParams->get('-p') ;
		if(!$sProjectDir)
		{
			$this->response()->output("please specify a project folder path.") ;
			return ;
		}
		
		if( !file_exists($sProjectDir) )
		{
			if( mkdir($sProjectDir,0775,true) )
			{
				$this->response()->output("please specify a project folder path.") ;
				return ;
			}
		}
		$sProjectDirSafe = addcslashes($sProjectDir,'"') ;
		
		//-- 检查目录 --
		if( is_file($sProjectDir.'/jc.init.php') )
		{
			$this->response()->output("\r\nThe specified directory has a JeCat Project \\e[35malready\\e[0m.   Nothing to do.\r\n") ;
			return ;
		}
		
		//-- 进入项目目录 --
		`cd "{$sProjectDirSafe}"` ;
		
		//-- create folders --
		$arrFolders = array(
			'setting' => 0775 ,
			'data' => 0775 ,
			'class' => 0755 ,
			'class/source' => 0755 ,
			'class/compiled' => 0775 ,
			'ui' => 0755 ,
			'ui/template' => 0775 ,
			'ui/style' => 0755 ,
			'ui/js' => 0755 ,
			'framework' => 0755 ,
		) ;
		foreach($arrFolders as $sFolder=>$nMode)
		{
			if(is_dir($sProjectDir.'/'.$sFolder))
			{
				$this->response()->output("skip create folder(exist):	\\e[32m{$sFolder}\\e[0m") ;
				continue ;
			}
			
			if( mkdir( $sProjectDir.'/'.$sFolder, $nMode ) )
			{
				$this->response()->output("create folder:			\\e[32m{$sFolder}\\e[0m") ;
			}
			else 
			{
				$this->response()->output("\r\ncreate folder failed: ".$sFolder) ;
				return ;
			}
		}
			
		//-- inti framework --
		$this->response()->output("initialize jecat framework in 'framework' folder ... ...") ;
		$sFrameworkRepos = realpath($this->application()->applicationDir().'/../../framework') ;
		
		$this->response()->output( `git clone {$sFrameworkRepos} "{$sProjectDirSafe}/framework"` ) ;
		
		//-- namespace --
		$sProjectNamespace = basename($sProjectDir) ;
		$aInput = new ShellInputStream() ;
		$this->response()->printer()->printfont("please input Namespace of this project(default is \"{$sProjectNamespace}\"):",ShellPrintStream::normal,ShellPrintStream::color_yellow) ;
		$sProjectNamespaceInput = trim($aInput->read()) ;
		
		$sProjectNamespace = $sProjectNamespaceInput?: $sProjectNamespace ;
		
		//-- create files --
		$aUI = UIFactory::singleton()->create() ;
		
		if( !file_exists($sProjectDir.'/jc.init.php') )
		{
			$this->response()->output("create file:	\\e[32mjc.init.php\\e[0m") ;
			$aUI->display(
					'jc.init.php'
					, array('sNamespace'=>$sProjectNamespace)
					, new OutputStream( fopen($sProjectDir.'/jc.init.php','w') )
			) ;
		}
		
		if( !file_exists($sProjectDir.'/index.php') )
		{
			$this->response()->output("create file:	\\e[32mindex.php\\e[0m") ;
			$aUI->display(
					'index.php'
					, array('sNamespace'=>$sProjectNamespace)
					, new OutputStream( fopen($sProjectDir.'/index.php','w') )
			) ;
		}
		
		//-- 在项目目录创建 git 仓库
		$this->response()->output("create git repository for this project.") ;
		$this->response()->output(`git init "{$sProjectDirSafe}"`) ;
		
		$this->response()->output("create .gitignore file") ;
		OutputStream::createInstance( fopen($sProjectDir.'/.gitignore','w') )->write(
			"setting/*
data/*
class/compiled/*
ui/template/compiled/*"
		);
		
		// first commit for project
		`git add .` ;
		$this->response()->output(`git commit -m "create project by jecat toolkit
power by http://www.jecat.cn
"`) ;
		
		//-- done --
		$this->response()->output("\r\n") ;
		$this->response()->printer()->printfont("ok, the project has created success!",ShellPrintStream::normal,ShellPrintStream::color_pink) ;
		$this->response()->output("\r\nplease try command \"php5 index.php\"  :)\r\n") ;
		
		//-- 离开项目目录 --
		`cd -` ;
	}

}

?>