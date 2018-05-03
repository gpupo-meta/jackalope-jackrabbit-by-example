#!/usr/bin/env php
<?php

/**
 * PHPCR provides two languages to build complex queries. SQL2 and Query Object Model (QOM).
 * While SQL2 expresses a query in a syntax similar to SQL, QOM expresses the query as a tree of PHPCR objects.
 *
 * @see http://phpcr.readthedocs.io/en/latest/book/query.html
 */
require __DIR__.'/bootstrap.php';

$workspace = $session->getWorkspace();
$qomFactory = $workspace->getQueryManager()->getQOMFactory();
$source = $qomFactory->selector('a', '[nt:unstructured]');
$query = $qomFactory->createQuery($source, null, array(), array());
$queryResult = $query->execute();

foreach ($queryResult->getNodes() as $path => $node) {
    echo $node->getName() . "\n";
}
