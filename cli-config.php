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

$extraCommands = [];
$extraCommands[] = new \Jackalope\Tools\Console\Command\JackrabbitCommand();

if (!isset($argv[1])
    || 'jackalope:run:jackrabbit' === $argv[1]
    || 'list' === $argv[1]
    || 'help' === $argv[1]
) {
    //abort here, do not try to init repository
    return;
}

$params = [
    'jackalope.jackrabbit_uri' => 'http://localhost:8080/server/',
];

$workspace = 'default';
$user = 'admin';
$pass = 'admin';

// bootstrapping the repository implementation. for jackalope, do this:
$factory = new \Jackalope\RepositoryFactoryJackrabbit();
$repository = $factory->getRepository($params);
$credentials = new \PHPCR\SimpleCredentials($user, $pass);
$session = $repository->login($credentials, $workspace);

// prepare the doctrine configuration
$config = new \Doctrine\ODM\PHPCR\Configuration();
$driver = new \Doctrine\ODM\PHPCR\Mapping\Driver\AnnotationDriver(
    new \Doctrine\Common\Annotations\AnnotationReader(),
    'vendor/doctrine/phpcr-odm/lib/Doctrine/ODM/PHPCR/Document'
);
$config->setMetadataDriverImpl($driver);

$dm = \Doctrine\ODM\PHPCR\DocumentManager::create($session, $config);

$helperSet = new \Symfony\Component\Console\Helper\HelperSet([
    'phpcr' => new \PHPCR\Util\Console\Helper\PhpcrHelper($session),
    'phpcr_console_dumper' => new \PHPCR\Util\Console\Helper\PhpcrConsoleDumperHelper(),
    'dm' => new \Doctrine\ODM\PHPCR\Tools\Console\Helper\DocumentManagerHelper(null, $dm),
]);

if (class_exists('Symfony\Component\Console\Helper\QuestionHelper')) {
    $helperSet->set(new \Symfony\Component\Console\Helper\QuestionHelper(), 'question');
} else {
    $helperSet->set(new \Symfony\Component\Console\Helper\DialogHelper(), 'dialog');
}
