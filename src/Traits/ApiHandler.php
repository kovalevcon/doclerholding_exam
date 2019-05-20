<?php
namespace Traits;

use Exceptions\ApiResponseException;
use Helpers\ConfigParams;
use Language\ApiCall;

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

    /**
     * Api call gets the language file for the given language and stores it.
     *
     * @param string $language
     * @return string
     * @throws ApiResponseException
     */
    public function apiCallLanguageFile(string $language): string
    {
        return $this->apiCallRequest(ConfigParams::callLanguageFileParams($language));
    }

    /**
     * Api call gets the available languages for the given applet.
     *
     * @param string $applet
     * @return array
     * @throws ApiResponseException
     */
    public function apiCallAppletLanguages(string $applet): array
    {
        /** @var array $result */
        $result = ApiCall::call(
            ...(ConfigParams::callAppletFileParams($applet))
        );

        $this->checkForApiErrorResult($result, __METHOD__);

        return $result['data'];
    }

    /**
     * Gets a language xml for an applet.
     *
     * @param string $applet
     * @param string $language
     * @return string
     * @throws ApiResponseException
     */
    public function apiCallAppletLanguageFile(string $applet, string $language): string
    {
        /** @var array $result */
        $result = ApiCall::call(
            ...(ConfigParams::callAppletLanguageFileParams($applet, $language))
        );

        $this->checkForApiErrorResult($result, __METHOD__);

        return $result['data'];
    }

    /**
     * Send Api Call request
     *
     * @param array $params
     * @return array|string
     * @throws \Exceptions\ApiResponseException
     */
    private function apiCallRequest(array $params)
    {
        /** @var array $result */
        $result = ApiCall::call(...$params);
        $this->checkForApiErrorResult($result, __METHOD__);

        return $result['data'];
    }
}
