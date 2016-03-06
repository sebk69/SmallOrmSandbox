/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */
projektorApp.controller('loginCtrl', ['$scope', '$state', '$window', '$http', 'projektorLogin', loginCtrl]);

function loginCtrl($scope, $state, $window, $http, projektorLogin) {
    $scope.error = "";
    $window.sessionStorage.setItem("token", "");
    $http.defaults.headers.common.Authorization = 'Bearer ' + $window.sessionStorage.getItem("token");

    $scope.loginAction = function () {
        projektorLogin.login($scope.login, $scope.password)
            .then(function () {
                $state.go("projektor.home");
            }, function (reason) {
                $scope.error = reason;
            })
    }
}