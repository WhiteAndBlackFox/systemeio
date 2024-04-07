FROM php:8.3-cli-alpine as sio_test
RUN apk add --no-cache git  \
    zip  \
    bash  \
    supervisor  \
    mysql-client \
    shadow \
    icu

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /app
WORKDIR /app

EXPOSE 8337

ENTRYPOINT ["/usr/bin/supervisord", "-c", "/app/cfg/supervisord.conf"]
