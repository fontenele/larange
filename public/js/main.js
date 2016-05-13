require.config({
    baseUrl: "js",

    // alias libraries paths
    paths: {
        'angular': '../vendor/angular/angular',
        'angular-route': '../vendor/angular-route/angular-route',
        'angularAMD': '../vendor/angularAMD/angularAMD'
    },

    // angular does not support AMD out of the box, put it in a shim
    shim: {
        'angularAMD': [
            'angular'
        ],
        'angular-route': [
            'angular'
        ]
    },

    // kick start application
    deps: ['app']
});
