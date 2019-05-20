<?php
namespace Tests;

use Helpers\ConfigParams;
use Language\Config;
use PHPUnit\Framework\TestCase;

/**
 * Testing all the functionality of Config class
 *
 * Class ConfigTest
 * @package Tests
 */
class ConfigTest extends TestCase
{
    /**
     * Test assert for empty answer by wrong key
     */
    public function testWrongKey()
    {
        /** @var null $result */
        $result = Config::get('');
        $this->assertEmpty($result);
    }

    /**
     * Test assert for empty answer by `system.paths.root` key
     *
     * @return string
     */
    public function testNotEmptyKeyPathRoot(): string
    {
        /** @var string $result */
        $result = Config::get(ConfigParams::SYSTEM_PATH_ROOT);
        $this->assertNotEmpty($result);

        return $result;
    }

    /**
     * Test assert value by `system.paths.root` key
     *
     * @depends testNotEmptyKeyPathRoot
     * @param string $result
     */
    public function testKeyPathRoot(string $result)
    {
        /** @var string $correctResult */
        $correctResult = realpath(dirname(__FILE__) . '/../');

        $this->assertTrue($result === $correctResult);
    }

    /**
     * Test assert for empty answer by `system.translated_applications` key
     *
     * @return array
     */
    public function testNotEmptyKeyTranslatedApplications(): array
    {
        /** @var array $result */
        $result = Config::get(ConfigParams::SYSTEM_TRANS_APPS);
        $this->assertNotEmpty($result);

        return $result;
    }

    /**
     * Test assert value by `system.translated_applications` key
     *
     * @depends testNotEmptyKeyTranslatedApplications
     * @param array $result
     */
    public function testKeyTranslatedApplications(array $result)
    {
        /** @var array $correctResult */
        $correctResult = ['portal' => ['en', 'hu']];

        $this->assertTrue($result === $correctResult);
    }
}
