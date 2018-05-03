#!/usr/bin/env php
<?php

/**
 * The shortest self-contained example should output a line with ‘value’:.
 *
 * @see http://phpcr.readthedocs.io/en/latest/book/getting_started.html
 */
use Jackalope\RepositoryFactoryJackrabbit;

set_time_limit(0);

require __DIR__.'/vendor/autoload.php';

$parameters = ['jackalope.jackrabbit_uri' => 'http://localhost:8080/server'];
$factory = new RepositoryFactoryJackrabbit();
// end of implementation specific configuration
// get a new PHPCR repository instance from the factory class defined above
$repository = $factory->getRepository($parameters);

// create the credentials object to authenticate with the repository
$credentials = new \PHPCR\SimpleCredentials('admin', 'admin');

// login to the repository and retrieve the session
$session = $repository->login($credentials, 'default');
