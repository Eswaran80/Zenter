FROM php:8.2-fpm

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

RUN rm -f /etc/nginx/conf.d/default.conf

COPY nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

CMD service nginx start && php-fpm
