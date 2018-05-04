<?php

/**
 * Traversing the hierarchy.
 *
 * @see http://phpcr.readthedocs.io/en/latest/book/reading_data_and_traversal.html
 */
require __DIR__.'/bootstrap.php';

$node = $session->getNode('/data/node');

// getting a node by path relative to the node
$othernode = $node->getNode('../sibling'); // /sibling

// get all child nodes. the $node is Iterable, the iterator being all children
$node = $session->getNode('/data/sibling');
foreach ($node as $name => $child) {
    if ($child->hasProperties()) {
        echo "${name} has properties\n";
    } else {
        echo "${name} does not have properties\n";
    }
}

// get child nodes with the name starting with 'c'
foreach ($node->getNodes('c*') as $name => $child) {
    echo "${name}\n";
}

// get child nodes with the name starting with 'o' or ending with '2' or named 'yetanother'
foreach ($node->getNodes(['o*', '*2', 'yetanother']) as $name => $child) {
    echo "${name}\n";
}

// get the parent node
$parent = $node->getParent(); // /

// build a breadcrumb of the node ancestry
$node = $session->getNode('/data/sibling/yetanother');
$i = 0;
$breadcrumb = [];
do {
    ++$i;
    $parent = $node->getAncestor($i);
    $breadcrumb[$parent->getPath()] = $parent->getName();
} while ($parent !== $node);

dump($breadcrumb);
