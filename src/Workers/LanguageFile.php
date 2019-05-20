<?php
namespace Workers;

use Exception;
use Exceptions\ApiResponseException;
use Exceptions\ConfigException;
use Helpers\ConfigParams;
use Helpers\Log;

/**
 * Class realize all business logic for work with LanguageFile
 *
 * Class LanguageFile
 * @package Workers
 */
class LanguageFile extends LanguageBase
{
    /**
     * @inheritDoc
     */
    public function generateFiles(): void
    {
        try {
            foreach ($this->getConfigDataViaKey(ConfigParams::SYSTEM_TRANS_APPS) as $application => $languages) {
                foreach ($languages as $language) {
                    $this->saveFile($application, $language);
                }
            }
        } catch (ConfigException $e) {
            $e->report();
        } catch (Exception $e) {
            Log::error("Unexpected application error: {$e->getMessage()}");
        }
    }

    /**
     * @inheritDoc
     */
    public function saveFile(string $app, string $language): void
    {
        try {
            /** @var string $result */
            $filename = $this->getLanguageFilePath($app, $language);
            $this->writeFile($filename, $this->apiCallLanguageFile($language));
            Log::success("Created `{$language}` language file: {$filename}");
        } catch (ApiResponseException $e) {
            Log::error("Api response error: {$e->getMessage()}");
        } catch (Exception $e) {
            Log::error("Unexpected application error: {$e->getMessage()}");
        }
    }
}
