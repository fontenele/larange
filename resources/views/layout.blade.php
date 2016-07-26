<!doctype html>
<html lang="en">
    <head>
        <title>larAnge</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="larAnge - PHP5 Framework PHP+JS (laravel, requirejs, angular, bootstrap)">
        <meta name="author" content="Guilherme Fontenele <http://github.com/fontenele>">
        <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
        <link rel="stylesheet" href="css/plugins/loading.css" />
        <link rel="stylesheet" href="css/app.css" />
        <script type="text/javascript" src="vendor/requirejs/require.js" data-main="js/main.js"></script>
    </head>
    <body data-ng-controller="PrincipalController" ng-cloak class="ng-cloak" layout="column">

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="javascript:void(0)" ng-click="menuItem('home')">Larange</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <menu items="menu" location=''></menu>
                    <p class="navbar-text navbar-right">
                        <a ng-show="authenticated" ng-click="menuItem('auth|login', true)" href="javascript:void(0)" class="navbar-link">Sair</a>
                    </p>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar" ng-show="authenticated">
                    <menu items="menu" location='nav-pills nav-stacked"'></menu>
                </div>
                <div ng-class="container_class">
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
            <div class="container">
                <p class="text-muted"><a href="https://github.com/fontenele/larange" target="_blank">Larange Github project</a></p>
            </div>
        </div>


    </body>
</html>
