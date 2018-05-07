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
require __DIR__.'/Document/Document.php';

// get the root node to add our data to it
$rootDocument = $documentManager->find(null, '/');

// create a new document
$doc = new Document();
$doc->setParent($rootDocument);
$doc->setName('doc');
$doc->setTitle('My first document');
$doc->setContent('The document content');

// create a second document
$childDocument = new Document();
$childDocument->setParent($doc);
$childDocument->setName('child');
$childDocument->setTitle('My child document');
$childDocument->setContent('The child document content');

// make the documents known to the document manager
$documentManager->persist($doc);
$documentManager->persist($childDocument);

// store all changes, insertions, etc. with the storage backend
$documentManager->flush();
