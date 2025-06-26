# Gunakan PHP + Apache
FROM php:8.2-apache

# Install ekstensi dan tools
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    libzip-dev libpq-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql zip

# Aktifkan mod_rewrite untuk Laravel
RUN a2enmod rewrite

# Salin semua file ke dalam container
COPY . /var/www/html

# Ubah direktori kerja
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Jalankan instalasi Laravel dan build assets
RUN composer install --no-dev --optimize-autoloader \
    && npm install && npm run build \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Laravel akan jalan otomatis lewat Apache
