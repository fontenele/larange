define([], function() {
    var mainApp = angular.module("mainApp", []);

    mainApp.controller('StudentsController', function($rootScope, $scope, router) {
        $rootScope.namespace = [['View1', '']];
        
        router.getJson().then(function(data) {
            $scope.teste = data.tela_home;
            $scope.students = data.students;
        });
    });

});
