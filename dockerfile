FROM php:8.2.4-apache

RUN docker-php-ext-install mysqli
RUN a2enmod rewrite

COPY . /var/www/html/

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 80