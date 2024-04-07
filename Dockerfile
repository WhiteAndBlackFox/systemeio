FROM php:8.3-cli-alpine as sio_test
RUN apk add --no-cache git zip bash supervisor
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Setup php app user
ARG USER_ID=1000
RUN adduser -u ${USER_ID} -D -H app
USER app

COPY --chown=app . /app
WORKDIR /app

EXPOSE 8337

ENTRYPOINT ["/usr/bin/supervisord", "-c", "/app/cfg/supervisord.conf"]
