'use strict';

require.config({
    baseUrl: 'js',
    urlArgs: "_t=" + (new Date()).getTime(),
    paths: {
        'jquery': '../vendor/jquery/dist/jquery',
        'text': '../vendor/text/text',
        'angular': '../vendor/angular/angular',
        'lib': '../vendor'
    },
    shim: {
        'angular': {
            "deps": ['jquery'],
            "exports": "angular"
        },
        'app': {
            "deps": ['angular']
        },
        'routes': {
            "deps": ['angular']
        }
    }
});

require([
    'text',
    'jquery',
    'angular',
    'app',
    'routes'
], function(text, $, angular) {
    $(document).ready(function() {
        angular.bootstrap(document, ['larange']);
    });
});



/*require.config({
    baseUrl: 'js',
    urlArgs: "_t=" + (new Date()).getTime(),
    paths: {
        'jquery': '../vendor/jquery/dist/jquery.min',
        'angular': '../vendor/angular/angular.min',
        // 'ngAnimate': '../vendor/angular-animate/angular-animate',
        // 'ngAria': '../vendor/angular-aria/angular-aria',
        // 'ngCookies': '../vendor/angular-cookies/angular-cookies',
        // 'ngMaterial': '../vendor/angular-material/angular-material',
        // 'ngMessages': '../vendor/angular-messages/angular-messages',
        // 'ngResource': '../vendor/angular-resource/angular-resource',
        'ngRoute': '../vendor/angular-route/angular-route.min'
        // 'ngSanitize': '../vendor/angular-sanitize/angular-sanitize',
        // 'ngTouch': '../vendor/angular-touch/angular-touch'
    },
    shim: {
        "jquery": {
            "exports": "$"
        },
        'angular': {
            "exports": "angular",
            "deps": ['jquery']
        },
        // 'ngAnimate': {
        //     "exports": "ngAnimate",
        //     "deps": [
        //         "angular"
        //     ]
        // },
        // 'ngMaterial': {
        //     "exports": "ngMaterial",
        //     "deps": [
        //         "angular"
        //     ]
        // },
        // 'ngCookies': {
        //     "exports": "ngCookies",
        //     "deps": [
        //         "angular"
        //     ]
        // },
        // 'ngResource': {
        //     "exports": "ngResource",
        //     "deps": [
        //         "angular"
        //     ]
        // },
        'ngRoute': ['angular']
        // 'ngSanitize': {
        //     "exports": "ngSanitize",
        //     "deps": [
        //         "angular"
        //     ]
        // },
        // 'ngTouch': {
        //     "exports": "ngTouch",
        //     "deps": [
        //         "angular"
        //     ]
        // }
    }
});

require(['angular', 'app'], function(angular, app) {
    angular.element(document).ready(function() {
        angular.bootstrap(document, ['app']);
    });
});

*/


/*
var larangeAngular = angular.module('larange', ['ngRoute']);

larangeAngular.config(function($routeProvider, $locationProvider) {
    // console.log($routeProvider, $locationProvider);
    $routeProvider.
        when('/home', {
            templateUrl: 'home',
            controller: 'App1Ctrl',
            resolve: {
                resolver: function($q, $rootScope, $timeout) {
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
        }).
        when('/view1', {
            templateUrl: 'view1',
            controller: 'App2Ctrl'
        }).
        otherwise({
            redirectTo: '/home'
        });
});

// larangeAngular.controller('App1Ctrl', function($scope) {
//
// });
larangeAngular.controller('App2Ctrl', function($scope) {

});
*/

/*
require.config({
    baseUrl: 'js',
    paths: {
        'jquery': '../vendor/jquery/dist/jquery',
        'ngAnimate': '../vendor/angular-animate/angular-animate',
        'ngAria': '../vendor/angular-aria/angular-aria',
        'ngCookies': '../vendor/angular-cookies/angular-cookies',
        'ngMaterial': '../vendor/angular-material/angular-material',
        'ngMessages': '../vendor/angular-messages/angular-messages',
        'ngResource': '../vendor/angular-resource/angular-resource',
        'ngRoute': '../vendor/angular-route/angular-route',
        'ngSanitize': '../vendor/angular-sanitize/angular-sanitize',
        'ngTouch': '../vendor/angular-touch/angular-touch'
    },
    shim: {
        "jquery": {
            "exports": "$"
        },
        'angular': {
            "exports": "angular"
        },
        'ngAnimate': {
            "exports": "ngAnimate",
            "deps": [
                "angular"
            ]
        },
        'ngMaterial': {
            "exports": "ngMaterial",
            "deps": [
                "angular"
            ]
        },
        'ngCookies': {
            "exports": "ngCookies",
            "deps": [
                "angular"
            ]
        },
        'ngResource': {
            "exports": "ngResource",
            "deps": [
                "angular"
            ]
        },
        'ngRoute': {
            "exports": "ngRoute",
            "deps": [
                // "angular"
            ]
        },
        'ngSanitize': {
            "exports": "ngSanitize",
            "deps": [
                "angular"
            ]
        },
        'ngTouch': {
            "exports": "ngTouch",
            "deps": [
                "angular"
            ]
        }
    },
    deps: ['app']
});
*/
/*
require.config({
    baseUrl: "js",

    // alias libraries paths
    paths: {
        'angular': '../vendor/angular/angular',
        "app": "app",
        'jquery': '../vendor/jquery/dist/jquery',
        'ngAnimate': '../vendor/angular-animate/angular-animate',
        'ngAria': '../vendor/angular-aria/angular-aria',
        'ngCookies': '../vendor/angular-cookies/angular-cookies',
        'ngMaterial': '../vendor/angular-material/angular-material',
        'ngMessages': '../vendor/angular-messages/angular-messages',
        'ngResource': '../vendor/angular-resource/angular-resource',
        'ngRoute': '../vendor/angular-route/angular-route',
        'ngSanitize': '../vendor/angular-sanitize/angular-sanitize',
        'ngTouch': '../vendor/angular-touch/angular-touch'
    },

    // angular does not support AMD out of the box, put it in a shim
    shim: {
        "jquery": { 
            "exports": "$" 
        },
        'angular': {
            "exports": "angular"
        },
        'ngAnimate': {
            "exports": "ngAnimate",
            "deps": [
                "angular"
            ]
        },
        'ngMaterial': {
            "exports": "ngMaterial",
            "deps": [
                "angular"
            ]
        },
        'ngCookies': {
            "exports": "ngCookies",
            "deps": [
                "angular"
            ]
        },
        'ngResource': {
            "exports": "ngResource",
            "deps": [
                "angular"
            ]
        },
        'ngRoute': {
            "exports": "ngRoute",
            "deps": [
                "angular"
            ]
        },
        'ngSanitize': {
            "exports": "ngSanitize",
            "deps": [
                "angular"
            ]
        },
        'ngTouch': {
            "exports": "ngTouch",
            "deps": [
                "angular"
            ]
        }
    }

    // deps: ['app']
});





require([
    'jquery',
    'ngMaterial',
    'ngRoute',
    'ngSanitize',
    'app'
    // 'viewHomeController',
    // 'commonRoutes',
    // 'header'
], function() {
    var AppRoot = angular.element(document.getElementById('ng-app-container'));
    AppRoot.attr('ng-controller','AppCtrl');
    
    angular.element().ready(function() {
        // console.log('ready',angular);
        angular.bootstrap(document, ['app']);
        // angular.resumeBootstrap(document, ['app']);
    });
});

    */
