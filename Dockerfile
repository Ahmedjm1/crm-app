FROM php:8.4-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    zip \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project
COPY . .

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# Install Node 20 (IMPORTANT FIX)
RUN npm install -g n
RUN n 20

# Install frontend deps
RUN npm install

# Build assets (THIS FIXES YOUR ERROR)
RUN npm run build

# Laravel optimizations
RUN php artisan config:clear
RUN php artisan cache:clear

# Start app
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT