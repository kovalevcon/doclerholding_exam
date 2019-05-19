<?php
namespace Traits;

/**
 * Trait FileSystemHandler
 * @package Traits
 */
trait FileSystemHandler
{
    /**
     * Check is filename exists and is a directory, if not create new directory
     *
     * @param string $dir
     */
    public function checkDir(string $dir): void
    {
        if (!is_dir(dirname($dir))) {
            mkdir(dirname($dir), 0755, true);
        }
    }

    /**
     * Write data to file
     *
     * @param string $dest
     * @param array|string $data
     * @return bool
     */
    public function writeFile($dest, $data): bool
    {
        $this->checkDir($dest);
        return (bool)file_put_contents($dest, $data);
    }
}
