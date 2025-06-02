FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo_mysql zip

WORKDIR /var/www

COPY . .

RUN curl -sS https://getcomposer.org/installer | php && \
    php composer.phar install

CMD ["php-fpm"]
