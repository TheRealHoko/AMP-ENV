FROM php:apache

RUN docker-php-ext-install pdo pdo_mysql

COPY ./apache_conf/MyVHost.conf /etc/apache2/sites-available/MyVHost.conf

RUN a2dissite 000-default.conf \
    && a2ensite MyVHost.conf