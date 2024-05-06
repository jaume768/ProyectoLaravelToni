# Usar la imagen oficial de PHP con Apache
FROM php:8.1-apache

# Instalar extensiones necesarias de PHP
RUN docker-php-ext-install pdo pdo_mysql

# Habilitar el módulo de Apache rewrite
RUN a2enmod rewrite

# Copiar los archivos de la aplicación al contenedor
COPY . /var/www/html

# Asignar permisos adecuados a los directorios de Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto 80 para acceder a Apache
EXPOSE 80
