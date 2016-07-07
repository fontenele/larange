define([
    'angular',
    'route-config'
], function(angular, routeConfig) {
    var app = angular.module('larange', [], function($provide, $compileProvider, $controllerProvider, $filterProvider, $interpolateProvider) {
        console.log("aqui");
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');

        routeConfig.setProvide($provide);
        routeConfig.setCompileProvider($compileProvider);
        routeConfig.setControllerProvider($controllerProvider);
        routeConfig.setFilterProvider($filterProvider);
    });

    app.controller('LarangeController', function($scope) {
        // $scope.on('updateCSS', function() {
        //     $scope.stylesheets = args;
        // });
    });

    return app;
});