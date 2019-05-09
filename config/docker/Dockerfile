# php7-fpm/Dockerfile
FROM php:7.2-fpm

MAINTAINER Jérôme Lepeltier <jerome.lepeltier@gmail.com>

RUN apt-get update && apt-get install -y \
    wget \
    git \
    curl \
    unzip \
    zip \
    locales \
    openssl \
    libssl-dev \
    libgmp-dev \
    libxml2-dev \
    zlib1g-dev libicu-dev g++ \
    iptables

RUN sed -i -e 's/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/' /etc/locale.gen && \
    dpkg-reconfigure --frontend=noninteractive locales && \
    update-locale LANG=en_US.UTF-8

ENV LANG en_US.UTF-8

RUN echo "date.timezone = \"Europe/Paris\"" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "memory_limit = -1" >> /usr/local/etc/php/conf.d/php.ini \
    && rm /etc/localtime \
    && ln -s /usr/share/zoneinfo/Europe/Paris /etc/localtime

# Remove to use custom unix socket
RUN rm /usr/local/etc/php-fpm.d/www.conf \
    && rm /usr/local/etc/php-fpm.d/zz-docker.conf

# php extensions
RUN ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h \
    && docker-php-ext-configure intl \
    && docker-php-ext-install gmp intl zip soap pcntl mysqli pdo pdo_mysql \
    && pecl install xdebug-2.6.0 \
    && docker-php-ext-enable xdebug \
    && rm -rf /tmp/pear

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --version=1.6.5

RUN adduser --system --uid 1000 --no-create-home dev --group && ln -s /var/www /home/dev && chown dev:dev /home/dev
