'use strict';

define([
    'app',
    'route-config'
], function(app, routeConfig) {
    return app.config(function($routeProvider) {
        $routeProvider.when('/home', routeConfig.config('../home', 'controllers/home'));
        $routeProvider.when('/view1', routeConfig.config('../view1', 'controllers/view1'));

        $routeProvider.otherwise({redirectTo: '/home'});
    });
});