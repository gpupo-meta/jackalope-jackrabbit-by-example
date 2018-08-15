#!/bin/bash
./vendor/bin/phpcrodm doctrine:phpcr:register-system-node-types

for f in src/DoctrinePhpcrOdm/0*php; do
  echo "File -> $f";
  php $f;
done
