<?php

require __DIR__.'/bootstrap.php';

$session->importXML('/', __DIR__.'/../../Resources/011.xml', \PHPCR\ImportUUIDBehaviorInterface::IMPORT_UUID_CREATE_NEW);
$session->save();
