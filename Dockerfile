FROM php:8.2-apache

# Copiar la API al servidor Apache
COPY api/ /var/www/html/

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Exponer el puerto
EXPOSE 80

