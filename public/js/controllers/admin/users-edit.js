define(['moment'], function(moment) {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('UsersEditController', function($rootScope, $scope, $location, $http, $window, router) {
        $rootScope.namespace = [['Admin', 'admin'], ['Users', 'users'], ['Edit', '']];

        router.getJson().then(function(data) {
            $scope.item = data.item;
            $scope.list = data.roles;
            $scope.actives = data.actives;
            
            $scope.save = function ($event) {
                var item = $scope.item;
                if(!item.id) {
                    item.id = '';
                }
                item.items = $($event.target).serializeArray();
                $http.post('admin/users/save', item).success(function (data) {
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
                        $location.path('users');
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
