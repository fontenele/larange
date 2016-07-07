<!doctype html>
<html lang="en" ng-controller="CommonController">
    <head>
        <title>larAnge</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="vendor/angular-material/angular-material.css" />
    </head>
    <body>
        <div>
            <a href="#/home">Home</a>
            <a href="#/view1">View1</a>
            <a href="#/admin" ng-show="isAdmin">admin</a>
        </div>
        <div ng-view></div>

        <!--script src="vendor/angular/angular.min.js"></script>
        <script src="vendor/angular-route/angular-route.js"></script>
        <script src="vendor/requirejs/require.js"></script>
        <script src="js/main.js"></script-->
        <script src="vendor/requirejs/require.js" data-main="js/main"></script>
        <!--script src="vendor/requirejs/require.js" data-main="js/main"></script-->
    </body>
</html>
