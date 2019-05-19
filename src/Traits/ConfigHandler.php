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
     * Gets the directory of the cached language files.
     *
     * @param string $application The application.
     * @param $language
     * @return string   The directory of the cached language files.
     */
    public function getLanguageFilePath($application, $language)
    {
        return Config::get('system.paths.root') . "/cache/{$application}/{$language}.php";
    }
}
