FROM php:8.1-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
        libsqlite3-dev \
        unzip \
    && docker-php-ext-install pdo pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-interaction --prefer-dist --no-progress

COPY . .
RUN composer dump-autoload --optimize

RUN chown -R www-data:www-data /var/www/html

USER www-data

CMD ["php-fpm"]
