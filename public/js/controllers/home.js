define([], function() {
    var mainApp = angular.module("mainApp", []);

    mainApp.controller('HomeController', function($scope, router) {
        router.getJson().then(function(data) {
            $scope.teste = data.tela_home;
            $scope.message = data.message;
        });
    });

});
