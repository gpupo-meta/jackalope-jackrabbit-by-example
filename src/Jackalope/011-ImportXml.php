
<?php

/**
 * The shortest self-contained example should output a line with ‘value’:.
 *
 * @see http://phpcr.readthedocs.io/en/latest/book/getting_started.html
 */
require __DIR__.'/bootstrap.php';

$session->importXML('/', __DIR__.'/../../Resources/011.xml', \PHPCR\ImportUUIDBehaviorInterface::IMPORT_UUID_CREATE_NEW);
$session->save();
