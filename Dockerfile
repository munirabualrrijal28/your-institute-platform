FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Set Laravel permissions
RUN chmod -R 775 storage bootstrap/cache

# Set Laravel app key (or run from entrypoint)
RUN php artisan config:clear
RUN php artisan key:generate
RUN php artisan migrate --force
RUN php artisan storage:link || true

# Start Laravel server
CMD php artisan serve --host=0.0.0.0 --port=8080
