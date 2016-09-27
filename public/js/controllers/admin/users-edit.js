define(['moment'], function(moment) {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('UsersEditController', function($rootScope, $scope, $location, $http, $window, router) {
        $rootScope.menu = [
            {label: 'Painel', url: 'admin', selected: false},
            {label: 'Perfis', url: 'roles', selected: false},
            {label: 'Usuários', url: 'users', selected: true}
        ];

        router.getJson().then(function(data) {
            $scope.item = data.item;
            
            $scope.save = function () {
                var item = $scope.item;
                if(!item.id) {
                    item.id = '';
                }
                $http.post('admin/users/save', item).success(function (data) {
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
