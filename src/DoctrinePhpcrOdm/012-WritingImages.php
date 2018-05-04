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

use Doctrine\ODM\PHPCR\Document\File;
use Symfony\Component\Finder\Finder;

$parentDocument = $documentManager->find(null, '/catalog/product');

$finder = new Finder();
$finder->files()->name('*.jpg')->in(dirname(__FILE__, 3).'/Resources/images/catalog/product/');

foreach ($finder as $f) {
    $file = new File();
    $file->setFileContentFromFilesystem($f->getRealPath());
    $nodeName = $f->getRelativePathname();

    if ($documentManager->find(null, '/catalog/product/'.$nodeName)) {
        echo sprintf("Node %s already exists\n", $nodeName);
    } else {
        $file->setNodename($nodeName);
        $file->setParentDocument($parentDocument);
        echo sprintf("Saving node %s \n", $nodeName);
        $documentManager->persist($file);
        $documentManager->flush();
    }
}
