
<?php

/**
 * @see http://phpcr.readthedocs.io/en/latest/book/query.html
 */
require __DIR__.'/bootstrap.php';

// get the query interface from the workspace
$workspace = $session->getWorkspace();
$queryManager = $workspace->getQueryManager();

$sql = "SELECT * FROM [nt:unstructured]
    WHERE [nt:unstructured].[title] = 'Test'
    ORDER BY [nt:unstructured].content";
$query = $queryManager->createQuery($sql, 'JCR-SQL2');
$query->setLimit(10); // limit number of results to be returned
$query->setOffset(1); // set an offset to skip first n results
$queryResult = $query->execute();

foreach ($queryResult->getNodes() as $path => $node) {
    echo $node->getName();
}
