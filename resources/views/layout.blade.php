<!doctype html>
<html lang="en">
    <head>
        <title>larAnge</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="larAnge - PHP5 Framework PHP+JS (laravel, requirejs, angular, bootstrap)">
        <meta name="author" content="Guilherme Fontenele <http://github.com/fontenele>">
        <link rel="stylesheet" href="css/plugins/loading.css" />
        <link rel="stylesheet" href="css/themes/bootstrap-theme-united.css" />
        <link rel="stylesheet" href="vendor/animate.css/animate.css" />
        <link rel="stylesheet" href="css/app.css" />
        <script type="text/javascript" src="vendor/requirejs/require.js" data-main="js/main"></script>
    </head>
    <body data-ng-controller="PrincipalController" ng-cloak class="ng-cloak" layout="column">

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-top" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="javascript:void(0)" ng-click="menuItem('home')"><img src="{{ asset('images/larange.png') }}" /></a>
                </div>
                
                <div id="navbar-top" class="collapse navbar-collapse">
                    <menu ng-show="authenticated" items="menu" location=''></menu>
                    <ul class="nav navbar-nav navbar-right">
                        <li ng-hide="authenticated" ng-click="menuItem('login')"><a href="javascript:void(0)">Entrar</a></li>
                        <li ng-show="authenticated" class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><% currentUser.name %> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li ng-click="menuItem('admin')"><a href="javascript:void(0)">Admin Panel</a></li>
                                <li role="separator" class="divider"></li>
                                <li ng-click="menuItem('login', true)"><a href="javascript:void(0)">Sair</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                
            </div>
        </nav>

        <div class="container-fluid" style="padding-bottom: 20px;">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar" ng-show="authenticated">
                    <menu items="menu" location='nav-pills nav-stacked"'></menu>
                </div>
                <div ng-class="container_class">
                    <!-- @TODO FAZER DIRECTIVE breadcrumb -->
                    <ol class="breadcrumb" ng-show="authenticated">
                        <li><a ng-click="menuItem('home')" href="javascript:void(0)">Home</a></li>
                        <li><a ng-click="menuItem('view1')" href="javascript:void(0)">View1</a></li>
                        <li class="active">Data</li>
                    </ol>
                    <ng-view id="ng-view" ng-cloak class="ng-cloak"></ng-view>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="container-fluid">
                <div class="col-sm-4">
                    <p><a href="https://github.com/fontenele/larange" target="_blank">Larange Github project</a></p>
                    <p><a href="https://github.com/fontenele" target="_blank">@fontenele</a></p>
                </div>
                <div class="col-sm-4">
                    
                </div>
                <div class="col-sm-4">
                    <p><a href="https://github.com/laravel/laravel" target="_blank">Laravel</a></p>
                    <p><a href="https://github.com/angular/angular" target="_blank">AngularJS</a></p>
                    <p><a href="https://github.com/requirejs/requirejs" target="_blank">RequireJS</a></p>
                    <p><a href="https://github.com/twbs/bootstrap" target="_blank">Twitter Bootstrap</a></p>
                </div>
            </div>
        </div>


    </body>
</html>
