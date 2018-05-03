#!/usr/bin/env php
<?php

/**
 * Nodes can be referenced by unique id (if they are mix:referenceable) or by path.
 * getValue returns the referenced node instance.
 * Properties can only be referenced by path because they can not have a unique id.
 *
 * @see http://phpcr.readthedocs.io/en/latest/book/references.html
 */
require __DIR__.'/bootstrap.php';

$session->importXML('/', __DIR__.'/Resources/020.xml', \PHPCR\ImportUUIDBehaviorInterface::IMPORT_UUID_CREATE_NEW);
$session->save();



$node = $session->getNode('/idExample/source');
// will return you a node if the property is of type REFERENCE or WEAKREFERENCE
$othernode = $node->getPropertyValue('reference');

// force a node
$property = $node->getProperty('reference');
// will additionally try to resolve a PATH or NAME property and even work
// if the property is a STRING that happens to be a valid UUID or to
// denote an existing path
$othernode = $property->getNode();

// get a referenced property
$property = $node->getProperty('path');
$otherproperty = $property->getProperty();
echo $otherproperty->getName() . "\n"; // someproperty
echo $otherproperty->getValue(). "\n"; // Some value
