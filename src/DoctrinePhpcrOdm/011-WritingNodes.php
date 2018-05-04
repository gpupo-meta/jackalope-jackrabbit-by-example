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

use Doctrine\ODM\PHPCR\Document\Generic;
use PHPCR\ItemExistsException;

$catalog = new Generic();
$catalog->setNodename('catalog');
$catalog->setParentDocument($documentManager->find(null, '/'));

$product = new Generic();
$product->setNodename('product');
$product->setParentDocument($catalog);

try {
    $documentManager->persist($catalog);
    $documentManager->persist($product);
    $documentManager->flush();
} catch (ItemExistsException $e) {
    echo sprintf("Warning: %s \n", $e->getMessage());
}
