FROM alpine:3.14

LABEL maintainer="Vincent Composieux <vincent.composieux@gmail.com>"

RUN apk add --update --no-cache \
    coreutils \
    php8-fpm \
    php8-pecl-apcu \
    php8-ctype \
    php8-curl \
    php8-dom \
    php8-gd \
    php8-iconv \
    php8-json \
    php8-intl \
    php8-fileinfo\
    php8-mbstring \
    php8-opcache \
    php8-openssl \
    php8-pdo \
    php8-pdo_pgsql \
    php8-xml \
    php8-zlib \
    php8-phar \
    php8-tokenizer \
    php8-session \
    php8-simplexml \
    php8-xdebug \
    php8-zip \
    php8-xmlreader \
    php8-xmlwriter \
    php8-soap \
    make \
    curl

RUN ln -s /usr/bin/php8 /usr/bin/php
RUN echo "$(curl -sS https://composer.github.io/installer.sig) -" > composer-setup.php.sig \
        && curl -sS https://getcomposer.org/installer | tee composer-setup.php | sha384sum -c composer-setup.php.sig \
        && php8 composer-setup.php && rm composer-setup.php* \
        && chmod +x composer.phar && mv composer.phar /usr/bin/composer

CMD ["php-fpm8", "-F"]

WORKDIR /var/www/robot
EXPOSE 9001
