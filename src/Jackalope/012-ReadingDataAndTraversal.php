
<?php

/**
 * You can wrap any code into try catch blocks. See the API doc for what exceptions to expect on which calls.
 *
 * @see http://phpcr.readthedocs.io/en/latest/book/reading_data_and_traversal.html
 */
require __DIR__.'/bootstrap.php';

$node = $session->getNode('/data/node');

echo $node->getName()."\n"; // will be 'node'
echo $node->getPath()."\n"; // will be '/data/node'
// get the php value of a property (type automatically determined from stored information)
echo $node->getPropertyValue('title')."\n";

// get the Property object to operate on
$property = $node->getProperty('content');
echo 'Size of '.$property->getPath().' is '.$property->getLength()."\n";

// read a property that could be very long
$property = $node->getProperty('content');

// if it is binary convert into string
$data = $property->getString();
echo $data."\n";

//or
dump($node->getPropertyValue('content'));

echo "------------\n";

// get all properties of this node
foreach ($node->getPropertiesValues() as $name => $value) {
    echo "${name}: ${value}\n";
}
// get the properties of this node with a name starting with 't'
foreach ($node->getPropertiesValues('t*') as $name => $value) {
    echo "${name}: ${value}\n";
}
