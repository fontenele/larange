define([], function() {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('EditController', function($rootScope, $scope, $http, $location) {
        $rootScope.menu = [
            {label: 'Painel', url: 'admin', selected: false},
            {label: 'Usuários', url: 'users', selected: true}
        ];

        console.log("edit");

        // $http.post('/admin/users').success(function(data) {
        //     $scope.listItems = data.list_items;
        //     $scope.editItem = function(item) {
        //         $location.path('admin|users|edit|' + item.id);
        //     };
        // });
    });

});
