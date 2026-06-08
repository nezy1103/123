FROM php:8.2-apache

# Включаем mod_rewrite для работы роутинга
RUN a2enmod rewrite

# Копируем файлы проекта
COPY . /var/www/html/

# Настраиваем Apache:
# 1. Делаем public корневой папкой сайта
# 2. Разрешаем переопределение настроек через .htaccess (AllowOverride All)
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Устанавливаем правильные права доступа
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
