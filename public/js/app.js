'use strict';

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

    app.controller('CommonController', function($scope) {
        console.log("commoncontroller");
        // $scope.on('updateCSS', function() {
        //     $scope.stylesheets = args;
        // });
    });

    return app;
});





/*define(['angular'], function(angular) {
    var app = angular.module('app', []);
    app.config(function($routeProvider, $controllerProvider, $compileProvider, $filterProvider, $provide) {
        app.controller = $controllerProvider.register;
        app.directive = $compileProvider.directive;
        app.filter = $filterProvider.register;
        app.factory = $provide.factory;
        app.service = $provide.service;

        $routeProvider.when('/home', {
            templateUrl: 'home',
            controller: 'App1Ctrl',
            resolve: {
                resolver: function($q, $rootScope) {
                    var deferred = $q.defer();
                    require(['js/controllers/home'], function () {
                        $rootScope.$apply(function() {
                            console.log("resolved");
                            deferred.resolve();
                        });
                    });
                    return deferred.promise;
                }
            }
        });

        $routeProvider.when('/home1', {
            templateUrl: 'home1',
            controller: 'App1Ctrl',
            resolve: {
                resolver: function($q, $rootScope) {
                    var deferred = $q.defer();
                    require(['js/controllers/home1'], function () {
                        $rootScope.$apply(function() {
                            console.log("resolved");
                            deferred.resolve();
                        });
                    });
                    return deferred.promise;
                }
            }
        });

        $routeProvider.otherwise({
            redirectTo: '/home'
        });
    });

    return app;
});*/
// console.log(larangeAngular);
// larangeAngular.config(function($routeProvider, $locationProvider) {
//     console.log(11111,$routeProvider, $locationProvider);
// });

/*require(['jquery', 'ngRoute'], function ($) {
    angular.element().ready(function () {
        var AppRoot = angular.element($('body')[0]);

        var app = angular.module('larange', ['ngRoute'], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

        app.controller('WelcomeController', function($scope) {
            $scope.meufilho = 'aeeeww';
            console.log(122, $scope);
        });
        app.controller('AppCtrl', function($scope) {
            $scope.meufilho = 'aeeeww';
            console.log(3333, $scope);
        });

        app.config(function($routeProvider, $locationProvider) {
            // $locationProvider.html5Mode({
            //     enabled: true,
            //     requireBase: false
            // });

            $routeProvider
                .when('/home', {
                    // templateUrl: 'home',
                    templateUrl: function(urlattr) {
                        console.log(122222222222, urlattr);
                    },
                    controller: 'AppCtrl',
                    resolve: function() {
                        console.log("ae");
                    }
                })
                .when('/view1', {
                    templateUrl: 'view1',
                    controller: 'AppCtrl',
                    resolve: function() {
                        console.log("ae1");
                    }
                }).when('/view2', {
                    templateUrl: 'view2',
                    controller: 'AppCtrl',
                    resolve: function() {
                        console.log("ae2");
                    }
                });
                // .otherwise({redirectTo: "/home"});

        });

        app.run(function($route, $rootScope, $location) {
            var original = $location.path;
            $location.path = function (path, reload) {
                if(reload === false) {
                    console.log(path, reload, $route);
                }
                // return original.apply($location, [path]);
            };


            $('body').on('click', '.route', function() {
                $location.path('/' + $(this).attr('href').substr(1), false);
                return false;
            });

            // $rootScope.$on("$routeChangeStart", function(event, next, current) {
            //     for(i in next) {
            //         console.log(i, next[i]);
            //     }
            //     for(i in current) {
            //         console.log('current: ',i, current[i]);
            //     }
            //     console.log("vai?", event.targetScope, next, current);
            // });
        });

        angular.bootstrap(AppRoot, ['larange']);
    });
});
*/







/*
define([
    'angular',
    'ngMaterial'
], function(angular) {

    // var AppRoot = angular.element(document.getElementById('ng-app-container'));
    //
    // app.controller('AppCtrl', ['$scope', function($scope) {
    //     console.log("aeee app ctrl");
    // }]);

    var app = angular.module('app', ['ngRoute', 'ngSanitize']);

    
    // require(['js/controllers/controllers.js']);

    app.config(function($routeProvider, $interpolateProvider, $locationProvider) {
        // $locationProvider.html5Mode({
        //     enabled: true,
        //     requireBase: false
        // });
        
        $routeProvider
            .when("/home", {
                templateUrl: 'home',
                // controller: 'HomeCtrl'
                controller: 'AppCtrl'
            })
            .when("/view1", {
                templateUrl: 'views/view1.php',
                controller: 'AppCtrl'
            })
            .otherwise({redirectTo: "/home"});
    });

    app.controller('AppCtrl', ['$scope', function($scope) {
        if($scope.$resolve) {
            console.log($($scope.$resolve.$template).attr('ng-controller'));
        }
    }]);
    // app.controller('App1Ctrl', ['$scope', function($scope) {
    //     console.log(11111);
    // }]);
    
    // app.controller('HomesCtrl', ['$scope', function($scope) {
    //     console.log("doiss");
    // }]);
    
    return app;
    // return angularAMD.bootstrap('app', true, document.getElementsByTagName("body")[0]);
    // return angularAMD.bootstrap(app);
    
    // return app;
});
*/