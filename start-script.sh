#!/bin/bash
service mysql start
a2enmod rewrite
service apache2 start