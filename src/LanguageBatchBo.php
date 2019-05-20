<?php
namespace Language;

use Workers\LanguageAppletXmlFile;
use Workers\LanguageFile;

/**
 * Business logic related to generating language files.
 *
 * Class LanguageBatchBo
 * @package Language
 */
class LanguageBatchBo implements LanguageBatchBoInterface
{
    /**
     * @inheritDoc
     */
    public function generateLanguageFiles(): void
    {
        (new LanguageFile)->generateFiles();
    }

    /**
     * @inheritDoc
     */
    public static function generateAppletLanguageXmlFiles(): void
    {
        $applets = [
            'memberapplet' => 'JSM2_MemberApplet',
        ];
        (new LanguageAppletXmlFile($applets))->generateFiles();
    }
}
