/**
 * bootstraps angular onto the window.document node
 */
define([
    'angularAMD',
    'angular-route'
], function (angularAMD) {

    var app = angular.module("app", ['ngRoute']);
    app.config(function($routeProvider) {

        $routeProvider
            .when("/home", angularAMD.route({
                templateUrl: 'views/home.blade.php',
                // controller: 'HomeCtrl',
                // controllerUrl: 'controllers/home'
            }))
            .when("/view1", angularAMD.route({
                templateUrl: 'views/view1.php',
                controller: 'View1Ctrl',
                controllerUrl: 'controllers/view1'
            }))
            .otherwise({redirectTo: "/home"});
    });

    return angularAMD.bootstrap(app);
});
