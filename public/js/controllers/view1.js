define([], function() {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('StudentsController', function($scope, $http, $q) {
        $http.get('/view1').success(function(data) {
            $scope.teste = data.tela_home;
            $scope.students = data.students;
        });
    });

});
