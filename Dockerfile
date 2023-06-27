FROM php:8.0-fpm

# Install Composer
COPY --from=composer:2.4.0 /usr/bin/composer /usr/bin/composer

# Install Node.js
COPY --from=node:18 /usr/local/bin /usr/local/bin
COPY --from=node:18 /usr/local/lib /usr/local/lib

# Install dependencies
RUN apt-get update && \
    apt-get -y install \
    git \
    zip \
    curl \
    vim \
    sudo \
    unzip \
    cron && \
    docker-php-ext-install pdo_mysql bcmath

# install aws-session-manager
RUN curl "https://s3.amazonaws.com/session-manager-downloads/plugin/latest/ubuntu_64bit/session-manager-plugin.deb" -o "session-manager-plugin.deb"
RUN sudo dpkg -i session-manager-plugin.deb

# Copy files
COPY . /var/www/html
COPY php.ini /usr/local/etc/php/php.ini

# Set working directory
WORKDIR /var/www/html/pist6

# Copy env
# COPY .env.stg .env

# Initilize Laravel Dependencies and Cache
RUN npm install && \
    npm run build && \
    composer install && \
    php artisan cache:clear && \
    php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    composer dump-autoload && \
    php artisan clear-compiled && \
    php artisan optimize && \
    php artisan config:cache && \
    php artisan key:generate

# Change user and group ownership
RUN chown -R www-data:www-data /var/www/html/pist6

# Expose port
EXPOSE 9000

# # 購入時間超過チェック
# RUN echo "55 23 * * * /usr/local/bin/php /var/www/html/pist6/artisan schedule:run" | crontab -
# CMD service cron start && docker-php-entrypoint php-fpm