
# Ubuntu LAMP stack with Apache, MariaDB, PHP

FROM ubuntu:16.04

MAINTAINER Damitha v1.1

RUN apt-get update
RUN apt-get upgrade -y

# apachi server
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y apache2
COPY apache2.conf /etc/apache2/apache2.conf
COPY application/ /var/www/html/
RUN chmod 777 /var/www/html

# mysql install
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y mysql-server 

# php
RUN  DEBIAN_FRONTEND=noninteractive apt-get install -y \
    php \
    libapache2-mod-php \
    php-mcrypt \
    php-mysql 
  
# script file running
COPY start-script.sh /root/
RUN chmod +x /root/start-script.sh 
CMD /root/start-script.sh