FROM php:8.2-apache

# Включаем mod_rewrite
RUN a2enmod rewrite

# Копируем файлы проекта
COPY . /var/www/html/

# Копируем наш кастомный конфиг Apache и заменяем стандартный
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Устанавливаем права
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

EXPOSE 80
