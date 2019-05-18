<?php
namespace Language;

/**
 * Class work with configuration
 *
 * Class Config
 * @package Language
 */
class Config
{
    /**
     * Get config path or parameters
     *
     * @param string $key
     * @return array|bool|string|void
     */
    public static function get(string $key)
    {
        switch ($key) {
            case 'system.paths.root':
                return realpath(dirname(__FILE__) . '/../');

            case 'system.translated_applications':
                return ['portal' => ['en', 'hu']];

            default:
                return;
        }
    }
}
