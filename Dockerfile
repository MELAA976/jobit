# Image de départ 
FROM php:8.1-apache

# Installer l'extension PDO MYSQL
RUN docker-php-ext-install pdo pdo_mysql


#copie le contenue du dossier courant dans le dossier web du server nginx
COPY . /var/www/html

# On precise que l'on souhaite exposer notre port 80
EXPOSE 80
