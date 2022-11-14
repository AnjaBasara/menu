FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    && docker-php-ext-install \
    pdo \
    pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

CMD bash -c "composer install --no-interaction && cp .env.example .env && php artisan key:generate && php artisan migrate:fresh && php artisan db:seed && php artisan serve --host=0.0.0.0"
