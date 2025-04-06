FROM php:8.2-fpm

ARG UID
ARG GID

WORKDIR /var/www

# Install Certbot and Nginx dependencies
RUN apt-get update \
    && apt-get install -y certbot python3-certbot-nginx gnupg curl wget ca-certificates unzip lsb-release libpng-dev libjpeg-dev libwebp-dev \
    && apt-get install -y \
        libicu-dev \
        libpq-dev \
        libzip-dev \
        libfreetype6-dev \
    && docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype \
    && docker-php-ext-install intl pdo pdo_mysql mysqli zip bcmath pcntl exif gd opcache \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN apt-get -y autoremove \
    && apt-get clean

RUN deluser www-data \
    && addgroup --gid $GID www-data \
    && adduser --uid $UID --gid $GID --shell /bin/bash www-data

RUN chown -R www-data:www-data /var/www

USER www-data
