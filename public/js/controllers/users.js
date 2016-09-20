define([], function() {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('UsersController', function($rootScope, $scope, router, $location) {
        $rootScope.menu = [
            {label: 'Painel', url: 'admin', selected: false},
            {label: 'Usuários', url: 'users', selected: true}
        ];

        router.getJson().then(function(data) {
            $scope.listItems = data.list_items;
            $scope.editItem = function(item) {
                $location.path('users/edit/' + item.id);
            };
            
            $scope.novo = function() {
                $location.path('users/edit');
            };
        });
    });

});
