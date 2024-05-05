# Usando a imagem base do PHP com Apache
FROM php:8.3-apache

# Instalando extensões PHP necessárias para o PostgreSQL e git
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get install -y git

# Copiando o arquivo de configuração do Apache
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Copiando o arquivo do composer.json
COPY composer.json /var/www/html/composer.json

# instalar dependências do composer
RUN composer install

# Ativando mod_rewrite do Apache
RUN a2enmod rewrite

# install pdo_driver mysql
RUN docker-php-ext-install pdo_mysql

# copy .htaccess file
COPY .htaccess /var/www/html/.htaccess

# Reiniciando o Apache
RUN service apache2 restart