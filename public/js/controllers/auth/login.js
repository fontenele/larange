define([], function() {

    var mainApp = angular.module("mainApp", []);
    mainApp.controller('LoginController', function($rootScope, $scope, $http, $q, $auth, $location) {
        $rootScope.namespace = [['Login', '']];
        $rootScope.pageHeader = 'Faça o login';
        $rootScope.pageSubheader = '';
        
        $scope.login = function() {
            var credentials = {
                email: this.email,
                password: this.password
            };
            
            if(!credentials.email || !credentials.password) {
                var n = noty({
                    layout: 'center',
                    type: 'error',
                    text: 'E-mail/Password não informados.',
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
                return false;
            }

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
