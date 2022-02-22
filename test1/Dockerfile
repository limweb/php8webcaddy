FROM limweb/webphp:v8.1 as composer
USER root
WORKDIR /var/www/html
COPY web/composer.json /var/www/html/composer.json
RUN  /usr/bin/composer install

FROM composer as app
USER root
COPY ./web /var/www/html/
