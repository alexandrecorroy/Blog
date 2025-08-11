FROM php:7.2-fpm-alpine

# Installer dépendances système et extensions PHP
RUN apk add --no-cache \
        bash \
        curl \
        git \
        unzip \
        icu-dev \
        libzip-dev \
        mariadb-client \
    && docker-php-ext-install pdo pdo_mysql zip intl

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Copier et installer les dépendances PHP
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Copier le code source
COPY . .

# Droits pour www-data
RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000
CMD ["php-fpm"]
