FROM php:8.2-apache

# Включаем модуль mod_rewrite для работы роутинга
RUN a2enmod rewrite

# Копируем все файлы проекта в стандартную папку Apache
COPY . /var/www/html/

# ВАЖНО: Меняем корневую директорию Apache на папку public
# И разрешаем использование .htaccess (AllowOverride All)
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Устанавливаем права для веб-сервера
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
