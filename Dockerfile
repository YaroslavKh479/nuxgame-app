FROM php:8.3-apache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Updating packages and installing necessary libraries
RUN apt-get update \
    && apt-get install -y \
        g++ \
        libicu-dev \
        libzip-dev \
        unzip \
        curl \
        supervisor \
        default-mysql-client \
        ca-certificates \
        gnupg \
        lsb-release \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && a2enmod ssl \
    && a2enmod rewrite \
    && docker-php-ext-install \
        intl \
        opcache \
        pdo \
        pdo_mysql \
        bcmath \
        zip \
        pcntl \
        sockets \
        exif \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy source code
COPY ./src/ /var/www

# Copy Apache config
COPY apache_host.conf /etc/apache2/sites-available/000-default.conf

# Copy Supervisor config
COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Entrypoint
COPY ./entrypoint.sh /
RUN chmod +x /entrypoint.sh
ENTRYPOINT [ "/entrypoint.sh" ]

WORKDIR /var/www

CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
