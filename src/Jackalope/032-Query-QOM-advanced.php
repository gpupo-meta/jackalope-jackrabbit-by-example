<?php

/**
 * The Query Builder: a fluent interface for QOM.
 *
 * @see http://phpcr.readthedocs.io/en/latest/book/query.html
 */
require __DIR__.'/bootstrap.php';

use PHPCR\Query\QOM\QueryObjectModelConstantsInterface;
use PHPCR\Util\QOM\QueryBuilder;

$workspace = $session->getWorkspace();
$qomFactory = $workspace->getQueryManager()->getQOMFactory();

$qf = $qomFactory;
$qb = new QueryBuilder($qomFactory);
//add the source
$qb->from($qomFactory->selector('a', 'nt:unstructured'))
    //some composed constraint
    ->andWhere($qf->comparison(
        $qf->propertyValue('a', 'title'),
    QueryObjectModelConstantsInterface::JCR_OPERATOR_EQUAL_TO,
    $qf->literal('Test')
    ))
    //orderings (descending by default)
    ->orderBy($qf->propertyValue('a', 'content'))
    //set an offset
    ->setFirstResult(0)
    //and the maximum number of node-tuples to retrieve
    ->setMaxResults(25);
$result = $qb->execute();

foreach ($result->getNodes() as $node) {
    echo $node->getName().' has content: '.$node->getPropertyValue('content')."\n";
}
//node has content: This is some test content
//sibling has content: This is another test content
