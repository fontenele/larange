/**
 * Capitalize First Letter (ohhh)
 * @returns {string}
 */
String.prototype.capitalizeFirstLetter = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
};

/**
 * Configure Lib paths
 */
require.config({
    baseUrl: 'js',
    urlArgs: "_t=" + (new Date()).getTime(),
    paths: {
        //jquery
        'jquery': '../vendor/jquery/dist/jquery.min',

        //plugins
        'loading': 'plugins/loading',

        //bootstrap
        'bootstrap': '../vendor/bootstrap/dist/js/bootstrap.min',

        // angular
        'angular': '../vendor/angular/angular.min',
        'ocLazyLoad': '../vendor/ocLazyLoad/dist/ocLazyLoad.require',
        'ngComponentRouter': '../vendor/angular-route/angular-route.min',

        // satellizer
        'satellizer': '../vendor/satellizer/dist/satellizer.min',

        // require plugins
        'text': '../vendor/text/text',
        'json': '../vendor/requirejs-plugins/src/json',

        // defaults
        'lib': '../vendor',
        'data': '..'
    },
    shim: {
        // Dependences
        'angular': ['jquery'],
        'loading': ['jquery'],
        'ngComponentRouter': ['angular'],
        'ocLazyLoad': ['angular'],
        'bootstrap': ['angular'],
        'satellizer': ['angular']
    }
});

// Init libs
require([
    'ocLazyLoad',
    'ngComponentRouter',
    'bootstrap',
    'satellizer',
    'loading'
], function() {
    var mainApp = angular.module("mainApp", ['ngRoute', 'oc.lazyLoad', 'satellizer']);

    angular.element(document).ready(function() {

        mainApp.config(function($routeProvider, $ocLazyLoadProvider, $interpolateProvider, $authProvider, $httpProvider, $provide) {

            /**
             *
             * @param $q
             * @param $injector
             * @param $location
             * @returns {{responseError: responseError}}
             */
            function redirectWhenLoggedOut($q, $injector, $location) {
                return {
                    request: function(config) {
                        loading.show();
                        return config;
                    },
                    response: function(response) {
                        loading.hide();
                        return response;
                    },
                    requestError: function(rejection) {
                        console.log("request error:", rejection);
                        return $q.reject(rejection);
                    },
                    responseError: function(rejection) {
                        switch(rejection.data.error) {
                            case "token_not_provided":
                            case "token_expired":
                            case "token_absent":
                            case "token_invalid":
                                localStorage.removeItem('user');
                                $location.path('auth|login');
                                break;
                            case "invalid_credentials":
                                alert("usuário/senha inválidos");
                                localStorage.removeItem('user');
                                $location.path('auth|login');
                                break;

                        }

                        return $q.reject(rejection);
                    }
                }
            }

            $provide.factory('redirectWhenLoggedOut', redirectWhenLoggedOut);
            $httpProvider.interceptors.push('redirectWhenLoggedOut');

            var routesWithoutJs = [];
            routesWithoutJs.push('auth|login');

            var aclFree = [];
            aclFree.push('auth|login');

            $authProvider.loginUrl = '/api/authenticate';

            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');

            $ocLazyLoadProvider.config({
                jsLoader: requirejs,
                debug: true
            });

            $routeProvider
                .when('/:action', {
                    template: '',
                    controller: function($rootScope, $scope, $routeParams, $ocLazyLoad, $q, $http, $compile, $templateRequest, $location) {
                        var lazyDeferred = $q.defer();

                        if(aclFree.indexOf($routeParams.action) < 0 && !$rootScope.authenticated) {
                            $location.path('auth|login');
                            $rootScope.menuItemAtual = $location.path().substring(1);
                            return lazyDeferred.promise;
                        }

                        var controller = $routeParams.action.capitalizeFirstLetter() + 'Controller';
                        var template = 'view/' + $routeParams.action;// + "?_t=" + (new Date()).getTime();
                        var js = 'js/controllers/' + $routeParams.action + '.js';// + "?_t=" + (new Date()).getTime();

                        // @TODO try eliminate this if else
                        if(routesWithoutJs.indexOf($routeParams.action) >= 0) {
                            js = $routeParams.action; // + '.js' + "?_t=" + (new Date()).getTime();
                            template = 'view/' + $routeParams.action;// + "?_t=" + (new Date()).getTime();
                            $ocLazyLoad.load(js).then(function (a) {
                                $templateRequest(template).then(function(html) {
                                    var tpl = angular.element(html);
                                    $('#ng-view').html(tpl);
                                    $compile(tpl)($scope);
                                });
                            });
                        } else {
                            $ocLazyLoad.load(js).then(function (a) {
                                $templateRequest(template).then(function(html) {
                                    var tpl = angular.element(html);
                                    $('#ng-view').html(tpl);
                                    $compile(tpl)($scope);
                                });
                            });

                        }

                        return lazyDeferred.promise;
                    }
                })
            .otherwise({
                redirectTo: 'auth|login'
            });
        })
            .run(function($rootScope, $location) {
                $rootScope.$on('$routeChangeStart', function(event, toState) {
                    loading.show();
                    var url = $location.path().substring(1);
                    var user = JSON.parse(localStorage.getItem('user'));

                    // Load menu dynamic, use $http ou $.get
                    $rootScope.menu = [
                        {label: 'Home', url: 'home', selected: false},
                        {label: 'View1', url: 'view1', selected: false}
                    ];

                    if(user) {
                        $rootScope.authenticated = true;
                        $rootScope.currentUser = user;
                    }

                    for(i in $rootScope.menu) {
                        $rootScope.menu[i].selected = false;
                        if($rootScope.menu[i].url == url) {
                            $rootScope.menu[i].selected = true;
                        }
                    }
                });
                $rootScope.$on('$routeChangeSuccess', function(event, toState) {
                    loading.hide();
                });
            });

        mainApp.directive("menu", function($location) {
            return {
                restrict: "E",
                replace: true,
                scope: {
                    loc: '@location',
                    items: '='
                },
                link: function($rootScope, $scope, $element) {
                    $rootScope.menuLink = function() {
                        $location.path(this.item.url);
                    };
                },
                template:   '<ul class="nav navbar-nav <% loc %>">' +
                                '<li ng-repeat="item in items" ng-class="{\'active\': item.selected}" >' +
                                    '<a href="javascript:void(0)" ng-click="menuLink(item.url)"><% item.label %></a>' +
                                '</li>' +
                            '</ul>'

            }
        });

        mainApp.controller('PrincipalController', function($scope, $ocLazyLoad, $routeParams, $location) {
            $scope.menuItemAtual = $location.path().substring(1);

            $scope.menuItem = function(url) {
                $location.path(url);
                $scope.menuItemAtual = $location.path().substring(1);
            };
        });

        angular.bootstrap(document.body, ['mainApp']);
    });
});
