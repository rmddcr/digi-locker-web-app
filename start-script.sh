#!/bin/bash
chmod 777 /var/www/html
service mysql start
a2enmod rewrite
service apache2 start
systemctl restart apache2
