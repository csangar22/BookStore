# Usa una imagen base oficial de PHP con Apache
FROM php:7.4-apache

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia el contenido del proyecto en el directorio de trabajo
COPY . /var/www/html

# Habilita el módulo de reescritura de Apache
RUN a2enmod rewrite

# Instala las extensiones de PHP necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql

# Copia la configuración personalizada de Apache
# Este Copy es para el flujo de control de versiones.
# COPY bookHub/apache-config.conf /etc/apache2/sites-available/000-default.conf

# Este COPY debe deascomentarse cuando se ejecute el contenedor de docker, por posibles problemas es mejor antes de ejecutar estar en la carpeta de bookHub.
COPY ./apache-config.conf /etc/apache2/sites-available/000-default.conf

# Expone el puerto 80
EXPOSE 80

# Inicia Apache
CMD ["apache2-foreground"]
