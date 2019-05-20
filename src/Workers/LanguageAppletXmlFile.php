<?php
namespace Workers;

use Exception;
use Exceptions\ConfigException;
use Helpers\Log;

/**
 * Class realize all business logic for work with LanguageAppletXmlFile
 *
 * Class LanguageAppletXmlFile
 * @package Workers
 */
class LanguageAppletXmlFile extends LanguageBase
{
    /** @var array $applets */
    protected $applets;

    /**
     * LanguageAppletXmlFile constructor.
     * @param array $applets
     */
    public function __construct(array $applets)
    {
        $this->applets = $applets;
    }
    /**
     * @inheritDoc
     */
    public function generateFiles(): void
    {
        try {
            foreach ($this->applets as $appletDirectory => $appletLanguageId) {
                /** @var array $languages */
                $languages = $this->apiCallAppletLanguages($appletLanguageId);
                foreach ($languages as $language) {
                    $this->saveFile($appletLanguageId, $language);
                }
            }
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
            $this->writeFile(
                $this->getFlashFilePath($language),
                $this->apiCallAppletLanguageFile($app, $language)
            );
        } catch (ConfigException $e) {
            $e->report();
        } catch (Exception $e) {
            Log::error("Unexpected application error: {$e->getMessage()}");
        }
    }
}
