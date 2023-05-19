FROM php:8.1.19-fpm-alpine
MAINTAINER Dimitar Hristov <Dimitar.N.Hristov@gmail.com>

RUN apk update && \
    apk add \
    gnupg \
    wget \
    zip \
    mc \
    htop \
    curl

RUN apk add --no-cache libzip-dev

RUN set -ex && apk --no-cache add postgresql-dev

RUN docker-php-ext-install zip pdo pdo_pgsql opcache
RUN docker-php-ext-enable opcache

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN echo "alias ll='ls -lah'" >> /root/.bashrc

CMD cd var/www/html

CMD composer update

CMD php artisan migrate

CMD php artisan serve
