FROM php:8.2-apache

# Включаем mod_rewrite
RUN a2enmod rewrite

# Копируем все файлы проекта
COPY . /var/www/html/

# Заменяем стандартный apache2.conf на наш кастомный
COPY apache2.conf /etc/apache2/apache2.conf

# Устанавливаем права
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

EXPOSE 80
