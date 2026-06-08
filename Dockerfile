FROM php:8.2-apache

# Включаем mod_rewrite (на всякий случай, если будем использовать роутинг)
RUN a2enmod rewrite

# Копируем все файлы проекта в корень Apache
COPY . /var/www/html/

# Устанавливаем права
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

EXPOSE 80
