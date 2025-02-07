# Resmi Laravel PHP imajını kullan
FROM php:8.2-fpm

# Çalışma dizini
WORKDIR /var/www

# Composer ve diğer bağımlılıkları yükle
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring gd

# Composer kur
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Laravel bağımlılıklarını yükle
COPY . .

RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# İzinleri ayarla
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# PHP-FPM çalıştır
CMD ["php-fpm"]
