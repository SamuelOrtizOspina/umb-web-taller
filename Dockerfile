# Imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instalar mysqli
RUN docker-php-ext-install mysqli

# Copiar los archivos de la API al servidor web
COPY api/ /var/www/html/

# Habilitar mod_rewrite
RUN a2enmod rewrite
