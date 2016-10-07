define([], function() {
    var mainApp = angular.module("mainApp", []);

    mainApp.controller('HomeController', function($rootScope, $scope, router) {
        $rootScope.namespace = [['Home', '']];
        
        router.getJson().then(function(data) {
            $scope.total = data;
        });
    });

});
