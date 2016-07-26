define([], function() {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('LoginController', function($rootScope, $scope, $http, $q, $auth, $location) {

        $scope.name = "Nome?";
        $scope.login = function() {
            var credentials = {
                email: this.email,
                password: this.password
            };

            $auth.login(credentials).then(function() {
                return $http.get('api/authenticate/user').then(function(response) {
                    var user = JSON.stringify(response.data.user);
                    localStorage.setItem('user', user);

                    $rootScope.authenticated = true;
                    $rootScope.currentUser = response.data.user;

                    $location.path('/home');
                    $rootScope.menuItemAtual = $location.path().substring(1);
                });
            });
        };

    });

});
