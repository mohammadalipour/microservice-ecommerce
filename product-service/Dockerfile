FROM php:8.2-fpm

# Install dependencies required for AMQP extension
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    wget \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    librabbitmq-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl

# Install AMQP extension via PECL
RUN pecl install amqp && \
    docker-php-ext-enable amqp

# Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Install Symfony CLI (optional, for development)
RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Set working directory
WORKDIR /var/www/html

# Install Symfony CLI (optional, for development)
RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Permissions
RUN usermod -u 1000 www-data && chown -R www-data:www-data /var/www

CMD ["php-fpm"]