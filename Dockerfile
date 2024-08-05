FROM php:8.3.9-fpm-alpine

ARG WORKDIR=/var/www/html

WORKDIR ${WORKDIR}

RUN apk update

RUN apk add --no-cache $PHPIZE_DEPS

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR ${WORKDIR}

COPY . ${WORKDIR}

RUN #chown -R www-data:www-data ${WORKDIR}

RUN composer install;

#USER www-data

CMD ["php-fpm"]
