define([], function() {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('HomeController', function($scope, $http, $q) {
        loading.show();
        $http.get('/home').success(function(data) {
            loading.hide();
            $scope.teste = data.tela_home;
            $scope.message = data.message;
        });
    });

});
