# Use official PHP image with required extensions
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libzip-dev \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql zip

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

# Install PHP dependencies without dev tools
RUN composer install --no-dev --optimize-autoloader

# Laravel setup commands (you can customize for production)
RUN php artisan config:clear \
    && php artisan key:generate \
    && php artisan migrate --force || true

# Expose port 9000 and start php-fpm
EXPOSE 9000
CMD ["php-fpm"]
