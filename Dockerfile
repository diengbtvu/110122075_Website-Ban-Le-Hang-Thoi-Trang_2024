# Use the official PHP image as a base image
FROM php:7.4-apache

# Copy the website files to the container
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html/

# Install PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
