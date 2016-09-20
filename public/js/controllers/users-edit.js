define(['moment'], function(moment) {


    /**
     * TODO ADICIONAR NOTY PARA NOTIFICACOES E WDT LOADING
     */



    var mainApp = angular.module("mainApp", []);
    mainApp.controller('UsersEditController', function($rootScope, $scope, $location, $http, router) {
        $rootScope.menu = [
            {label: 'Painel', url: 'admin', selected: false},
            {label: 'Usuários', url: 'users', selected: true}
        ];

        router.getJson().then(function(data) {
            $scope.user = data.user;
            
            $scope.save = function () {
                var user = $scope.user;
                if(!user.id) {
                    user.id = '';
                }
                $http.post('admin/users/save', user).success(function (data) {
                    if(data.status == 'success') {
                        alert(data.message);
                        $location.path('users');
                    }
                });
            };
        });
    });

});
