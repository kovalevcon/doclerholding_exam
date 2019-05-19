<?php
namespace Traits;

use Exceptions\ApiResponseException;

/**
 * Trait for work with API
 *
 * Trait ApiHandler
 * @package Traits
 */
trait ApiHandler
{
    /**
     * Checks the api call result.
     *
     * @param mixed $result
     * @param string $source
     * @return void
     * @throws ApiResponseException
     */
    public function checkForApiErrorResult($result, string $source): void
    {
        if (empty($result) || !is_array($result)) {
            throw new ApiResponseException("Got empty or invalid api call; source:{$source}");
        }

        if (!isset($result['status']) || !isset($result['data'])) {
            throw new ApiResponseException("Wrong content in response api call; source:{$source}");
        }

        if ($result['status'] !== 'OK') {
            throw new ApiResponseException(
                sprintf("Wrong response api call; response:%s; source:%s", json_encode($result), $source)
            );
        }
    }
}
