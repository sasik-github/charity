#!/bin/bash

git pull

composer install


gulp

./apidoc.sh
