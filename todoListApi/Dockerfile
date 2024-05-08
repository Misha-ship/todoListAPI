
FROM php:8.2-fpm


RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd zip pdo pdo_mysql


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


WORKDIR /var/www
COPY . /var/www


RUN composer install


RUN chown -R www-data:www-data /var/www


EXPOSE 9000


CMD ["php-fpm"]
