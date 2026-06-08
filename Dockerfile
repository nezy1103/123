FROM php:8.2-apache

# Устанавливаем расширение pdo_mysql
RUN docker-php-ext-install pdo_mysql

# Включаем mod_rewrite для роутинга
RUN a2enmod rewrite

# Копируем файлы проекта
COPY . /var/www/html/

# Устанавливаем права
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

EXPOSE 80
