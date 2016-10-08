define([], function() {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('AdminController', function($rootScope, $scope, router) {

        router.getJson().then(function(data) {
            $rootScope.namespace = [['Administração', '']];
            $rootScope.pageHeader = '';
            $rootScope.pageSubheader = '';
            
            $scope.total = data.total;

            // console.log();
            // console.log($rootScope.checkAclPermission());
        });
    });

});
