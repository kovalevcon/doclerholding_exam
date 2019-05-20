<?php
namespace Workers;

/**
 * Interface for Language class
 *
 * Interface LanguageInterface
 * @package Workers
 */
interface LanguageInterface
{
    /**
     * Starts the file generation.
     *
     * @return void
     */
    public function generateFiles(): void;

    /**
     * Save generated language file.
     *
     * @param string $app Application or applet
     * @param string $language
     * @return void
     */
    public function saveFile(string $app, string $language): void;
}
