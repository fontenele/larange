define([], function() {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('LoginController', function($rootScope, $scope, $http, $q, $auth, $location) {

        $scope.name = "Nome?";
        $scope.login = function() {
            var credentials = {
                email: this.email,
                password: this.password
            };

            $auth.login(credentials).then(function(result) {
                if(!result.data || !result.data.access_token) {
                    return;
                }

                localStorage.setItem('token', result.data.access_token);

                return $http({
                    url: '/oauth/user',
                    method: "POST",
                    data: {'access_token': result.data.access_token}
                }).then(function(response) {
                    var user = response.data;
                    localStorage.setItem('user', JSON.stringify(user));

                    $rootScope.authenticated = true;
                    $rootScope.currentUser = user;
                    $rootScope.permissions = user.permissions;
                    
                    $location.path('/home');
                    $rootScope.menuItemAtual = $location.path().substring(1);
                });
            });
        };

    });

});
