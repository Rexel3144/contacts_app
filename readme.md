#Contacts


##App basic on the Laravel Framework v5.4.19.
##Using PHP 7.0.15(dont tested on another versions).

###For getting started, you need to install:
1) lamp/wamp(basic on your OS)
2) composer
3) git


###Environment:
1) LAMP you can install by following the instruction on <a href="https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04">DigitalOcean</a>.
2) WAMP you can downaload from <a href="http://www.wampserver.com/">Official site</a>.


###Copmposer:
Download composer from  <a href="https://getcomposer.org/">getcomposer.org</a> and follow installation instructions for global install.
    

###Git:
Download git from <a href="https://git-scm.com/downloads">official site</a>.

##Now when you are ready to work follow please next instructions:

1) <b>Clone the project via command in terminal</b>
git clone https://github.com/valerahorsharik/Contacts.git
2) <b>Enter in the project directory</b>
3) <b>Install composer dependencies via command in terminal</b>
composer install
4) <b>Create an own database</b>
5) <b>Set you database name/user/password in the .env file</b>
6) <b>Create a db structure by using migrates via command in terminal</b>
php artisan migrate
7) <b>Start a server via command in terminal</b>
php artisan serve
##And thats all, you can work with Contacts app.
8)<b>But if you wanna put some dummy data in the DB use follow command</b>
php artisan db:seed

