# Используем официальный образ PHP 8.3 с FPM
FROM php:8.3-fpm

# Устанавливаем рабочую директорию
WORKDIR "/application"

# Установка зависимостей в одном слое и очистка кеша
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        libzip-dev zip libicu-dev default-libmysqlclient-dev \
        libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
    docker-php-ext-configure intl && \
    docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-install zip intl mysqli pdo pdo_mysql gd && \
    apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Установка Composer через официальный образ
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Права для PHP-FPM
RUN chown -R www-data:www-data /application
USER www-data

# Проверка состояния PHP-FPM
HEALTHCHECK --interval=30s --timeout=3s \
    CMD php-fpm -t || exit 1