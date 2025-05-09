FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git curl unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN chmod -R 775 storage bootstrap/cache

RUN composer install --no-dev --optimize-autoloader

EXPOSE 8080

CMD php artisan config:clear && \
    php artisan config:cache && \
    php artisan migrate --force && \
    php -S 0.0.0.0:8080 -t public
