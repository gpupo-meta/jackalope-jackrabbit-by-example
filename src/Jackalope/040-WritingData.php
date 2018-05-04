
<?php

/**
 * Creating and updating nodes.
 *
 * @see http://phpcr.readthedocs.io/en/latest/book/writing.html
 */
require __DIR__.'/bootstrap.php';

//get the node from the session
$node = $session->getNode('/data/node');

// add a new node as child of $node
$newnode = $node->addNode('new node', 'nt:unstructured'); // until we have shown node types, just use nt:unstructured as type

// set a property on the new node
$newproperty = $newnode->setProperty('my property', 'my value');

// persist the changes permanently. now they also become visible in other sessions
$session->save();

// have a reference
$targetnode = $session->getNode('/data/sibling/yetanother');

// make sure the target node is referenceable.
$targetnode->addMixin('mix:referenceable');
// depending on the implementation, you might need to save the session at
// this point to have the identifier generated

// add a reference property to the node. because the property value is a
// Node, PHPCR will automatically detect that you want a reference
$node->setProperty('my reference', $targetnode);

$session->save();

echo "Moving and deleting nodes\n";

// move the node yetanother and all its children from its parent /sibling to
// the new parent /sibling/child1
// the target parent must already exist, it is not automatically created
// as the move includes the target name, it can also be used to rename nodes
$session->move('/data/sibling/yetanother', '/data/sibling/child1/yetanother');

// for this session, everything that was at /sibling/yetanother is now under /sibling/child1/yetanother
// i.e. /sibling/child1/yetanother/child
// once the session is saved, the move is persisted and visible in other sessions
// alternatively, you can immediatly move the node in the persistent storage

// rename node child2 to child2_new
$workspace = $session->getWorkspace();
$workspace->move('/data/sibling/child2', '/data/sibling/child2_new');

// copy a node and its children (only available on workspace, not inside session)
$workspace->copy('/data/sibling/yetanother', '/data/sibling/child1/yetanother');

// delete a node
$session->removeItem('/data/sibling/child1/yetanother');
