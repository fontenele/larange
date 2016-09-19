define([], function() {
    var mainApp = angular.module("mainApp", []);

    mainApp.controller('StudentsController', function($scope, router) {
        router.getJson().then(function(data) {
            $scope.teste = data.tela_home;
            $scope.students = data.students;
        });
    });

});
