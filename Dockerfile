FROM php:8.3

RUN apt-get update -y && apt-get upgrade -y && apt-get install -qqy --no-install-recommends && \
    docker-php-ext-install pdo pdo_mysql mysqli

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini && \
    sed -i 's|^error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT$|error_reporting = E_ALL|g' /usr/local/etc/php/php.ini

RUN apt-get clean autoclean && apt-get autoremove --yes && rm -rf /var/lib/{apt,dpkg,cache,log}/
