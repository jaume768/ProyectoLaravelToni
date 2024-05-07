# Usar la imagen oficial de PHP con Apache
FROM php:8.2.18-apache

# Instalar extensiones necesarias de PHP
RUN docker-php-ext-install pdo pdo_mysql

# Habilitar el módulo de Apache rewrite (para rutas limpias de Laravel)
RUN a2enmod rewrite

# Instalar Git, zip y unzip
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar los archivos de la aplicación al contenedor
COPY . /var/www/html

# Asignar permisos adecuados a los directorios de Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Exponer el puerto 80 para acceder a Apache (puede no ser necesario si se usa `docker-compose` y se define en el archivo `docker-compose.yml`)
EXPOSE 80

# Comando predeterminado para iniciar Apache en primer plano
CMD ["apache2-foreground"]
