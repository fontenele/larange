<!doctype html>
<html lang="en">
    <head>
        <title>larAnge</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="larAnge - PHP5 Framework PHP+JS (laravel, requirejs, angular, bootstrap)">
        <meta name="author" content="Guilherme Fontenele <http://github.com/fontenele>">
        <link rel="stylesheet" href="vendor/angular/angular-csp.css" />
        <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
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
                    <a class="navbar-brand" href="#/home">larAnge</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav" ng-repeat="item in menu">
                        <li ng-class="{'active':item.url == menuItemAtual}" ng-click="menuItem(item.url)"><a href="javascript:void(0)"><% item.label %></a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <ol class="breadcrumb">
                <li><a ng-click="menuItem('home')" href="javascript:void(0)">Home</a></li>
                <li><a ng-click="menuItem('view1')" href="javascript:void(0)">View1</a></li>
                <li class="active">Data</li>
            </ol>
            <ng-view id="ng-view"></ng-view>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="text-muted">Place sticky footer content here.</p>
            </div>
        </footer>

    </body>
</html>
