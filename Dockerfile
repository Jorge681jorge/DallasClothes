FROM php:7.4-apache
COPY ./src /var/www/html
WORKDIR /usr/src/
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli