FROM php:8.3-apache

RUN apt-get update && \
    apt-get install -y \
        wait-for-it \
        git \
        zip \
        unzip \
        libicu-dev \
        libzip-dev && \
    a2enmod rewrite  && \
    apt-get clean  && \
    rm -rf /var/lib/apt/lists/*

RUN apt-get update && apt-get install -y \
		libfreetype-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \ 
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-enable opcache && \
    docker-php-ext-install \
    zip \
    pdo_mysql

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
      
COPY rootfs /

RUN mkdir -p /app && \
    echo '' > /app/.env  

RUN mkdir -p /app/var && \
    chown -R www-data:www-data /app && \
    chmod -R 775 /app/var    

ENV APACHE_NO_ACCESS_LOG=true COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /app
VOLUME /app/var/

RUN curl -sSL https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD ["apache2-foreground"]
