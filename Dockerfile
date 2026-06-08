FROM php:8.2-apache

# 1. Включаем модуль mod_rewrite (нужен для работы роутинга и .htaccess)
RUN a2enmod rewrite

# 2. Копируем все файлы проекта внутрь контейнера
COPY . /var/www/html/

# 3. Настраиваем Apache:
#    - Делаем папку 'public' корневой директорией сайта (DocumentRoot)
#    - Разрешаем использование .htaccess (AllowOverride All)
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# 4. Устанавливаем владельца файлов (чтобы Apache мог их читать)
RUN chown -R www-data:www-data /var/www/html

# 5. Устанавливаем права доступа (755 - чтение и выполнение для всех, запись для владельца)
#    Это решает проблему 403 Forbidden, если предыдущие шаги не помогли
RUN chmod -R 755 /var/www/html

# 6. Открываем порт 80
EXPOSE 80
