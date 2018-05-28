# FROM php:7.2.6-apache
# COPY src/ /var/www/html
# EXPOSE 80 

# Ubuntu LAMP stack with Apache, MariaDB, PHP, and SSL

FROM ubuntu:16.04

MAINTAINER Damitha version 1.0

ENV DEBIAN_FRONTEND noninteractive

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

# Install Apache, SSL, PHP, and some PHP modules
RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install -y \
	php7.0 \
	php7.0-bz2 \
	php7.0-cgi \
	php7.0-cli \
	php7.0-common \
	php7.0-curl \
	php7.0-dev \
	php7.0-enchant \
	php7.0-fpm \
	php7.0-gd \
	php7.0-gmp \
	php7.0-imap \
	php7.0-interbase \
	php7.0-intl \
	php7.0-json \
	php7.0-ldap \
	php7.0-mbstring \
	php7.0-mcrypt \
	php7.0-mysql \
	php7.0-odbc \
	php7.0-opcache \
	php7.0-pgsql \
	php7.0-phpdbg \
	php7.0-pspell \
	php7.0-readline \
	php7.0-recode \
	php7.0-snmp \
	php7.0-sqlite3 \
	php7.0-sybase \
	php7.0-tidy \
	php7.0-xmlrpc \
	php7.0-xsl \
	php7.0-zip


#comment out unnessory parts
RUN apt-get install apache2 libapache2-mod-php7.0 -y
#RUN apt-get install mariadb-common mariadb-server mariadb-client -y
RUN apt-get install postfix -y
RUN apt-get install git nodejs npm composer nano tree vim curl ftp -y
RUN npm install -g bower grunt-cli gulp

# Install MariaDB and set default root password

RUN echo 'mariadb-server mariadb-server/root_password  password mypassword' | debconf-set-selections
RUN echo 'mariadb-server mariadb-server/root_password_again password mypassword' | debconf-set-selections
RUN apt-get install mariadb-server -y

# Disable the default Apache site config
COPY src/ /var/www/html
# Install your site's Apache configuration and activate SSL

ADD my_apache.conf /etc/apache2/sites-available/
RUN a2dissite 000-default
RUN a2ensite my_apache
RUN a2enmod ssl

# Remove APT files
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

EXPOSE 443 8080

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]