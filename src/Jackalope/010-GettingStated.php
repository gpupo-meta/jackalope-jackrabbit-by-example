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

/**
 * The shortest self-contained example should output a line with ‘value’:.
 *
 * @see http://phpcr.readthedocs.io/en/latest/book/getting_started.html
 */

// retrieve the root node of the repository ("/")
$root = $session->getRootNode();

// add a new node
$node = $root->addNode('test', 'nt:unstructured');

// set a property on the newly created property
$node->setProperty('prop', 'value');

// save the session, i.e. persist the data
$session->save();

// retrieve the newly created node
$node = $session->getNode('/test');
echo $node->getPropertyValue('prop'); // outputs "value"
