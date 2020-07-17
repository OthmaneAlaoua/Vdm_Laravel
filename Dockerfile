FROM php:7.4-apache
WORKDIR /app
COPY . /app
ENV TZ=Europe/Paris
ENV APP_KEY="base64:QT1K8GQZKqsFA8ZnACkIalE0Z58l84X0kgcRpiZmCtw="
COPY vhost.conf /etc/apache2/sites-available/000-default.conf
RUN apt-get -o Acquire::Check-Valid-Until=false update && apt install --no-install-recommends -y git unzip nano vim openssl libssl-dev libcurl4-openssl-dev \
    && pecl install mongodb && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongo.ini
COPY php.ini /usr/local/etc/php/php.ini
RUN cat /usr/local/etc/php/php.ini
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" &&  php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction --optimize-autoloader --ignore-platform-reqs && php -m && composer update
RUN chown -R www-data:www-data /app && a2enmod rewrite
EXPOSE 80
#RUN apachectl -D FOREGROUND
