Happy Sens
==========

Project Wild Code School for Happy Sens

Technologies used :

    Css3, html5
    Scss / Sass
    Materialize 0.1 
    Javascript / jQuery
    Symfony 3.3
    PHP 7.1 


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




A Symfony project created on October 17, 2017, 10:17 am.