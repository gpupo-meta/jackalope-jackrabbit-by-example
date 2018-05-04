<?php

/**
 * While moving is about changing the parent of a node, ordering is used to set the position inside the child list.
 * Preserving and altering order is an optional feature of PHPCR.
 *
 * @see http://phpcr.readthedocs.io/en/latest/book/orderable_child_nodes.html
 */
require __DIR__.'/bootstrap.php';

//get the node from the session
$node = $session->getNode('/data/node');

$node->addNode('first');
$node->addNode('second'); // new nodes are added to the end of the list
// order is: first, second

foreach ($node->getNodes() as $path => $n) {
    echo $n->getName()."\n";
}

echo "---------\n";

// ordering is done on the parent node. the first argument is the name of
// the child node to be reordered, the second the name of the node to moved
// node is placed before
$node->orderBefore('second', 'first');
// now the order is: second, first

foreach ($node->getNodes() as $path => $n) {
    echo $n->getName()."\n";
}
