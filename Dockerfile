FROM php:7.4-apache

RUN apt-get update && \
apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
docker-php-ext-install gd

#ADD php.ini /usr/local/etc/php.ini

RUN a2enmod rewrite headers

RUN service apache2 restart