#!/usr/bin/env php
<?php

/**
 * The shortest self-contained example should output a line with ‘value’:.
 *
 * @see http://phpcr.readthedocs.io/en/latest/book/getting_started.html
 */
require __DIR__.'/bootstrap.php';

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
