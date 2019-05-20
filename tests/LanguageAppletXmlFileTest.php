<?php
namespace Tests;

use Helpers\ConfigParams;
use Language\ApiCall;
use Language\Config;
use PHPUnit\Framework\TestCase;
use Workers\LanguageAppletXmlFile;

/**
 * Testing all the functionality of `LanguageAppletXmlFile` class
 *
 * Class LanguageAppletXmlFileTest
 * @package Tests
 */
class LanguageAppletXmlFileTest extends TestCase
{
    /** @var \Workers\LanguageAppletXmlFile $instance */
    private $instance;
    /** @var array $applets */
    private $applets = ['memberapplet' => 'JSM2_MemberApplet'];
    /** @var array $incomeValues */
    private $incomeValues = ['app' => 'JSM2_MemberApplet', 'language' => 'en'];

    /**
     * LanguageFileTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->instance = new LanguageAppletXmlFile($this->applets);
    }

    /**
     * Test assert for get flash path of language file
     *
     * @throws \Exceptions\ConfigException
     * @return string|void
     */
    public function testFlashFilePath()
    {
        /** @var string $filePath */
        $filePath = $this->instance->getFlashFilePath($this->incomeValues['language']);
        /** @var string $filePathTrue */
        $filePathTrue = Config::get(ConfigParams::SYSTEM_PATH_ROOT) .
            "/cache/flash/lang_{$this->incomeValues['language']}.xml";
        $this->assertTrue($filePath === $filePathTrue);

        return $filePath;
    }

    /**
     * Test assert for get applet language file by ApiCall
     *
     * @throws \Exceptions\ApiResponseException
     * @return string|void
     */
    public function testApiCallAppletLanguageFile()
    {
        /** @var array $result */
        $resultTrue = ApiCall::call(
            ...(ConfigParams::callAppletLanguageFileParams(...(array_values($this->incomeValues))))
        );
        /** @var string $result */
        $result = $this->instance->apiCallAppletLanguageFile(...(array_values($this->incomeValues)));
        $this->assertTrue($result === $resultTrue['data']);

        return $result;
    }

    /**
     * Test assert for success save appllet language file
     *
     * @depends testFlashFilePath
     * @depends testApiCallAppletLanguageFile
     * @param string $filename
     * @param string  $result
     */
    public function testSuccessSaveFile(string $filename, string $result)
    {
        $this->instance->saveFile(...(array_values($this->incomeValues)));
        $this->assertTrue(file_get_contents($filename) === $result);
    }

    /**
     * Test assert for generate all applet language files
     *
     * @throws \Exceptions\ConfigException
     * @throws \Exceptions\ApiResponseException
     */
    public function testGenerateFiles()
    {
        $this->instance->generateFiles();
        foreach ($this->applets as $appletDirectory => $appletLanguageId) {
            /** @var array $languages */
            $languages = $this->instance->apiCallAppletLanguages($appletLanguageId);
            foreach ($languages as $language) {
                $this->assertTrue(is_file($this->instance->getFlashFilePath($language)));
            }
        }
    }
}
