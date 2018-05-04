<?php

/**
 *
 * @see http://phpcr.readthedocs.io/en/latest/book/
 */
use Jackalope\RepositoryFactoryJackrabbit;

set_time_limit(0);

require __DIR__.'/../../vendor/autoload.php';

$parameters = ['jackalope.jackrabbit_uri' => 'http://localhost:8080/server'];
$factory = new RepositoryFactoryJackrabbit();
// end of implementation specific configuration
// get a new PHPCR repository instance from the factory class defined above
$repository = $factory->getRepository($parameters);

// create the credentials object to authenticate with the repository
$credentials = new \PHPCR\SimpleCredentials('admin', 'admin');

// login to the repository and retrieve the session
$session = $repository->login($credentials, 'default');
