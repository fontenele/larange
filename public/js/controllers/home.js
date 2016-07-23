define([], function() {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('HomeController', function($scope) {
        $scope.teste = '1234';
    });

});
