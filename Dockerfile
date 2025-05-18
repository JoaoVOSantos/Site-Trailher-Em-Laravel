FROM php:8.2-fpm

# Instala pacotes do sistema e extensões do PHP
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cria diretório da aplicação
WORKDIR /var/www

# Copia o projeto para o container
COPY . .

# Instala as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Gera o cache do framework
RUN php artisan config:clear && php artisan route:clear && php artisan view:clear

# Permissões (opcional)
RUN chown -R www-data:www-data /var/www && chmod -R 775 storage bootstrap/cache

# Expõe a porta
EXPOSE 8000

# Comando para rodar o servidor Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
 