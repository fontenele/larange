define(['moment'], function(moment) {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('PermissionsEditController', function($rootScope, $scope, $location, $http, $window, router) {
        $rootScope.namespace = [['Admin', 'admin'], ['Permissions', 'permissions'], ['Edit', '']];

        router.getJson().then(function(data) {
            $scope.item = data.item;
            $scope.list = data.roles;
            $scope.actives = data.actives;
            
            $scope.save = function ($event) {
                var item = $scope.item;
                if(!item.id) {
                    item.id = '';
                }
                $http.post('admin/permissions/save', item).success(function (data) {
                    if(data.status == 'success') {
                        var n = noty({
                            layout: 'center',
                            type: 'success',
                            text: data.message,
                            animation: {
                                open: 'animated flipInX',
                                close: 'animated flipOutX',
                                easing: 'swing',
                                speed: 500
                            }
                        });
                        setTimeout(function () {
                            n.close();
                        }, 3000);
                        $location.path('permissions');
                        return;
                    }

                    noty({
                        layout: 'center',
                        type: 'error',
                        text: data.message,
                        animation: {
                            open: 'animated flipInX',
                            close: 'animated flipOutX',
                            easing: 'swing',
                            speed: 500
                        }
                    });
                });
            };
            $scope.cancelar = function () {
                $window.history.back();
            };
        });
    });

});
