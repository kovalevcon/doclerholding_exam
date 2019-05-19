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
    private function getConfigDataViaKey(string $key)
    {
        /** @var array|string $data */
        $data = Config::get($key);
        if (empty($data)) {
            throw new ConfigException("Error while get config data by key; key:{$key}", 500);
        }

        return $data;
    }
}
