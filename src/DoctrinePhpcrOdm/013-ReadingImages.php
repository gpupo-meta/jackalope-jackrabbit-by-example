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

$finder = new Finder();
$finder->files()->name('*.jpg')->in(dirname(__FILE__, 3).'/Resources/images/catalog/product/');

foreach ($finder as $f) {
    $nodeName = $f->getRelativePathname();
    $file = $documentManager->find(null, '/catalog/product/'.$nodeName);
    $content = $file->getContent();
    $data = $content->getData();

    echo sprintf("\nImage %s:\n\tSize in jackrabbit is %d bytes and %d in local filesystem\n", $nodeName, $content->getSize(), $f->getSize());

    foreach (['MimeType', 'Encoding', 'LastModified', 'LastModifiedBy', 'Mime'] as $prop) {
        $method = 'get'.$prop;
        $value = $content->{$method}();

        if ($value instanceof \DateTime) {
            $value = $value->format('Y-m-d H:i:s');
        }
        echo sprintf("\r\t\$content->%s() delivery %s: [%s]\n", $method, $prop, $value);
    }

    echo sprintf("\r\t** \$file->getContent() is a %s class\n", get_class($content));
    echo sprintf("\r\t** \$file->getContent()->getData() is a %s class\n", $data);

    $temporaryImageFilename = sprintf('%s/var/image-fetched-from-jackrabbit-%s', dirname(__FILE__, 3), $nodeName);
    file_put_contents($temporaryImageFilename, $file->getFileContent());
    echo sprintf("\r\t** Image saved at %s\n", $temporaryImageFilename);

    echo "\n-------\n";
}
