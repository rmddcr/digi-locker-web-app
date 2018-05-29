
# Ubuntu LAMP stack with Apache, MariaDB, PHP

FROM ubuntu:16.04

MAINTAINER Damitha v1.1


RUN apt-get update && apt-get install -y --no-install-recommends apt-utils

# apachi server
# RUN DEBIAN_FRONTEND=noninteractive apt install -y utill
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y apache2
COPY apache2.conf /etc/apache2/apache2.conf


# mysql install
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y mysql-server 

# php
RUN  DEBIAN_FRONTEND=noninteractive apt-get install -y \
    php \
    libapache2-mod-php \
    php-mcrypt \
    php-mysql 

# php myadmin
RUN DEBIAN_FRONTEND=noninteractive apt-get -y install phpmyadmin

#file copy
COPY app/ /var/www/html
RUN chmod 777 /var/www/html

# script file running
COPY start-script.sh /root/
RUN chmod +x /root/start-script.sh 
CMD /root/start-script.sh