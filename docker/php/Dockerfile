FROM php:8.3-fpm-alpine

WORKDIR /var/www/html

# -----------------------------
# 1. Runtime dependencies
# -----------------------------
RUN apk update && apk add --no-cache \
    bash \
    git \
    zip \
    unzip \
    icu \
    libpng \
    libjpeg-turbo \
    freetype \
    libzip \
    shadow \
    oniguruma \
    libxml2-dev \
    zlib-dev

# -----------------------------
# 2. Build dependencies
# -----------------------------
RUN apk add --no-cache --virtual .build-deps \
        autoconf \
        g++ \
        make \
        mariadb-connector-c-dev \
        oniguruma-dev \
        libzip-dev \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        icu-dev \
        zlib-dev \
        libxml2-dev \
        linux-headers \
    # -----------------------------
    # Install latest Xdebug for PHP 8.3
    # -----------------------------
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    # -----------------------------
    # Configure GD
    # -----------------------------
    && docker-php-ext-configure gd \
        --with-freetype=/usr/include/ \
        --with-jpeg=/usr/include/ \
    # -----------------------------
    # Install PHP extensions for Laravel 12
    # -----------------------------
    && docker-php-ext-install -j$(nproc) \
        mysqli \
        pdo \
        pdo_mysql \
        mbstring \
        zip \
        gd \
        intl \
        bcmath \
    # -----------------------------
    # Remove build dependencies
    # -----------------------------
    && apk del .build-deps

# -----------------------------
# 3. Install Composer
# -----------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# -----------------------------
# 4. Copy application code
# -----------------------------
COPY src/ /var/www/html

# -----------------------------
# 5. Laravel storage + cache permissions
# -----------------------------
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# -----------------------------
# 6. Xdebug configuration
# -----------------------------
RUN { \
    echo "zend_extension=xdebug.so"; \
    echo "xdebug.mode=debug"; \
    echo "xdebug.start_with_request=yes"; \
    echo "xdebug.client_host=host.docker.internal"; \
    echo "xdebug.client_port=9003"; \
  } > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

EXPOSE 9000

# Copy entrypoint script into the image
COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]
