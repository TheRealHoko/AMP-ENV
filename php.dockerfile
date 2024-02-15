FROM php:apache

RUN docker-php-ext-install pdo pdo_mysql
RUN pecl install xdebug && docker-php-ext-enable xdebug

COPY ./apache_conf/MyVHost.conf /etc/apache2/sites-available/MyVHost.conf

RUN a2dissite 000-default.conf \
    && a2ensite MyVHost.conf