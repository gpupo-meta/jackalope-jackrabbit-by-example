<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/jackalope-jackrabbit-by-example
 * Created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <https://opensource.gpupo.com/>.
 *
 */

require __DIR__.'/bootstrap.php';
require __DIR__.'/Document/DocumentVersionable.php';

$root = '/doc/child';
$rootDocument = $documentManager->find(null, $root);
$name = 'documentVersionable_'.rand(0,100000);
$id = $root.'/'.$name;

echo sprintf("Create document %s\n", $id);

// create a new document
$doc = new DocumentVersionable();
$doc->setParent($rootDocument);
$doc->setName($name);
$doc->setTitle('My first version of title');
$doc->setContent('Foo');
$documentManager->persist($doc);
$documentManager->flush();

foreach(['Rar', 'Far', 'Lar'] as $key) {
    $documentManager->checkpoint($doc);
    echo sprintf("* Update document %s, version %s\n", $id, $key);
    $doc->setTitle(sprintf('My version %s of title', $key));
    $doc->setContent('Bar'.$key);
    $documentManager->persist($doc);
    $documentManager->flush();
}

$versioninfos = $documentManager->getAllLinearVersions($doc);
echo sprintf("Versions qtd: %s\n", count($versioninfos));
dump($versioninfos);


$thirdVersion = $documentManager->findVersionByName(null, $id, '1.1');
echo sprintf("\$oldVersion is a %s instance\n", get_class($thirdVersion));
echo sprintf("Content of 3rd version is:'%s' \n", $thirdVersion->getContent());

// find the head version
$head = $documentManager->find(null, $id);
echo sprintf("Content of head version is:'%s' \n", $head->getContent());

// restore the head to the third Version
$documentManager->restoreVersion($thirdVersion);

// the doc document is refreshed
echo sprintf("Content of \$doc is:'%s'\n", $head->getContent());
