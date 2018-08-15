Educational usage of phpcr with jackalope-jackrabbit

## Requirements

* Docker
* Composer
* Git

## Install

	git clone https://github.com/gpupo/jackalope-jackrabbit-by-example.git;
	cd jackalope-jackrabbit-by-example;
	composer install

## Content Repository Server

Run [gpupo/content-repository-server](https://github.com/gpupo/content-repository-server)

	docker run -p 8080:8080 gpupo/content-repository-server

Open [Jackrabbit JCR Server dashboard](https://localhost:8080) (optional)

At first time, register node types:

 	./vendor/bin/phpcrodm doctrine:phpcr:register-system-node-types

More info for Jackrabbit [see]( http://jackrabbit.apache.org/)

## Examples

* ``src/Jackalope`` - Operations using phpcr with jackalope-jackrabbit
* ``src/DoctrinePhpcrOdm`` - Operations using Doctrine PHPCR ODM over phpcr with jackalope-jackrabbit

Execute samples

	./run-all.sh
