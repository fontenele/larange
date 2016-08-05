### PHP/JS Framework

- [Laravel 5] (https://github.com/laravel/laravel)
- [AngularJS] (https://github.com/angular/angular)
- [RequireJS] (https://github.com/requirejs/requirejs)
- [Twitter Bootstrap] (https://github.com/twbs/bootstrap)
- Auth using OAuth2 - JSON Web Token with [Sattelizer (Token-based AngularJS Authentication)] (https://github.com/sahat/satellizer) e [oauth2-server-laravel (OAuth2 Server for Laravel)] (https://github.com/lucadegasperi/oauth2-server-laravel) plugins
- Load dynamic views, js and json per route
- Monthly maintenance
- Simple code

### Install

* Clone repository `$ git clone https://github.com/fontenele/larange.git && cd larange`
* Set write permission in storage dir `$ chmod -Rf 777 storage`
* Install PHP libs `$ composer install`
* Install JS libs `$ bower install` (If you are using Docker or something like and you are root, use `$ bower install --allow-root`)
* Configure DB in *.local.env* file
* If you dont use PostgreSQL, edit *config/database.php* file and change DB driver 
* Create user table `$ php artisan migrate`
* Seed users `$ php artisan db:seed`
* Publish vendor `$ php artisan vendor:publish`
* Insert an OAuth2 client: table oauth_clients: {id: 'GXvOWazQ3lA6YSaFji', secret: 'abcd', name: 'Client1'}
* Test app `$ php artisan serve`

### Test app
* login: guilherme@fontenele.net
* password: secret

### Thanks
- [@chenkie] (https://github.com/chenkie) with [jot-bot] (https://github.com/chenkie/jot-bot) project, show me how to use JWT in laravel and angular
- [@eu81273] (https://github.com/eu81273) with [AngularJS-RequireJS-Sample-Project] (https://github.com/eu81273/AngularJS-RequireJS-Sample-Project) project, he integrated RequireJS and AngularJS in older versions, but was the base to understand how they work together, and to make they works in newest versions
- [@andreymor] (https://github.com/andreymor) helpe me with AngularJS architecture and OAuth2 flows
