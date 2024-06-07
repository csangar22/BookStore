# Usa una imagen base oficial de PHP con Apache
FROM php:7.4-apache

# Copia los archivos del front-end al directorio donde Apache sirve los archivos (document root)
COPY frontend/ /var/www/html/

# Copia los archivos del back-end al directorio donde Apache sirve los archivos
COPY backend/ /var/www/html/

# Configura el Apache para servir tu aplicación
COPY backend/apache-config.conf /etc/apache2/sites-available/000-default.conf

# Habilita mod_rewrite para Apache (necesario si usas URL amigables)
RUN a2enmod rewrite

# Expone el puerto 80 para el servidor web
EXPOSE 80

# Inicia el servidor Apache en primer plano
CMD ["apache2-foreground"]
