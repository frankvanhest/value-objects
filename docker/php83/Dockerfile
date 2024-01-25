FROM php:8.3-cli

RUN apt-get update && \
    apt-get install -y --no-install-recommends git libzip-dev zip unzip \
    && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
