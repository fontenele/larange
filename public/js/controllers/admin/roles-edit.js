define(['moment'], function(moment) {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('RolesEditController', function($rootScope, $scope, $location, $http, $window, router) {

        router.getJson().then(function(data) {
            $rootScope.namespace = [['Administração', 'admin'], ['Perfis', 'roles'], [(data.item ? 'Editar' : 'Criar'), '']];
            $rootScope.pageHeader = data.item ? 'Editar perfil' : 'Criar perfil';
            $rootScope.pageSubheader = data.item ? data.item.label : '';
            
            $scope.item = data.item;

            $scope.save = function () {
                var item = $scope.item;
                if(!item.id) {
                    item.id = '';
                }
                $http.post('admin/roles/save', item).success(function (data) {
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
    });

});
