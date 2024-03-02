FROM php:8.2-apache
WORKDIR /var/www/html

RUN echo "Listen 0.0.0.0:80" >> /etc/apache2/apache2.conf

#Mod rewrite
RUN a2enmod  rewrite

# Linux Library
RUN apt-get update -y && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip zip \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev 

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# PHP Extension
RUN docker-php-ext-install gettext intl mysqli pdo pdo_mysql gd zip

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN chmod -R 777 /var/www/html/writable
EXPOSE 8080

CMD ["apache2-foreground"]