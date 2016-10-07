define([], function() {
    var mainApp = angular.module("mainApp", []);

    mainApp.controller('StudentsController', function($rootScope, $scope, router) {
        $rootScope.namespace = [['Principal', 'home'], ['Folha de Ponto', '']];
        $rootScope.pageHeader = 'Folha de Ponto';
        $rootScope.pageSubheader = '';
        
        router.getJson().then(function(data) {
            $scope.teste = data.tela_home;
            $scope.students = data.students;
        });
    });

});
