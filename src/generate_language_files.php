<?php

chdir(__DIR__);
include_once('../vendor/autoload.php');

/** @var \Language\LanguageBatchBo $languageBatchBo */
$languageBatchBo = new \Language\LanguageBatchBo();
$languageBatchBo->generateLanguageFiles();
$languageBatchBo->generateAppletLanguageXmlFiles();
