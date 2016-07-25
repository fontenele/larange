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
        'angular': ['jquery'],
        'ngComponentRouter': ['angular'],
        'ocLazyLoad': ['angular'],
        'bootstrap': ['angular'],
        'satellizer': ['angular']
    }
});

require([
    'ocLazyLoad',
    'ngComponentRouter',
    'bootstrap',
    'satellizer'
], function() {
    var mainApp = angular.module("mainApp", ['ngRoute', 'oc.lazyLoad', 'satellizer']);

    angular.element(document).ready(function() {
        mainApp.config(function($routeProvider, $ocLazyLoadProvider, $interpolateProvider, $authProvider, $httpProvider, $provide) {
            function redirectWhenLoggedOut($q, $injector, $location) {
                return {
                    responseError: function(rejection) {

                        // Need to use $injector.get to bring in $state or else we get
                        // a circular dependency error
                        // var $state = $injector.get('$state');

                        // Instead of checking for a status code of 400 which might be used
                        // for other reasons in Laravel, we check for the specific rejection
                        // reasons to tell us if we need to redirect to the login state
                        var rejectionReasons = ['token_not_provided', 'token_expired', 'token_absent', 'token_invalid'];

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

                        if(routesWithoutJs.indexOf($routeParams.action) >= 0) {
                            // console.log("ae");
                            js = $routeParams.action; // + '.js' + "?_t=" + (new Date()).getTime();
                            template = 'view/' + $routeParams.action;// + "?_t=" + (new Date()).getTime();
                            $ocLazyLoad.load(js).then(function (a) {
                                $templateRequest(template).then(function(html) {
                                    var tpl = angular.element(html);
                                    $('#ng-view').html(tpl);
                                    $compile(tpl)($scope);
                                });
                            });

                            // $templateRequest($routeParams.action).then(function(html) {
                            //
                            // });
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
                    var url = $location.path().substring(1);
                    var user = JSON.parse(localStorage.getItem('user'));

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

                    // console.log("mudou", user, $rootScope);
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
                    // $location.path(url);
                    // $scope.menuItemAtual = $location.path().substring(1);
                    //
                    $rootScope.menuLink = function() {
                        // for(i in this.items) {
                        //     this.items[i].selected = false;
                        // }
                        // this.item.selected = true;
                        $location.path(this.item.url);
                        // $rootScope.$parent.menuItemAtual = $location.path().substring(1);
                    };
                    // console.log($rootScope.$parent, $scope.label);
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

            // $scope.menu = [
            //     {label: 'Home', url: 'home', selected: false},
            //     {label: 'View1', url: 'view1', selected: false}
            // ];
        });

        angular.bootstrap(document.body, ['mainApp']);
    });
});
