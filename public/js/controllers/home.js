define([], function() {
    function _controller($scope, $rootScope) {
        $rootScope.isAdmin = false;
        $scope.teste = 'foi??';
    }

    return _controller;
});
