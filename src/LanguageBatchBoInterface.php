<?php
namespace Language;

/**
 * Interface for LanguageBatchBo class
 *
 * Interface LanguageBatchBoInterface
 * @package Language
 */
interface LanguageBatchBoInterface
{
    /**
     * Starts the language file generation.
     *
     * @return void
     */
    public function generateLanguageFiles(): void;

    /**
     * Gets the language files for the applet and puts them into the cache.
     *
     * @return void
     */
    public static function generateAppletLanguageXmlFiles(): void;
}
