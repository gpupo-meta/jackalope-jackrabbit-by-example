#!/bin/bash

for f in src/DoctrinePhpcrOdm/0*php; do
  echo "File -> $f";
  php $f;
done
