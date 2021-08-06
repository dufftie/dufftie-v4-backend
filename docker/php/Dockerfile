FROM php:8.0.5-fpm-alpine
RUN apk update; \
    apk upgrade;
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
