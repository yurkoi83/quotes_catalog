FROM php:8.0-fpm

RUN ["rm","/bin/sh"]
RUN ["ln", "-s", "/bin/bash", "/bin/sh"]

RUN apt-get update \
    && apt-get install -y wget git unzip libpq-dev libicu-dev libpng-dev libzip-dev libjpeg-dev libfreetype6-dev mc htop procps inetutils-ping net-tools telnet npm\
    && pecl install xdebug-3.0.0 \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install -j$(nproc) bcmath \
    && docker-php-ext-install pgsql \
    && docker-php-ext-install zip \
    && docker-php-ext-install gd \
    && docker-php-ext-install mysqli  \
    && docker-php-ext-install pdo  \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install pcntl \
    && docker-php-ext-enable mysqli

ADD ./php.ini /usr/local/etc/php/php.ini
ADD ./xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN wget https://getcomposer.org/installer -O - -q \
    | php -- --install-dir=/bin --filename=composer --quiet \

RUN npm install npm@latest -g && \
    npm install n -g && \
    n latest \

USER 1000

WORKDIR /var/www
