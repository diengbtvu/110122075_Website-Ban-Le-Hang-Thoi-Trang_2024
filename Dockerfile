# Use the official PHP image as a base image
FROM php:7.4-apache

# Copy the website files to the container
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html/

# Install PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

# Set the correct permissions for the web directory
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Update Apache configuration to allow access
RUN echo "<Directory /var/www/html/> \n\
    Options Indexes FollowSymLinks \n\
    AllowOverride All \n\
    Require all granted \n\
</Directory>" > /etc/apache2/conf-available/custom-access.conf \
    && a2enconf custom-access

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
