define([], function() {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('AdminController', function($rootScope, $scope, $http, $q) {
        $rootScope.menu = [
            {label: 'Painel', url: 'admin', selected: true},
            {label: 'Usuários', url: 'users', selected: false}
        ];

        $http.post('/admin').success(function(data) {




        });
    });

});
