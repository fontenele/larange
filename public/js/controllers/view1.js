define([], function() {
    function _controller($scope, $rootScope) {
        // $scope.teste = 'foi??';
        $rootScope.isAdmin = true;
        console.log("aeeeeae", $rootScope);
    }

    return _controller;
});
