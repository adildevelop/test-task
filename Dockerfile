FROM php:7.4.27-fpm-buster

RUN apt-get update && apt-get install -y libzip-dev libpq-dev zip && docker-php-ext-install zip pdo pdo_pgsql pgsql

COPY . /var/www/html/

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install