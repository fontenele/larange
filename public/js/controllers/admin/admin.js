define([], function() {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('AdminController', function($rootScope, $scope, router) {
        $rootScope.namespace = [['Admin', '']];

        router.getJson().then(function(data) {
        });
    });

});
