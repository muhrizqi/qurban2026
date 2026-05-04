FROM serversideup/php:8.3-fpm-nginx

# Berpindah ke root untuk menginstal paket sistem
USER root

# Instal PostgreSQL client (untuk pg_dump yang dibutuhkan spatie/laravel-backup)
RUN apt-get update \
    && apt-get install -y postgresql-client \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instal ekstensi PHP untuk PostgreSQL (pdo_pgsql)
RUN install-php-extensions pdo_pgsql zip bcmath intl opcache

# Kembali ke user webserver (www-data / 999 di serversideup)
USER 999

# Copy seluruh file proyek ke dalam container
COPY --chown=999:999 . /var/www/html/

# Instal dependensi composer (tanpa dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Optimasi Laravel
RUN php artisan optimize:clear \
    && php artisan config:cache \
    && php artisan event:cache \
    && php artisan route:cache \
    && php artisan view:cache
