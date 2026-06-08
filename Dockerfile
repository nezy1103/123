FROM php:8.2-apache

# Включаем модуль mod_rewrite, который нужен для работы нашего роутинга
RUN a2enmod rewrite

# Копируем все файлы проекта в контейнер
COPY . /var/www/html/

# Копируем наш кастомный конфиг Apache, заменяя стандартный
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Устанавливаем правильного владельца и права доступа для файлов
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

EXPOSE 80
