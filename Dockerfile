# Use official PHP image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Set correct permissions
RUN chmod -R 775 storage bootstrap/cache

# COPY .env.example .env

# Install dependencies
RUN composer install --no-dev --optimize-autoloader


# Laravel setup
RUN php artisan config:clear && \
    php artisan config:cache && \
    php artisan key:generate

# Expose the port Laravel will run on
EXPOSE 8080

# Run Laravel development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
