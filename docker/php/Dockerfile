# PHP Version environment variable
ARG PHP_VERSION

# Application environment variable
ARG APP_ENV

# Application timezone variable
ARG TIMEZONE

FROM php:$PHP_VERSION-fpm-alpine

# Remote working directory environment variable
ARG REMOTE_WORKING_DIR

WORKDIR $REMOTE_WORKING_DIR

RUN apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        curl-dev \
        imagemagick-dev \
        libtool \
        libxml2-dev \
        postgresql-dev \
        oniguruma-dev \
        sqlite-dev \
    && apk add --no-cache \
        curl \
        git \
        imagemagick \
        mysql-client \
        postgresql-libs \
        libintl \
        icu \
        icu-dev \
        libzip-dev \
        shadow \
        npm \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        curl \
        iconv \
        mbstring \
        opcache \
        mysqli \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        pdo_sqlite \
        pcntl \
        tokenizer \
        xml \
        zip \
        intl \
    && curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer \
    && apk del -f .build-deps \
    && usermod -u 1000 www-data && groupmod -g 1000 www-data 

# INstall xdebug,
RUN if [ $APP_ENV = "dev" ]; then \
   pecl install xdebug \
   && echo "xdebug.remote_enable=on\n" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
   && echo "xdebug.remote_autostart=on\n" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
   && echo "xdebug.remote_port=9000\n" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
   && echo "xdebug.remote_handler=dbgp\n" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
   && echo "xdebug.remote_connect_back=1\n" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
   && docker-php-ext-enable xdebug \
   && rm -rf /tmp/*; \
fi;

# Add UID '1000' to www-data

# Copy existing application directory permissions
COPY --chown=www-data:www-data . $REMOTE_WORKING_DIR

# Change current user to www
USER www-data
# Run php-fpm
CMD ["php-fpm"]
