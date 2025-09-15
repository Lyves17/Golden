# Utiliser une image PHP avec Apache
FROM php:8.1-apache

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libicu-dev \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip

# Activer les modules Apache nécessaires
RUN a2enmod rewrite headers

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers de l'application
COPY . /var/www/html/

# Définir les permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Installer les dépendances PHP
RUN if [ -f "composer.json" ]; then \
    composer install --no-interaction --optimize-autoloader --no-dev; \
    fi

# Configurer les fichiers de configuration
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/custom.ini

# Exposer le port 80
EXPOSE 80

# Démarrer Apache en premier plan
CMD ["apache2-foreground"]
