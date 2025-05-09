# Use official PHP image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy files
COPY . .

# Set correct permissions
RUN chmod -R 775 storage bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set Laravel environment
RUN php artisan config:clear && \
    php artisan key:generate && \
    php artisan migrate --force && \
    php artisan config:cache

# Render expects your server to run on port 8080
EXPOSE 8080

# Start Laravel app using PHP's built-in server
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
