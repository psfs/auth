#!/bin/sh
set -eu

vendor/bin/phpunit \
    --configuration src/AUTH/phpunit.xml.dist \
    --coverage-clover psfs-coverage
