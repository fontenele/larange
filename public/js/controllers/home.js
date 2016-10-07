define([], function() {
    var mainApp = angular.module("mainApp", []);

    mainApp.controller('HomeController', function($rootScope, $scope, router) {
        
        router.getJson().then(function(data) {
            $rootScope.namespace = [['Principal', '']];
            $rootScope.pageHeader = 'Larange';
            $rootScope.pageSubheader = '';
            $scope.total = data;
        });
    });

});
