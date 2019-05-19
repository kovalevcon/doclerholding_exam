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
}
