#!/bin/bash

# Update system packages
apt-get update

# Install LAMP stack
apt-get install -y apache2 mariadb-server php libapache2-mod-php php-mysql php-gd php-xml php-curl php-mbstring

# Secure MariaDB installation
mysql_secure_installation

# Create database and user for Joomla
mysql -u root -p << EOF
CREATE DATABASE joomla;
CREATE USER 'joomla'@'localhost' IDENTIFIED BY 'joomla_password';
GRANT ALL PRIVILEGES ON joomla.* TO 'joomla'@'localhost';
FLUSH PRIVILEGES;
EOF

# Download and extract Joomla package
wget https://downloads.joomla.org/cms/joomla3/3-10-6/Joomla_3-10-6-Stable-Full_Package.zip
unzip Joomla_3-10-6-Stable-Full_Package.zip -d /var/www/html/

# Set ownership and permissions for Joomla files
chown -R www-data:www-data /var/www/html/
chmod -R 755 /var/www/html/

# Configure Apache virtual host for Joomla
cat <<EOF > /etc/apache2/sites-available/joomla.conf
<VirtualHost *:80>
   ServerAdmin webmaster@localhost
   DocumentRoot /var/www/html/
   ServerName example.com
   ServerAlias www.example.com

   <Directory /var/www/html/>
        Options FollowSymLinks
        AllowOverride All
        Order allow,deny
        allow from all
   </Directory>

   ErrorLog ${APACHE_LOG_DIR}/error.log
   CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

# Enable the virtual host and restart Apache
a2ensite joomla.conf
systemctl restart apache2
