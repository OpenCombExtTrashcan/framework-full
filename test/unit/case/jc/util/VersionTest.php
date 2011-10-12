<?php
namespace jc\test\unit\testcase\jc\util;

use jc\util\Version;

/**
 * Test class for jc\util\Version.
 * @for jc\util\Version
 */
class VersionTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var jc\util\Version
	 */
	protected $aVersion;
	
	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
	}
	
	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{
	}
	
	public function testSetVersionCode()
	{
		$aVersion = Version::FromString ( '1.22.13.2 rc' );
		$aVersion->SetVersionCode ( 'beta' );
		$this->assertEquals ( 'beta', $aVersion->GetVersionCode () );
		
		$aVersion = Version::From32Integer ( 226918402 );
		$aVersion->SetVersionCode ( 'beta' );
		$this->assertEquals ( 'beta', $aVersion->GetVersionCode () );
	}
	
	public function testCompare()
	{
		$aVersion = Version::FromString ( '11.22.13.3 beta' );
		//左大于右的情况
		$this->assertEquals( 1, $aVersion->Compare ( Version::FromString ( '11.22.1' ) ) );
		$this->assertEquals( 1, $aVersion->Compare ( Version::FromString ( '11.22.12' ) ) );
		$this->assertEquals( 1, $aVersion->Compare ( Version::FromString ( '11.22.13.2' ) ) );
		$this->assertEquals( 1, $aVersion->Compare ( Version::FromString ( '10.22.13.3' ) ) );
		$this->assertEquals( 1, $aVersion->Compare ( Version::FromString ( '11.22' ) ) );
		
		//左右相等的情况
		$this->assertEquals ( 0, $aVersion->Compare ( Version::FromString ( '11.22.13.3' ) ) );
		$this->assertEquals ( 0, $aVersion->Compare ( Version::FromString ( '11.22.13.3 beta' ) ) );
		
		//左小于右的情况
		$this->assertEquals( -1, $aVersion->Compare ( Version::FromString ( '11.24' ) ) );
		$this->assertEquals( -1, $aVersion->Compare ( Version::FromString ( '12.22.1' ) ) );
		$this->assertEquals( -1, $aVersion->Compare ( Version::FromString ( '11.23.12' ) ) );
		$this->assertEquals( -1, $aVersion->Compare ( Version::FromString ( '11.22.14.2' ) ) );
		$this->assertEquals( -1, $aVersion->Compare ( Version::FromString ( '11.22.13.4' ) ) );
	}
	
	/**
	 * @see testToString() 
	 */
	public function test__toString()
	{
		$this->testToString ();
	}
	
	public function testToString()
	{
		$aVersion = Version::FromString ( '11.2222.13.3332 beta' );
		//返回完整版本号
		$this->assertEquals ( '11.2222.13.3332 beta', $aVersion->toString () );
		//只返回主要版本号
		$this->assertEquals ( '11.2222.13', $aVersion->toString ( false ) );
	}
	
	public function testGetPrimaryNumber()
	{
		$aVersion = Version::FromString ( '11.2222.13.3332 beta' );
		$this->assertEquals ( 11, $aVersion->GetPrimaryNumber () );
		$aVersion = Version::FromString ( '122.2442.14443.2 beta545fdsdvcsdfdfdsfds' );
		$this->assertEquals ( 122, $aVersion->GetPrimaryNumber () );
	}
	
	public function testGetSecondaryNumber()
	{
		$aVersion = Version::FromString ( '1.2222.13.3332 beta' );
		$this->assertEquals ( 2222, $aVersion->GetSecondaryNumber () );
		$aVersion = Version::FromString ( '122.2442.14443.2 beta545fdsdvcsdfdfdsfds' );
		$this->assertEquals ( 2442, $aVersion->GetSecondaryNumber () );
	}
	
	public function testGetModificatoryNumber()
	{
		$aVersion = Version::FromString ( '1.2222.13.3332 beta' );
		$this->assertEquals ( 13, $aVersion->GetModificatoryNumber () );
		$aVersion = Version::FromString ( '122.2442.14443.2 beta545fdsdvcsdfdfdsfds' );
		$this->assertEquals ( 14443, $aVersion->GetModificatoryNumber () );
	}
	
	public function testGetInternalNumber()
	{
		$aVersion = Version::FromString ( '1.2222.13.3332 beta' );
		$this->assertEquals ( 3332, $aVersion->GetInternalNumber () );
		$aVersion = Version::FromString ( '122.2442.14443.2 beta545fdsdvcsdfdfdsfds' );
		$this->assertEquals ( 2, $aVersion->GetInternalNumber () );
	}
	
	public function testGetVersionCode()
	{
		$aVersion = Version::FromString ( '1.22.13.2 beta' );
		$this->assertEquals ( 'beta', $aVersion->GetVersionCode () );
		$aVersion = Version::FromString ( '1.22.13.2 beta545fdsdvcsdfdfdsfds' );
		$this->assertEquals ( 'beta545fdsdvcsdfdfdsfds', $aVersion->GetVersionCode () );
		$aVersion = Version::FromString ( '1.22.13.2' );
		$this->assertEquals ( '', $aVersion->GetVersionCode () );
		$aVersion = Version::From32Integer ( 226918402 );
		$this->assertEquals ( '', $aVersion->GetVersionCode () );
	}
	
	public function testGet32Integer()
	{
		$aVersion = Version::FromString ( '1.22.13.2 beta' );
		$this->assertEquals ( 226918402, $aVersion->Get32Integer () );
	}
	
	public function testGetCeil32Integer()
	{
		$aVersion = Version::FromString ( '1.22.13.2 beta' );
		$this->assertEquals ( 226918402, $aVersion->GetCeil32Integer () );
	}
	
	public function testFrom32Integer()
	{
		$this->assertType ( 'jc\util\Version', Version::From32Integer ( 226918402 ) );
	}
	
	public function testFromString()
	{
		$this->assertType ( 'jc\util\Version', Version::FromString ( '1.22.13.2 beta' ) );
	}
	
	public function testVerifyFormat()
	{
		//正确的格式
		$this->assertTrue ( Version::VerifyFormat ( '1.22.13.2 beta' ) );
		$this->assertTrue ( Version::VerifyFormat ( '1.22.13.2' ) );
		$this->assertTrue ( Version::VerifyFormat ( '1.22.13' ) );
		$this->assertTrue ( Version::VerifyFormat ( '1.22' ) );
		$this->assertTrue ( Version::VerifyFormat ( '1' ) );
		//错误的格式
		$this->assertFalse ( Version::VerifyFormat ( '1.22.13.2 beta fdf' ) );
		$this->assertFalse ( Version::VerifyFormat ( '1.22.13.2aa' ) );
		$this->assertFalse ( Version::VerifyFormat ( '1.22.13.2 ' ) );
		$this->assertFalse ( Version::VerifyFormat ( '1.22.13a.2' ) );
		$this->assertFalse ( Version::VerifyFormat ( '1.2a2.13.2' ) );
		$this->assertFalse ( Version::VerifyFormat ( '1aa.22.13.2' ) );
		$this->assertFalse ( Version::VerifyFormat ( '1aa.22.13.' ) );
	}
}
?>
