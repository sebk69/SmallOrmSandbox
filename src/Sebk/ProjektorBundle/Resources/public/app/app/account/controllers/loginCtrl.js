/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */
projektorApp.controller('loginCtrl', ['$scope', '$state', 'projektorHttp', function($scope, $state, projektorHttp) {
    $scope.error = "";
    
    $scope.loginAction = function() {
        projektorHttp.login($scope.login, $scope.password)
                .then(function() {
                    $state.go("projektor.home");
                }, function(reason) {
                    $scope.error = reason;
                })
    }
}])