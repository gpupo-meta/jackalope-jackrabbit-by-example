#!/bin/bash

for f in 0*php; do
  echo "File -> $f"
  php $f;
done
