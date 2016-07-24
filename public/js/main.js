String.prototype.capitalizeFirstLetter = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
};

require.config({
    baseUrl: 'js',
    urlArgs: "_t=" + (new Date()).getTime(),
    paths: {
        //jquery
        'jquery': '../vendor/jquery/dist/jquery.min',

        //jquery
        'bootstrap': '../vendor/bootstrap/dist/js/bootstrap.min',

        // angular
        'angular': '../vendor/angular/angular.min',
        'ocLazyLoad': '../vendor/ocLazyLoad/dist/ocLazyLoad.require',
        'ngComponentRouter': '../vendor/angular-route/angular-route.min',

        // require plugins
        'text': '../vendor/text/text',
        'json': '../vendor/requirejs-plugins/src/json',

        // defaults
        'lib': '../vendor',
        'data': '..'
    },
    shim: {
        'angular': ['jquery'],
        'ngComponentRouter': ['angular'],
        'ocLazyLoad': ['angular'],
        'bootstrap': ['angular']
    }
});

require([
    'ocLazyLoad',
    'ngComponentRouter',
    'bootstrap'
], function() {
    var mainApp = angular.module("mainApp", ['ngRoute', 'oc.lazyLoad']);

    angular.element(document).ready(function() {
        mainApp.config(function($routeProvider, $ocLazyLoadProvider, $interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');

            $ocLazyLoadProvider.config({
                jsLoader: requirejs,
                debug: true
            });

            $routeProvider
                .when('/:action', {
                    template: '',
                    controller: function($rootScope, $scope, $routeParams, $ocLazyLoad, $q, $http, $compile, $templateRequest) {
                        var lazyDeferred = $q.defer();

                        var controller = $routeParams.action.capitalizeFirstLetter() + 'Controller';
                        var template = 'view/' + $routeParams.action;// + "?_t=" + (new Date()).getTime();
                        var js = 'js/controllers/' + $routeParams.action + '.js';// + "?_t=" + (new Date()).getTime();

                        $ocLazyLoad.load(js).then(function (a) {
                            $templateRequest(template).then(function(html) {
                                var tpl = angular.element(html);
                                $('#ng-view').html(tpl);
                                $compile(tpl)($scope);
                            });
                        });

                        return lazyDeferred.promise;
                    }
                })
            .otherwise({
                redirectTo: '/home'
            });
        });

        mainApp.controller('PrincipalController', function($scope, $ocLazyLoad, $routeParams, $location) {
            $scope.menuItemAtual = $location.path().substring(1);

            $scope.menuItem = function(url) {
                $location.path(url);
                $scope.menuItemAtual = $location.path().substring(1);
            };

            $scope.menu = [
                {label: 'Home', url: 'home', selected: false},
                {label: 'View1', url: 'view1', selected: false}
            ];
        });

        angular.bootstrap(document.body, ['mainApp']);
    });
});
