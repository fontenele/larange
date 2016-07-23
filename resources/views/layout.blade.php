<!doctype html>
<html lang="en">
    <head>
        <title>larAnge</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="vendor/angular/angular-csp.css" />
        <script type="text/javascript" src="vendor/requirejs/require.js" data-main="js/main.js"></script>
    </head>
    <body data-ng-controller="PrincipalController" ng-cloak class="ng-cloak">
        <a id="pagina-principal" title="Ir para a página principal" href="#/home" style="display: none;">Home</a>

        <h1>Hello <% greetMe %>!. Layout principal! </h1>

        <ng-view id="ng-view"></ng-view>
    </body>
</html>
