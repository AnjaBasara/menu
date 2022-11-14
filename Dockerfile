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

COPY ./docker-entrypoint.sh /usr/bin
ENTRYPOINT ["/usr/bin/docker-entrypoint.sh"]
