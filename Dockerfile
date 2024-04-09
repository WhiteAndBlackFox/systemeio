FROM php:8.3-cli-alpine as sio_test
RUN apk add --no-cache git  \
    zip  \
    bash  \
    supervisor  \
    mysql-client \
    zlib-dev \
    libpng-dev \
    libzip-dev \
    shadow \
    icu

RUN apk add --update yaml-dev

RUN apk add --no-cache --virtual .build-deps \
  oniguruma-dev \
  autoconf \
  g++ \
  make \
  icu-dev \
  linux-headers

RUN pecl channel-update pecl.php.net
RUN pecl install yaml && docker-php-ext-enable yaml

RUN set -xe \
  && pecl install xdebug \
  && pecl install redis \
  && docker-php-ext-enable xdebug \
  && docker-php-ext-enable redis \
  && docker-php-ext-configure pdo_mysql --with-pdo-mysql \
  && docker-php-ext-install -j$(nproc) \
    opcache \
    mbstring \
    gd \
    pdo_mysql \
    exif \
    sockets \
    zip \
    intl \
  && apk del .build-deps \
  && rm -rf /tmp/* /var/cache/apk/*

COPY cfg/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /app
WORKDIR /app

EXPOSE 8337

ENTRYPOINT ["/usr/bin/supervisord", "-c", "/app/cfg/supervisord.conf"]
