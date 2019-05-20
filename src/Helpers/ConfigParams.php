<?php
namespace Helpers;

/**
 * Helper for get ApiCall parameters
 *
 * Class ConfigParams
 * @package Helpers
 */
class ConfigParams
{
    const
        SYSTEM_PATH_ROOT    = 'system.paths.root',
        SYSTEM_TRANS_APPS   = 'system.translated_applications'
    ;

    /**
     * Get array of parameters for ApiCall `getLanguageFile`
     *
     * @param string $language
     * @return array
     */
    public static function callLanguageFileParams(string $language): array
    {
        return [
            'system_api',
            'language_api',
            [
                'system' => 'LanguageFiles',
                'action' => 'getLanguageFile'
            ],
            ['language' => $language]
        ];
    }

    /**
     * Get array of parameters for ApiCall `getAppletLanguages`
     *
     * @param string $applet
     * @return array
     */
    public static function callAppletFileParams(string $applet): array
    {
        return [
            'system_api',
            'language_api',
            [
                'system' => 'LanguageFiles',
                'action' => 'getAppletLanguages'
            ],
            ['applet' => $applet]
        ];
    }

    /**
     * Get array of parameters for ApiCall `getAppletLanguageFile`
     *
     * @param string $applet
     * @param string $language
     * @return array
     */
    public static function callAppletLanguageFileParams(string $applet, string $language): array
    {
        return [
            'system_api',
            'language_api',
            [
                'system' => 'LanguageFiles',
                'action' => 'getAppletLanguageFile'
            ],
            [
                'applet'    => $applet,
                'language'  => $language
            ]
        ];
    }
}
