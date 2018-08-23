# Digi Locker Web Application Maintainers guide


This documentation documents how to deploy Digi Locker system in your linux local environment. Instructions are give for Ubuntu server 16.04.4 LTS
reference : [Setting up LAMP stack](https://www.linuxbabe.com/linux-server/install-apache-mariadb-and-php7-lamp-stack-on-ubuntu-16-04-lts)

## Setting up database
Install MariaDB latest version (10.0.34-MariaDB-0ubuntu0.16.04.1)
```
sudo apt-get update 

sudo apt-get install mariadb-server mariadb-client
```

check the status of MariaDB
```
systemctl status mysql
```

output should be
```
mysql.service - LSB: Start and stop the mysql database server daemon
 Loaded: loaded (/etc/init.d/mysql; bad; vendor preset: enabled)
 Active: active (running) since Wed 2016-04-20 18:52:01 EDT; 1min 30s ago
 Docs: man:systemd-sysv-generator(8)
```

if its not run
```
sudo systemctl start mysql
```

to start MariaDB at boot run
```
sudo systemctl enable mysql
```

to setup the MySQL run
```
sudo mysql_secure_installation
```

setup root users password and other options


## Setting up web server
Install web server Apache latest version (2.4.18 [Ubuntu])
```
sudo apt-get update 

sudo apt-get install mariadb-server mariadb-client
```



```
Give examples
```




## Authors

* **Billie Thompson** - *Initial work* - [PurpleBooth](https://github.com/PurpleBooth)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

