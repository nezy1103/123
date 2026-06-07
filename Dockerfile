FROM php:8.2-apache

# Устанавливаем PDO
RUN docker-php-ext-install pdo pdo_mysql

# Включаем mod_rewrite
RUN a2enmod rewrite

# Создаём директорию и копируем конфиг
RUN mkdir -p /var/www/html/public
COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Копируем все файлы
COPY . /var/www/html/

# Устанавливаем правильные права
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \; \
    && chmod 755 /var/www/html/public

EXPOSE 80
