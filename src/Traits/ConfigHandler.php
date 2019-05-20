<?php
namespace Traits;

use Exceptions\ConfigException;
use Language\Config;

/**
 * Trait for work with config
 *
 * Trait ConfigHandler
 * @package Traits
 */
trait ConfigHandler
{
    /**
     * Get translated applications
     *
     * @param string $key
     * @return array|string
     * @throws ConfigException
     */
    public function getConfigDataViaKey(string $key)
    {
        /** @var array|string $data */
        $data = Config::get($key);
        if (empty($data)) {
            throw new ConfigException("Error while get config data by key; key:{$key}", 500);
        }

        return $data;
    }

    /**
     * Gets the path to file the cached language files.
     *
     * @param string $application The application.
     * @param string $language
     * @return string   The directory of the cached language files.
     * @throws ConfigException
     */
    public function getLanguageFilePath(string $application, string $language): string
    {
        return $this->getConfigDataViaKey('system.paths.root') . "/cache/{$application}/{$language}.php";
    }

    /**
     * Get the directory of the cached flash
     *
     * @param string $language
     * @return string
     * @throws ConfigException
     */
    public function getFlashFilePath(string $language): string
    {
        return $this->getConfigDataViaKey('system.paths.root') . "/cache/flash/lang_{$language}.xml";
    }
}
