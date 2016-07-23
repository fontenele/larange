define([], function() {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('StudentsController', function($scope) {
        $scope.teste = 'aeeee';
        $scope.students = [
            {name: 'Mark Waugh', city:'New York'},
            {name: 'Steve Jonathan', city:'London'},
            {name: 'John Marcus', city:'Paris'}
        ];
    });

});
