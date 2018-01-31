Happy Sens
==========

Project Wild Code School for Happy Sens

## 1) Technologies used :

    Css3, html5
    Scss / Sass
    Materialize 0.1 
    Javascript / jQuery
    Symfony 3.3
    PHP 7.1 

## 2) Installation 


create your user (never use root)

    sudo adduser <userName>

add new user to sudo group

    sudo adduser <userName> sudo

install git, php7.1, php-mbstring, php-cli, php-xml, apache2, mysql, curl, unzip from distribution

install GD library

    sudo apt-get install php-gd 

install composer :

    cd~ 
    curl -sS https://getcomposer.org/installer -o composer-setup.php
    sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer

create directories

    /data/www, /data/log/apache2, /data/log/mysql

change permissions for apache2 and mysql directories

change target file for mysql error log :

    edit /etc/mysql/mysql.conf.d/mysqld.cnf

find an change line log_error

    log_error = /data/log/mysql/error.log

restart mysql server

create vhost for apache2 in /etc/apache2/site-availables : happysens.conf (http)

    <VirtualHost *:80>
    ServerName happysens.fr
    ServerAlias www.happysens.fr
    DocumentRoot /data/www//web
    <Directory /data/www/Lyon-0917-Happysens/web>
    Require all granted
    AllowOverride All
    <IfModule mod_rewrite.c>
    Options -MultiViews
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ app.php [QSA,L]
    </IfModule>
    </Directory>
    ErrorLog /data/log/apache2/happysens_error.log
    CustomLog /data/log/apache2/happysens_access.log combined
</VirtualHost>

Activate your vhost

    sudo a2ensite happySens.conf

add environment variable for symfony

    SYMFONY_ENV=prod (edit /etc/environment)

export environment variable :

    export SYMFONY_ENV=prod

go to /data/web clone the repository

    git clone https://github.com/WildCodeSchool/Lyon-0917-HappySens.git

set file permissions permanently

    sudo setfacl -dR -m u:www-data:rwX -m u:$(whoami):rwX var
    sudo setfacl -R -m u:www-data:rwX -m u:$(whoami):rwX var

Install vendor and configure parameters :

    composer install --no-dev --optimize-autoloader

Create your database :

    php bin/console doctrine:database:create
    php bin/console doctrine:shema:update --force
    
Load fixture :
     
    php bin/console doctrine:fixtures:load 

Install composer :

    cd~ 
    curl -sS https://getcomposer.org/installer -o composer-setup.php
    sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer

Install vendor and configure parameters

    composer install --no-dev --optimize-autoloader

Create or import your database

    php bin/console doctrine:database:create
    php bin/console doctrine:schema:update --force
    php bin/console doctrine:fixtures:load  

restart apache2 server

    sudo /etc/init.d/apache2 restart

documentation SSL 
documentation SSL pour le dommaine happysens.fr : https://facemweb.com/creation-site-internet/lets-encrypt-vps 

A Symfony project created on October 17, 2017, 10:17 am