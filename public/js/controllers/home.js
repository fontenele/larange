define([
    'json!tpl/home'
], function(json) {
    console.log(json);
    function _controller($scope, $rootScope) {
        // require(['text!tpl/home'], function() {
        //     console.log("ae", $scope);
        //     $scope.teste = 'heim?';
        // });
        $rootScope.isAdmin = false;
        $scope.teste = json.teste;
    }

    return _controller;
});
