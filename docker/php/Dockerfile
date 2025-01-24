FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
        libzip-dev \
        zip \
	&& docker-php-ext-install zip \
	&& docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html