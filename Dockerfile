FROM php:8.2-cli 

RUN apt update

# Required tools
RUN apt -y install \
    unzip \
    libicu-dev \
    curl

# PHP extensions
RUN docker-php-ext-install \
    intl \
    pdo_mysql
    
WORKDIR /app

COPY . .

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

# Locale
ENV LC_ALL=C.UTF-8