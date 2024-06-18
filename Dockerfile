# Dockerfile
FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev \
    libpq-dev \
    nodejs \
    npm 

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg 
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip

# Set working directory
WORKDIR /var/www/html

# Copiar arquivos do projeto
COPY /src /var/www/html/

# Copiar o arquivo composer.json e instalar dependências do PHP
#COPY src/composer.json src/composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Instalar dependências do Node.js e compilar assets
#COPY src/package.json src/package-lock.json ./
RUN npm install

# Ajustar permissões do diretório public
RUN chown -R www-data:www-data /var/www/html/public
RUN chmod -R 775 /var/www/html/public

#COPY src/webpack.mix.cjs ./
RUN npm run dev

# Ajustar permissões
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expor a porta 9000 e iniciar o php-fpm
EXPOSE 9000
CMD ["php-fpm"]
