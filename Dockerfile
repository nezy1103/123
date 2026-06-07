FROM php:8.2-apache

# Копируем весь проект внутрь контейнера
COPY . /var/www/html

# Копируем ТВОЙ конфиг apache поверх стандартного
# Путь apache/000-default.conf берется из структуры твоего репозитория
COPY apache/000-default.conf /etc/apache2/sites-enabled/000-default.conf

# Включаем модуль rewrite (критично для .htaccess и Front Controller)
RUN a2enmod rewrite

# Перезапускаем apache внутри контейнера (на случай, если модуль не подхватится сам)
RUN service apache2 restart
