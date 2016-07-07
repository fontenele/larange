require.config({
    baseUrl: 'js',
    urlArgs: "_t=" + (new Date()).getTime(),
    paths: {
        'jquery': '../vendor/jquery/dist/jquery',
        'text': '../vendor/text/text',
        'json': '../vendor/requirejs-plugins//src/json',
        'angular': '../vendor/angular/angular',
        'lib': '../vendor',
        'tpl': '..'
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