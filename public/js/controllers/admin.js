define([], function() {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('AdminController', function($rootScope, $scope, router) {
        $rootScope.menu = [
            {label: 'Painel', url: 'admin', selected: true},
            {label: 'Usuários', url: 'users', selected: false}
        ];

        router.getJson().then(function(data) {
        });
    });

});
