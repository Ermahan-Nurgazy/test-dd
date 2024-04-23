FROM ubuntu:20.04
MAINTAINER naur1970
ENV DEBIAN_FRONTEND noninteractive
ENV DEBCONF_NONINTERACTIVE_SEEN true

RUN apt update -yq && apt upgrade -qy &&  \
    apt install -yq curl nano git wget mc mysql-client graphicsmagick imagemagick ghostscript iputils-ping locales apt-utils \
    software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt install -yq php8.1 php8.1-fpm \
    php8.1-curl \
    php8.1-gd \
    php8.1-ldap \
    php8.1-mbstring \
    php8.1-mysql \
    php8.1-soap \
    php8.1-pgsql \
    php8.1-xml \
    php8.1-zip \
    php-dev \
    autoconf \
    zlib1g-dev \
    libmcrypt-dev \
    php8.1-intl \
    php8.1-bcmath \
    php8.1-imagick \
    php8.1-memcached \
    php8.1-memcache \
    php8.1-redis \
    php8.1-xdebug \
    phpunit && \
    cd ~ && \
    curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/bin --filename=composer \
    apt-get clean && rm -rf /var/lib/apt/lists/*

RUN locale-gen ru_RU ru_RU.UTF-8 en_US.UTF-8 en_GB.UTF-8 de_DE.UTF-8 es_ES.UTF-8 fr_FR.UTF-8 it_IT.UTF-8 km_KH sv_SE.UTF-8 fi_FI.UTF-8 && \
    echo "extension=grpc.so" >> /etc/php/8.1/mods-available/grpc.ini && \
    echo "extension=mongodb.so" >> /etc/php/8.1/mods-available/mongodb.ini && \
    echo "extension=mcrypt.so" >> /etc/php/8.1/mods-available/mcrypt.ini && \
    phpenmod grpc mongodb

COPY ./php/php-fpm.conf /etc/php/8.1/fpm/php-fpm.conf
COPY ./php/php81.ini /etc/php/8.1/fpm/php.ini
COPY ./php/xdebug.ini /etc/php/8.1/mods-available/xdebug.ini

EXPOSE 9010

# CMD ["sleep", "86400"]
CMD ["php-fpm8.1"]

