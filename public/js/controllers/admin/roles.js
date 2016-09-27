define([], function() {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('RolesController', function($rootScope, $scope, $location, $http, $route, router) {
        $rootScope.menu = [
            {label: 'Painel', url: 'admin', selected: false},
            {label: 'Perfis', url: 'roles', selected: true},
            {label: 'Usuários', url: 'users', selected: false}
        ];

        $scope.getItemsList = function (paginator) {
            var getList = function () {
                router.getJson(paginator).then(function(data) {
                    $scope.list = data.list;

                    $scope.editItem = function(item) {
                        $location.path('roles/edit/' + item.id);
                    };

                    $scope.removeItem = function(item) {
                        noty({
                            layout: 'center',
                            type: 'confirm',
                            text: 'Deseja mesmo remover o Perfil ' + item.name + '?',
                            buttons: [
                                {
                                    addClass: 'btn btn-primary',
                                    text: 'Ok',
                                    onClick: function ($noty) {
                                        $noty.close();
                                        $http.post('admin/roles/remove/' + item.id).success(function (data) {
                                            if(data.status == 'success') {
                                                noty({
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
                                                $route.reload();
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
                                    }
                                },
                                {
                                    addClass: 'btn btn-danger',
                                    text: 'Cancel',
                                    onClick: function ($noty) {
                                        $noty.close();
                                    }
                                }
                            ],
                            animation: {
                                open: 'animated flipInX',
                                close: 'animated flipOutX',
                                easing: 'swing',
                                speed: 500
                            }
                        });
                    };

                    $scope.newItem = function() {
                        $location.path('roles/edit');
                    };
                });
            }();
        };

        $scope.getItemsList();
    });

});
