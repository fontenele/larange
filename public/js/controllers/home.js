define([], function() {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('HomeController', function($scope, $http, $q) {
        $http.post('/home').success(function(data) {
            $scope.teste = data.tela_home;
            $scope.message = data.message;
        });
    });

});
