#!/usr/bin/env bash
set -o errexit

composer install --no-dev --optimize-autoloader
php artisan storage:link || true
php artisan config:clear
php artisan migrate --force
php artisan key:generate