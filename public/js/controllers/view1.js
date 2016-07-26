define([], function() {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('StudentsController', function($scope, $http, $q) {
        loading.show();
        $http.get('/view1').success(function(data) {
            loading.hide();
            $scope.teste = data.tela_home;
            $scope.students = data.students;
        });
    });

});
