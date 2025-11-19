FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx git curl unzip libpq-dev libzip-dev libpng-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Clear Laravel caches
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

# Remove default nginx config and copy custom
RUN rm -f /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Expose Render port
EXPOSE 10000

# Run both Nginx and PHP-FPM in foreground
CMD ["sh", "-c", "php-fpm && nginx -g 'daemon off;'"]
