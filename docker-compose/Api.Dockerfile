FROM php:8.1.19-fpm-alpine
MAINTAINER Dimitar Hristov <Dimitar.N.Hristov@gmail.com>

RUN apk update && \
    apk add \
    gnupg \
    wget \
    zip \
    mc \
    htop \
    curl \
    vim

RUN apk add --no-cache libzip-dev

RUN set -ex && apk --no-cache add postgresql-dev

RUN docker-php-ext-install zip pdo pdo_pgsql opcache
RUN docker-php-ext-enable opcache
RUN apk add --no-cache pcre-dev $PHPIZE_DEPS \
        && pecl install redis \
        && docker-php-ext-enable redis.so

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN echo "alias ll='ls -lah'" >> /root/.bashrc

CMD composer update

CMD chmod 777 ./start-api.sh

CMD ./start-api.sh