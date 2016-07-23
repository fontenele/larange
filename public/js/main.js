String.prototype.capitalizeFirstLetter = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
};

require.config({
    baseUrl: 'js',
    urlArgs: "_t=" + (new Date()).getTime(),
    paths: {
        'jquery': '../vendor/jquery/dist/jquery.min',
        'angular': '../vendor/angular/angular.min',
        'ocLazyLoad': '../vendor/ocLazyLoad/dist/ocLazyLoad.require',
        'ngComponentRouter': '../vendor/angular-route/angular-route.min'
    },
    shim: {
        'angular': ['jquery'],
        'ngComponentRouter': ['angular'],
        'ocLazyLoad': ['angular']
        // 'app': {
        //     "deps": ['angular']
        // },
        // 'routes': {
        //     "deps": ['angular']
        // },
        // 'ngAnimate': {
        //     "deps": ['ngMaterial']
        // },
        // 'ngAria': {
        //     "deps": ['angular']
        // },
        // 'ngMaterial': {
        //     "deps": ['ngAria', 'ngAnimate']
        // },
        // 'ngMessages': {
        //     "deps": ['angular']
        // }
    }
});

require([
    'ocLazyLoad',
    'ngComponentRouter'
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
                        var template = 'view/' + $routeParams.action + "?_t=" + (new Date()).getTime();
                        var js = 'js/controllers/' + $routeParams.action + '.js' + "?_t=" + (new Date()).getTime();

                        $ocLazyLoad.load(js).then(function (a) {
                            $templateRequest(template).then(function (html) {
                                var tpl = angular.element(html);
                                $('#ng-view').html(tpl);
                                $compile(tpl)($scope);
                            });
                        });

                        return lazyDeferred.promise;
                    }
                });
            // .otherwise({
            //     redirectTo: '/home'
            // });
        });

        mainApp.controller('PrincipalController', function($scope, $ocLazyLoad, $routeParams) {
            $scope.greetMe = 'Olá!!!!';
            setTimeout(function() {
                if($routeParams.action === undefined) {
                    $('#pagina-principal').click();
                }
            }, 0);
        });

        angular.bootstrap(document.body, ['mainApp']);
    });
});
