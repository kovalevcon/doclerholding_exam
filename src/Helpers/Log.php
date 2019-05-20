<?php
namespace Helpers;

/**
 * Class for logging message|error
 *
 * Class Log
 * @package Helpers
 * @method static $this error(string $message)
 * @method static $this success(string $message)
 * @method static $this warning(string $message)
 * @method static $this info(string $message)
 * @method static $this debug(string $message)
 */
class Log
{
    const
        ERROR_LEVEL     = 'error',
        SUCCESS_LEVEL   = 'success',
        WARNING_LEVEL   = 'warning',
        INFO_LEVEL      = 'info',
        DEBUG_LEVEL     = 'debug'
    ;

    /** @var array $levels */
    public static $levels = [
      self::ERROR_LEVEL, self::SUCCESS_LEVEL, self::WARNING_LEVEL, self::INFO_LEVEL, self::DEBUG_LEVEL
    ];

    /**
     * Call static method by method name
     *
     * @param string $method
     * @param array $args
     * @return void
     */
    public static function __callStatic(string $method, array $args): void
    {
        /* @var \Closure $formatter */
        /**
         * @param string $level
         * @param string|array $args
         */
        $formatter = function ($level, $args) {
            $time = date('Y-d-m H:i:s', time());
            printf("[%s] %s: %s\n", $time, strtoupper($level), is_array($args) ? $args[0] : $args);
            return;
        };

        if (php_sapi_name() !== 'cli') {
            in_array($method, self::$levels) ?
                $formatter($method, $args) : $formatter(self::ERROR_LEVEL, 'Undefined method name for Log class')
            ;
        }
    }
}
