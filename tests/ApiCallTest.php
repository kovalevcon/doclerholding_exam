<?php
namespace Tests;

use Language\ApiCall;
use PHPUnit\Framework\TestCase;

/**
 * Testing all the functionality of ApiCall class
 *
 * Class ApiCallTest
 * @package Tests
 */
class ApiCallTest extends TestCase
{
    /**
     * Test assert for empty answer by wrong action parameter
     */
    public function testWrongAction()
    {
        $result = ApiCall::call(
            'system_api',
            'language_api',
            [],
            ['language' => 'en']
        );
        $this->assertEmpty($result);
    }

    /**
     * Test assert for not empty get language file
     *
     * @return array|void
     */
    public function testNotEmptyGetLanguageFile()
    {
        $result = ApiCall::call(
            'system_api',
            'language_api',
            [
                'system' => 'LanguageFiles',
                'action' => 'getLanguageFile'
            ],
            ['language' => 'en']
        );
        $this->assertNotEmpty($result);

        return $result;
    }

    /**
     * Test assert value for get language file
     *
     * @depends testNotEmptyGetLanguageFile
     * @param array $result
     */
    public function testGetLanguageFile(array $result)
    {
        /** @var array $correctResult */
        $correctResult = [
            'status' => 'OK',
            'data'   => ApiCall::GET_LANGUAGE_FILE_RESULT
        ];

        $this->assertTrue($result === $correctResult);
    }

    /**
     * Test assert for not empty get applet languages
     *
     * @return array|void
     */
    public function testNotEmptyGetAppletLanguages()
    {
        $result = ApiCall::call(
            'system_api',
            'language_api',
            [
                'system' => 'LanguageFiles',
                'action' => 'getAppletLanguages'
            ],
            ['applet' => 'JSM2_MemberApplet']
        );
        $this->assertNotEmpty($result);

        return $result;
    }

    /**
     * Test assert value for get applet languages
     *
     * @depends testNotEmptyGetAppletLanguages
     * @param array $result
     */
    public function testGetAppletLanguages(array $result)
    {
        /** @var array $correctResult */
        $correctResult = [
            'status' => 'OK',
            'data'   => ['en']
        ];

        $this->assertTrue($result === $correctResult);
    }

    /**
     * Test assert for not empty get applet language file
     *
     * @return array|void
     */
    public function testNotEmptyGetAppletLanguageFile()
    {
        $result = ApiCall::call(
            'system_api',
            'language_api',
            [
                'system' => 'LanguageFiles',
                'action' => 'getAppletLanguageFile'
            ],
            [
                'applet'    => 'JSM2_MemberApplet',
                'language'  => 'en'
            ]
        );
        $this->assertNotEmpty($result);

        return $result;
    }

    /**
     * Test assert value for get applet language file
     *
     * @depends testNotEmptyGetAppletLanguageFile
     * @param array $result
     */
    public function testGetAppletLanguageFile(array $result)
    {
        /** @var array $correctResult */
        $correctResult = [
            'status' => 'OK',
            'data'   => ApiCall::GET_APPLET_LANGUAGE_FILE_RESULT
        ];

        $this->assertTrue($result === $correctResult);
    }
}
