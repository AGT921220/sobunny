FROM php:8.2-fpm

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    supervisor \
    libzip-dev \
    zip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libicu-dev \
    && docker-php-ext-install -j$(nproc) iconv mysqli pdo pdo_mysql zip intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mbstring exif pcntl bcmath soap ftp \
    && pecl install redis xdebug \
    && docker-php-ext-enable redis xdebug

# Copiar Composer desde la imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Opcional: Configuración para Laravel
# RUN mkdir -p /var/www/html/bootstrap/cache && \
#     chown -R www-data:www-data /var/www/html/bootstrap/cache && \
#     chmod -R 775 /var/www/html/bootstrap/cache
