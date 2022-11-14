#!/bin/bash

cd /var/www

composer install --no-interaction
php artisan key:generate
php artisan migrate:fresh
php artisan db:seed
php artisan serve --host=0.0.0.0
