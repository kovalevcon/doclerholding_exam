<?php
namespace Exceptions;

use Exception;
use Helpers\Log;

/**
 * Base class for other Exceptions
 *
 * Class BaseException
 * @package Exceptions
 */
abstract class BaseException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report(): void
    {
        Log::error($this->getMessage());
    }
}
