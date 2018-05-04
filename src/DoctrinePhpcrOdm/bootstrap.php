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

/*
 * The Doctrine PHPCR ODM.
 *
 * @see https://www.doctrine-project.org/projects/doctrine-phpcr-odm/en/latest/index.html#doctrine-php-content-repository-odm-documentation
 */
set_time_limit(0);
$autoload = require_once __DIR__.'/../../vendor/autoload.php';

if (!isset($autoload)) {
    die('Hard');
}

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ODM\PHPCR\Configuration;
use Doctrine\ODM\PHPCR\DocumentManager;
use Doctrine\ODM\PHPCR\Mapping\Driver\AnnotationDriver;
use Jackalope\RepositoryFactoryJackrabbit;

$parameters = ['jackalope.jackrabbit_uri' => 'http://localhost:8080/server'];
$workspace = 'default';
$factory = new RepositoryFactoryJackrabbit();
$repository = $factory->getRepository($parameters);
$credentials = new \PHPCR\SimpleCredentials('admin', 'admin');

$session = $repository->login($credentials, $workspace);

AnnotationRegistry::registerLoader([$autoload, 'loadClass']);

$reader = new AnnotationReader();
$driver = new AnnotationDriver($reader, [
    // this is a list of all folders containing document classes
    'vendor/doctrine/phpcr-odm/lib/Doctrine/ODM/PHPCR/Document',
]);

$config = new Configuration();
$config->setMetadataDriverImpl($driver);
$documentManager = DocumentManager::create($session, $config);
