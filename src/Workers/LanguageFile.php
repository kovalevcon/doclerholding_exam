<?php
namespace Workers;

use Exception;
use Exceptions\ApiResponseException;
use Exceptions\ConfigException;
use Helpers\Log;
use Traits\ApiHandler;
use Traits\ConfigHandler;
use Traits\FileSystemHandler;

/**
 * Class realize all business logic for work with LanguageFile
 *
 * Class LanguageFile
 * @package Workers
 */
class LanguageFile implements LanguageInterface, LanguageFileInterface
{
    use ApiHandler, ConfigHandler, FileSystemHandler;

    /**
     * @inheritDoc
     */
    public function generateFiles(): void
    {
        try {
            foreach ($this->getConfigDataViaKey('system.translated_applications') as $application => $languages) {
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
    public function saveFile(string $application, string $language): void
    {
        try {
            /** @var string $result */
            $filename = $this->getLanguageFilePath($application, $language);
            $this->writeFile($filename, $this->apiCallLanguageFile($language));
            Log::success("Created `{$language}` language file: {$filename}");
        } catch (ApiResponseException $e) {
            Log::error("Api response error: {$e->getMessage()}");
        } catch (Exception $e) {
            Log::error("Unexpected application error: {$e->getMessage()}");
        }
    }
}
