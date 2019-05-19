<?php
namespace Workers;

/**
 * Interface for LanguageFile class
 *
 * Interface LanguageFileInterface
 * @package Workers
 */
interface LanguageFileInterface
{
    /**
     * Save generated language file.
     *
     * @param string $application
     * @param string $language
     * @return void
     */
    public function saveFile(string $application, string $language): void;
}
