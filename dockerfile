FROM php:8.2.4-apache

RUN docker-php-ext-install mysqli
# RUN a2enmod rewrite

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY . /var/www/html/

COPY ./php.ini /usr/local/etc/php/

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 80