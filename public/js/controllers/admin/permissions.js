define(['moment'], function(moment) {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('RolesPermissionsController', function($rootScope, $scope, $location, $http, $window, router) {
        $rootScope.menu = [
            {label: 'Painel', url: 'admin', selected: false},
            {label: 'Perfis', url: 'roles', selected: true},
            {label: 'Usuários', url: 'users', selected: false}
        ];

        $scope.getItemsList = function () {
            router.getJson().then(function (data) {
                $scope.role = data.role;
                $scope.list = data.list;
                $scope.actives = data.actives;

                $scope.save = function ($event) {
                    var items = $($event.target).serializeArray();
                    
                    $http.post('admin/roles/' + data.role.id + '/permissions/save', {
                        items: items
                    }).success(function (data) {
                        if (data.status == 'success') {
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
                            $location.path('roles');
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
        };

        $scope.getItemsList();
        
    });
});
