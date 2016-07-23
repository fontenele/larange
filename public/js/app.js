define([
    'angular',
    'route-config',
    'ngAria',
    // 'ngAnimate',
    'ngMessages'
    // 'ngMaterial'
], function(angular, routeConfig) {

    var app = angular.module('larange', [], function($provide, $compileProvider, $controllerProvider, $filterProvider, $interpolateProvider) {
        // angular.$$minErr = function () {
        // };
        var a = angular.module('material.components.fabSpeedDial', []).directive().animation = function () {
            
        };
        console.log(55,angular.module('material.components.fabSpeedDial', []).directive().animation);

        require(['ngMaterial'], function (ngMaterial) {
            console.log("foi!!!123? >>>> ", ngMaterial);
        });

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