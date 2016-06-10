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
