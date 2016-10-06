define([], function() {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('UsersController', function($rootScope, $scope, $location, $http, $route, router) {
        $rootScope.menu = [
            {label: 'Painel', url: 'admin', selected: false},
            {label: 'Perfis', url: 'roles', selected: false},
            {label: 'Usuários', url: 'users', selected: true}
        ];
        
        $scope.getItemsList = function (paginator) {
            var getList = function () {
                router.getJson(paginator).then(function(data) {
                    $scope.list = data.list;

                    $scope.editItem = function(item) {
                        $location.path('users/edit/' + item.id);
                    };

                    $scope.viewRole = function (role) {
                        $location.path('roles/' + role.id +  '/permissions');
                    };

                    $scope.removeItem = function(item) {
                        noty({
                            layout: 'center',
                            type: 'confirm',
                            text: 'Deseja mesmo remover o Usuário ' + item.name + '?',
                            buttons: [
                                {
                                    addClass: 'btn btn-primary',
                                    text: 'Ok',
                                    onClick: function ($noty) {
                                        $noty.close();
                                        $http.post('admin/users/remove/' + item.id).success(function (data) {
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
                        $location.path('users/edit');
                    };
                });
            }();
        };

        $scope.getItemsList();
    });

});
