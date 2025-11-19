FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y git unzip libzip-dev libpng-dev curl \
    && docker-php-ext-install pdo_mysql zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Clear caches
RUN php artisan config:clear && php artisan route:clear && php artisan view:clear

# Expose Render port
EXPOSE 10000

# Start Laravel built-in server
CMD php artisan serve --host=0.0.0.0 --port=10000
