define([], function() {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('HomeController', function($scope, $http, $q) {
        $http.get('/home').success(function(data) {
            console.log("aew", data);
            $scope.teste = data.tela_home;
        });
    });

});
