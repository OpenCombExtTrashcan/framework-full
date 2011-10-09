<?php
namespace jc\toolkit ;

use jc\io\ShellPrintStream;

use jc\mvc\controller\Controller;

class Dispatch extends Controller
{
	static private $arrSecondaryCommands = array(
	
			'jc\\toolkit\\Help' => array('help','h','?') ,
	
			'jc\\toolkit\\agile\\Test' => array('test','ts') ,
			'jc\\toolkit\\agile\\TestSkeleton' => array('test-skeleton','ts-s') ,
	
			'jc\\toolkit\\maintenance\\InitProject' => array('init') ,
	) ;
	
	static public function commands()
	{
		$arrCmdControllers = array() ;
		foreach (self::$arrSecondaryCommands as $sController=>$arrCmds)
		{
			foreach ($arrCmds as $sCmd)
			{
				$arrCmdControllers[$sCmd] = $sController ;
			}
		}
		
		return $arrCmdControllers ;
	}
	
	protected function init()
	{
		$this->aParams->set('noframe',true) ;
	}
	
	public function process()
	{
		// 处理、统一 "--project" 参数
		$sProjectDir = $this->aParams->get('-p') ;
		if( !$sProjectDir )
		{
			$sProjectDir = getcwd() ; 
			$this->aParams->set('-p',$sProjectDir) ;
		}
		
		
		
		// 
		$arrCommands = self::commands() ;
		$sSecCmd = strtolower($this->aParams->get(1,'help')) ;

		if( !isset($arrCommands[$sSecCmd]) )
		{
			$aOutput = $this->response()->printer() ;
			
			$aOutput->println('') ;
			$aOutput->write( "er... You have inputed some invalid secondary command \"\\e[35m{$sSecCmd}\\e[0m\" ..." ) ;
			$aOutput->write("See 'jc help' for more information .") ;
			$aOutput->println('') ;
		}
		else 
		{
			if( !class_exists($arrCommands[$sSecCmd]) )
			{
				$aOutput = $this->response()->printer() ;
				$aOutput->println('') ;
				$aOutput->write( "ok, the secondary command \"\\e[35m{$sSecCmd}\\e[0m\" is useful, but i'm not complete it yet ." ) ;
				$aOutput->println('') ;
			}
			else
			{
				$aController = new $arrCommands[$sSecCmd]( $this->aParams ) ;
				$aController->mainRun() ;
			}
		}
	}
}

?>