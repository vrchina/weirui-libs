FROM php:5-apache
MAINTAINER Cee <yezixi@live.cn>

RUN apt-get update -qq
RUN apt-get upgrade -y
RUN apt-get install -y git discount zlib1g-dev
RUN docker-php-ext-install mbstring zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN ln -s ../mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load
RUN ln -s ~/.composer/vendor/bin/* /usr/local/bin/

ADD composer.json /var/www/gmirror-fonts/
WORKDIR /var/www/gmirror-fonts
RUN composer install --no-autoloader --no-scripts --no-dev

ADD . /var/www/gmirror-fonts
RUN composer install --no-dev && \
  chmod -R 777 storage/
RUN echo "<?php require_once __DIR__ . '/start.php';?>" > ./resources/views/index.php && \
  markdown README.md >> ./resources/views/index.php && \
  echo "<?php require_once __DIR__ . '/end.php';?>" >> ./resources/views/index.php
ADD apache2/sites-enabled/ /etc/apache2/sites-enabled/
