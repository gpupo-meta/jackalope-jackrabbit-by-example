Usage of phpcr with jackalope-jackrabbit

## Install

Require composer

	./install.sh

## Examples

### src/Jackalope

Operations using phpcr with jackalope-jackrabbit

### src/DoctrinePhpcrOdm/

Operations using Doctrine PHPCR ODM over phpcr with jackalope-jackrabbit


## Jackrabbit

### Download


More info in the [download page]( http://jackrabbit.apache.org/jcr/downloads.html)


### Run jackrabbit server

	./start-server.sh &

At first time:

 	./vendor/bin/phpcrodm doctrine:phpcr:register-system-node-types

### Watch logs

	tail -f var/jackrabbit/log/*

### Rebuild

1) Stop jackrabbit server
2) Execute ``rm -rfv var/jackrabbit var/*UNDEFINED``
3) Repeat step "Run jackrabbit server" like the first time


## Execute examples

	./run-all.sh
