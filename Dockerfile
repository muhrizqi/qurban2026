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

# Copy seluruh file proyek ke dalam container (saat masih sebagai root)
USER root
COPY --chown=999:999 . /var/www/html/
RUN chown -R 999:999 /var/www/html

# Kembali ke user webserver (www-data / 999 di serversideup)
USER 999

# Instal dependensi composer (tanpa dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Optimasi (config, route, view) akan dijalankan otomatis oleh image serversideup 
# saat container pertama kali booting (entrypoint).

# PENTING: ServerSideUp menggunakan S6-Overlay yang membutuhkan akses ROOT 
# saat pertama kali container dijalankan (untuk setting konfigurasi nginx dll).
# Setelah setup selesai, sistem otomatis menurunkan aksesnya ke user aman (999).
USER root
