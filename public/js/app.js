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
