### PHP/JS Framework

- Laravel 5
- AngularJS
- RequireJS
- Twitter Bootstrap
- Auth using JWT - JSON Web Token with Sattelizer e jwt-auth plugins
- Load dynamic views, js and json per route
- Monthly maintenance
- Simple code

### Install

* Clone repository `git clone https://github.com/fontenele/larange.git && cd larange`
* Set write permission in storage dir `chmod -Rf 777 storage`
* Install PHP libs `composer install`
* Install JS libs `bower install`
* Configure DB in *.local.env* file
* If you dont use PostgreSQL, edit *config/database.php* file and change DB driver 
* Create user table `php artisan migrate`
* Seed users `php artisan db:seed`
* Test app `php artisan serve`

### Test app
* login: guilherme@fontenele.net
* password: secret

### Thanks
- [@chenkie] (https://github.com/chenkie) with [jot-bot] (https://github.com/chenkie/jot-bot) project, show me how to use JWT in laravel and angular
