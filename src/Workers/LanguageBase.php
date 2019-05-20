<?php
namespace Workers;

use Traits\ApiHandler;
use Traits\ConfigHandler;
use Traits\FileSystemHandler;

/**
 * Abstract base class for other Language classes
 *
 * Class LanguageBase
 * @package Workers
 */
abstract class LanguageBase implements LanguageInterface
{
    use ApiHandler, ConfigHandler, FileSystemHandler;
}
