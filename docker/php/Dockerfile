FROM php:8.1-fpm
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    ffmpeg \
    && docker-php-ext-install pdo_mysql
WORKDIR /var/www/html