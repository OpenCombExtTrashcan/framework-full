<?php
namespace jc\test\unit\testcase\jc\util;


use jc\util\VersionScope ;
use jc\util\Version ;

/**
 * Test class for jc\util\VersionScope.
 * @for jc\util\VersionScope
 */
class VersionScopeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var jc\util\VersionScope
     */
    protected $aVersionScope;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
//        $this->aVersionScope = new VersionScope ;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @see testIsInScope() 
     */
    public function testFromString()
    {
//    	$this->testIsInScope();
    }
    
    public function testIsInScope()
    {
    	$aVersionScope = VersionScope::FromString('1.22.13.2 rc <- 1.44.23.32 rc');
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.22.13.2 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.22.13.0 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.22.13 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.22 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('2 rc')));
    	$this->assertTrue($aVersionScope->IsInScope(Version::FromString('1.44.23.32 rc')));
    	$this->assertTrue($aVersionScope->IsInScope(Version::FromString('1.22.13.20 rc')));
    	$this->assertTrue($aVersionScope->IsInScope(Version::FromString('1.22.14 rc')));
    	$this->assertTrue($aVersionScope->IsInScope(Version::FromString('1.23 rc')));
    	
    	$aVersionScope = VersionScope::FromString('1.22.13.2 rc -> 1.44.23.32 rc');
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.44.23.32 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.22.13.0 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.22.13 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.22 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('2 rc')));
    	$this->assertTrue($aVersionScope->IsInScope(Version::FromString('1.22.13.2 rc')));
    	$this->assertTrue($aVersionScope->IsInScope(Version::FromString('1.22.13.20 rc')));
    	$this->assertTrue($aVersionScope->IsInScope(Version::FromString('1.22.14 rc')));
    	$this->assertTrue($aVersionScope->IsInScope(Version::FromString('1.23 rc')));
    	
    	$aVersionScope = VersionScope::FromString('1.22.13.2 rc <> 1.44.23.32 rc');
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.22.13.0 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.22.13 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.22 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('2 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.44.23.32 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.22.13.2 rc')));
    	$this->assertTrue($aVersionScope->IsInScope(Version::FromString('1.22.13.20 rc')));
    	$this->assertTrue($aVersionScope->IsInScope(Version::FromString('1.22.14 rc')));
    	$this->assertTrue($aVersionScope->IsInScope(Version::FromString('1.23 rc')));
    	
    	$aVersionScope = VersionScope::FromString('1.22.13.2 rc - 1.44.23.32 rc');
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.22.13.0 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.22.13 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.22 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('2 rc')));
    	$this->assertTrue($aVersionScope->IsInScope(Version::FromString('1.44.23.32 rc')));
    	$this->assertTrue($aVersionScope->IsInScope(Version::FromString('1.22.13.2 rc')));
    	$this->assertTrue($aVersionScope->IsInScope(Version::FromString('1.22.13.20 rc')));
    	$this->assertTrue($aVersionScope->IsInScope(Version::FromString('1.22.14 rc')));
    	$this->assertTrue($aVersionScope->IsInScope(Version::FromString('1.23 rc')));
    	
    	$aVersionScope = VersionScope::FromString('1.22.13.2');
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.2.13.0 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('0.22.13 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.22 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.22.12 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1.22.13.1 rc')));
    	$this->assertFalse($aVersionScope->IsInScope(Version::FromString('1 rc')));
    	//检测版本是否相等
    	$this->assertTrue($aVersionScope->IsInScope(Version::FromString('1.22.13.2')));
    }

    public function testMakeString()
    {
    	$aVersionScope = VersionScope::FromString('1.22.13.2 rc - 1.44.23.32 rc');
    	$this->assertEquals('1.22.13.2 rc-1.44.23.32 rc', $aVersionScope->MakeString());
    	$aVersionScope = VersionScope::FromString('1.22.13.2 rc <- 1.44.23.32 rc');
    	$this->assertEquals('1.22.13.2 rc<-1.44.23.32 rc', $aVersionScope->MakeString());
    	$aVersionScope = VersionScope::FromString('1.22.13.2 rc -> 1.44.23.32 rc');
    	$this->assertEquals('1.22.13.2 rc->1.44.23.32 rc', $aVersionScope->MakeString());
    	$aVersionScope = VersionScope::FromString('1.22.13.2 rc <> 1.44.23.32 rc');
    	$this->assertEquals('1.22.13.2 rc<>1.44.23.32 rc', $aVersionScope->MakeString());
    	$aVersionScope = VersionScope::FromString('1.22.13.2 rc');
    	$this->assertEquals('1.22.13.2 rc', $aVersionScope->MakeString());
    }
}
?>
