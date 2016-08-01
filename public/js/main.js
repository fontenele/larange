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
    var loginRoute = 'auth|login';
    var authRoute = '/api/authenticate';
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
                    response: function(response, $auth) {
                        loading.hide();
                        // $auth.setToken()
                        if(response.headers('authorization')) {
                            console.log("response ok", response.headers('authorization'), $auth);
                        }
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
                                $location.path(loginRoute);
                                break;
                            case "invalid_credentials":
                                alert("usuário/senha inválidos");
                                localStorage.removeItem('user');
                                $location.path(loginRoute);
                                break;

                        }

                        return $q.reject(rejection);
                    }
                }
            }

            $provide.factory('redirectWhenLoggedOut', redirectWhenLoggedOut);
            $httpProvider.interceptors.push('redirectWhenLoggedOut');

            var routesWithoutJs = [];
            routesWithoutJs.push(loginRoute);

            var aclFree = [];
            aclFree.push(loginRoute);

            $authProvider.loginUrl = authRoute;

            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');

            $ocLazyLoadProvider.config({
                jsLoader: requirejs,
                debug: false
            });

            $routeProvider
                .when('/:action', {
                    template: '',
                    controller: function($rootScope, $scope, $routeParams, $ocLazyLoad, $q, $http, $compile, $templateRequest, $location) {
                        var lazyDeferred = $q.defer();

                        // Get User from storage
                        var user = JSON.parse(localStorage.getItem('user'));

                        if(!user && $routeParams.action === loginRoute) {
                            
                        }

                        if(aclFree.indexOf($routeParams.action) < 0 && !$rootScope.authenticated && !user) {
                            $location.path(loginRoute);
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
                redirectTo: 'home'
            });
        })
            .run(function($rootScope, $location, $auth) {

                $rootScope.$on('$routeChangeSuccess', function(event, toState, response) {

                    if(toState.params.action == loginRoute) {
                        $auth.logout();
                        $rootScope.authenticated = false;
                        $rootScope.currentUser = null;
                        // Remove User from storage
                        localStorage.removeItem('user');
                        // Container class without sidebar
                        $rootScope.container_class = 'col-sm-12 col-md-12 main';
                    } else {
                        // Container class with sidebar
                        $rootScope.container_class = 'col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main';
                    }

                    // Get URL
                    var url = $location.path().substring(1);
                    // Get User from storage
                    var user = JSON.parse(localStorage.getItem('user'));

                    // Load menu dynamic, use $http ou $.get
                    $rootScope.menu = [
                        {label: 'Home', url: 'home', selected: false},
                        {label: 'View1', url: 'view1', selected: false},
                        {label: 'Panel', url: 'panel', selected: false},
                    ];

                    if(user) {
                        $rootScope.authenticated = true;
                        $rootScope.currentUser = user;
                    }

                    // Define active menu
                    for(i in $rootScope.menu) {
                        // Remove all selected
                        $rootScope.menu[i].selected = false;
                        // Add active to selected item
                        if($rootScope.menu[i].url == url) {
                            $rootScope.menu[i].selected = true;
                        }
                    }
                });
            });

        // @TODO move this to directive.js
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



        /**
         * App Main Controller
         */
        mainApp.controller('PrincipalController', function($scope, $ocLazyLoad, $routeParams, $location, $auth) {
            $scope.menuItemAtual = $location.path().substring(1);

            $scope.menuItem = function(url, logout) {
                if(logout) {
                    // Logout in satellizer
                    $auth.logout();
                    // Remove User from storage
                    localStorage.removeItem('user');
                }
                $location.path(url);
            };
        });

        /**
         * Bootstrap angular
         */
        angular.bootstrap(document.body, ['mainApp']);
    });
});
