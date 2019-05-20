<?php
namespace Tests;

use Helpers\ConfigParams;
use Language\ApiCall;
use Language\Config;
use PHPUnit\Framework\TestCase;
use Workers\LanguageFile;

/**
 * Testing all the functionality of `LanguageFile` class
 *
 * Class LanguageFileTest
 * @package Tests
 */
class LanguageFileTest extends TestCase
{
    /** @var \Workers\LanguageFile $instance */
    private $instance;
    /** @var array $incomeValues */
    private $incomeValues = ['app' => 'portal', 'language' => 'en'];

    /**
     * LanguageFileTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->instance = new LanguageFile;
    }

    /**
     * Test assert for get path of language file
     *
     * @throws \Exceptions\ConfigException
     * @return string|void
     */
    public function testLanguageFilePath()
    {
        /** @var string $filePath */
        $filePath = $this->instance->getLanguageFilePath(...(array_values($this->incomeValues)));
        /** @var string $filePathTrue */
        $filePathTrue = Config::get(ConfigParams::SYSTEM_PATH_ROOT) .
            "/cache/{$this->incomeValues['app']}/{$this->incomeValues['language']}.php";
        $this->assertTrue($filePath === $filePathTrue);

        return $filePath;
    }

    /**
     * Test assert for get language file by ApiCall
     *
     * @throws \Exceptions\ApiResponseException
     * @return string|void
     */
    public function testApiCallLanguageFile()
    {
        /** @var string $result */
        $result = $this->instance->apiCallLanguageFile($this->incomeValues['language']);
        /** @var array $resultTrue */
        $resultTrue = ApiCall::call(...(ConfigParams::callLanguageFileParams($this->incomeValues['language'])));
        $this->assertTrue(
            $this->instance->apiCallLanguageFile($this->incomeValues['language']) === $resultTrue['data']
        );

        return $result;
    }

    /**
     * Test assert for success save language file
     *
     * @depends testLanguageFilePath
     * @depends testApiCallLanguageFile
     * @param string $filename
     * @param string  $result
     */
    public function testSuccessSaveFile(string $filename, string $result)
    {
        $this->instance->saveFile(...(array_values($this->incomeValues)));
        $this->assertTrue(
            file_get_contents($filename) === $result
        );
    }

    /**
     * Test assert for generate all language files
     *
     * @throws \Exceptions\ConfigException
     */
    public function testGenerateFiles()
    {
        $this->instance->generateFiles();
        foreach ($this->instance->getConfigDataViaKey(ConfigParams::SYSTEM_TRANS_APPS) as $app => $languages) {
            foreach ($languages as $language) {
                $this->assertTrue(is_file($this->instance->getLanguageFilePath($app, $language)));
            }
        }
    }
}
