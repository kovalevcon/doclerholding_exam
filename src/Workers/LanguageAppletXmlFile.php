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
            Log::info("Start process of generate applet language xml files.");
            foreach ($this->applets as $appletDirectory => $appletLanguageId) {
                /** @var array $languages */
                $languages = $this->apiCallAppletLanguages($appletLanguageId);
                foreach ($languages as $language) {
                    $this->saveFile($appletLanguageId, $language);
                }
            }
        } catch (Exception $e) {
            Log::error("Unexpected application error: {$e->getMessage()}.");
        } finally {
            Log::info("End process of generate applet language xml files.");
        }
    }

    /**
     * @inheritDoc
     */
    public function saveFile(string $app, string $language): void
    {
        try {
            /** @var string $filename */
            $filename = $this->getFlashFilePath($language);
            $this->writeFile(
                $filename,
                $this->apiCallAppletLanguageFile($app, $language)
            );
            Log::success("Created applet language file: {$filename}.");
        } catch (ConfigException $e) {
            $e->report();
        } catch (Exception $e) {
            Log::error("Unexpected application error: {$e->getMessage()}.");
        }
    }
}
