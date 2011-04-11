<?php
require_once 'framework/src/lib.php/locale/Locale.php';
/**
 * Locale test case.
 */
class LocaleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Locale
     */
    private $Locale;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        // TODO Auto-generated LocaleTest::setUp()
        $this->Locale = new Locale(/* parameters */);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        // TODO Auto-generated LocaleTest::tearDown()
        $this->Locale = null;
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
     * Tests Locale->__construct()
     */
    public function test__construct ()
    {
        // TODO Auto-generated LocaleTest->test__construct()
        $this->markTestIncomplete("__construct test not implemented");
        $this->Locale->__construct(/* parameters */);
    }
    /**
     * Tests Locale->defaultLocaleName()
     */
    public function testDefaultLocaleName ()
    {
        // TODO Auto-generated LocaleTest->testDefaultLocaleName()
        $this->markTestIncomplete(
        "defaultLocaleName test not implemented");
        $this->Locale->defaultLocaleName(/* parameters */);
    }
    /**
     * Tests Locale->setDefaultLocaleName()
     */
    public function testSetDefaultLocaleName ()
    {
        // TODO Auto-generated LocaleTest->testSetDefaultLocaleName()
        $this->markTestIncomplete(
        "setDefaultLocaleName test not implemented");
        $this->Locale->setDefaultLocaleName(/* parameters */);
    }
    /**
     * Tests Locale->createLocale()
     */
    public function testCreateLocale ()
    {
        // TODO Auto-generated LocaleTest->testCreateLocale()
        $this->markTestIncomplete("createLocale test not implemented");
        $this->Locale->createLocale(/* parameters */);
    }
    /**
     * Tests Locale->addLocale()
     */
    public function testAddLocale ()
    {
        // TODO Auto-generated LocaleTest->testAddLocale()
        $this->markTestIncomplete("addLocale test not implemented");
        $this->Locale->addLocale(/* parameters */);
    }
    /**
     * Tests Locale->existsLocale()
     */
    public function testExistsLocale ()
    {
        // TODO Auto-generated LocaleTest->testExistsLocale()
        $this->markTestIncomplete("existsLocale test not implemented");
        $this->Locale->existsLocale(/* parameters */);
    }
    /**
     * Tests Locale->localeTar()
     */
    public function testLocaleTar ()
    {
        // TODO Auto-generated LocaleTest->testLocaleTar()
        $this->markTestIncomplete("localeTar test not implemented");
        $this->Locale->localeTar(/* parameters */);
    }
    /**
     * Tests Locale->loadSentenceFolder()
     */
    public function testLoadSentenceFolder ()
    {
        // TODO Auto-generated LocaleTest->testLoadSentenceFolder()
        $this->markTestIncomplete(
        "loadSentenceFolder test not implemented");
        $this->Locale->loadSentenceFolder(/* parameters */);
    }
    /**
     * Tests Locale->loadSentencePackage()
     */
    public function testLoadSentencePackage ()
    {
        // TODO Auto-generated LocaleTest->testLoadSentencePackage()
        $this->markTestIncomplete(
        "loadSentencePackage test not implemented");
        $this->Locale->loadSentencePackage(/* parameters */);
    }
}

