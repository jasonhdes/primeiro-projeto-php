FROM php:7.4-apache

# Install system dependencies and socat (used to proxy localhost:3306 → db:3306)
RUN apt-get update && apt-get install -y \
    socat \
    && rm -rf /var/lib/apt/lists/*

# Enable mysqli extension required by the application
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy application source
COPY . /var/www/html/

# Remove docker-specific files from the web root
RUN rm -f /var/www/html/docker/entrypoint.sh 2>/dev/null || true

# Allow .htaccess overrides
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf \
    && a2enmod rewrite

COPY docker/php.ini /usr/local/etc/php/conf.d/app.ini
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
