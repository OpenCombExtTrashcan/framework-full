<?php
use jc\locale\LocaleManager;

require_once __DIR__.'/../common.php';
require_once 'framework/src/lib.php/locale/LocaleManager.php';
require_once 'PHPUnit/Framework/TestCase.php';
/**
 * LocaleManager test case.
 */
class LocaleManagerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var LocaleManager
     */
    private $LocaleManager;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        // TODO Auto-generated LocaleManagerTest::setUp()
        $this->LocaleManager = new LocaleManager('cn');
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        // TODO Auto-generated LocaleManagerTest::tearDown()
        $this->LocaleManager = null;
        parent::tearDown();
    }
    /**
     * Constructs the test case.
     */
    public function __construct ()
    {
        // TODO Auto-generated constructor
    }
    /**
     * Tests LocaleManager->__construct()
     */
    public function test__construct ()
    {
        // TODO Auto-generated LocaleManagerTest->test__construct()
        $this->markTestIncomplete("__construct test not implemented");
        $this->LocaleManager->__construct('cn');
    }
    /**
     * Tests LocaleManager->defaultLocaleName()
     */
    public function testDefaultLocaleName ()
    {
        // TODO Auto-generated LocaleManagerTest->testDefaultLocaleName()
        $this->markTestIncomplete(
        "defaultLocaleName test not implemented");
        $this->LocaleManager->defaultLocaleName(/* parameters */);
    }
    /**
     * Tests LocaleManager->setDefaultLocaleName()
     */
    public function testSetDefaultLocaleName ()
    {
        // TODO Auto-generated LocaleManagerTest->testSetDefaultLocaleName()
        $this->markTestIncomplete(
        "setDefaultLocaleName test not implemented");
        $this->LocaleManager->setDefaultLocaleName(/* parameters */);
    }
    /**
     * Tests LocaleManager->locale()
     */
    public function testLocale ()
    {
        // TODO Auto-generated LocaleManagerTest->testLocale()
        $this->markTestIncomplete("locale test not implemented");
        $this->LocaleManager->locale(/* parameters */);
    }
    /**
     * Tests LocaleManager->createLocale()
     */
    public function testCreateLocale ()
    {
        // TODO Auto-generated LocaleManagerTest->testCreateLocale()
        $this->markTestIncomplete("createLocale test not implemented");
        $this->LocaleManager->createLocale(/* parameters */);
    }
    /**
     * Tests LocaleManager->addLocale()
     */
    public function testAddLocale ()
    {
        // TODO Auto-generated LocaleManagerTest->testAddLocale()
        $this->markTestIncomplete("addLocale test not implemented");
        $this->LocaleManager->addLocale(/* parameters */);
    }
    /**
     * Tests LocaleManager->existsLocale()
     */
    public function testExistsLocale ()
    {
        // TODO Auto-generated LocaleManagerTest->testExistsLocale()
        $this->markTestIncomplete("existsLocale test not implemented");
        $this->LocaleManager->existsLocale(/* parameters */);
    }
    /**
     * Tests LocaleManager->loadSentenceFolder()
     */
    public function testLoadSentenceFolder ()
    {
        $this->LocaleManager->loadSentenceFolder(
			UnitTestDataFolder.'locale/folder1/'
        );
    }
    /**
     * Tests LocaleManager->loadSentencePackage()
     */
    public function testLoadSentencePackage ()
    {
        // TODO Auto-generated LocaleManagerTest->testLoadSentencePackage()
        $this->markTestIncomplete(
        "loadSentencePackage test not implemented");
        $this->LocaleManager->loadSentencePackage(/* parameters */);
    }
}

