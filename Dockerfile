FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx git curl unzip libpq-dev libzip-dev libpng-dev \
    && docker-php-ext-install pdo pdo_mysql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

# Remove default nginx site
RUN rm -f /etc/nginx/sites-enabled/default

# Add our Laravel Nginx config
COPY nginx.conf /etc/nginx/conf.d/laravel.conf

EXPOSE 10000

# IMPORTANT FOR RENDER: php-fpm in foreground mode
CMD ["sh", "-c", "php-fpm -R & nginx -g 'daemon off;'"]
