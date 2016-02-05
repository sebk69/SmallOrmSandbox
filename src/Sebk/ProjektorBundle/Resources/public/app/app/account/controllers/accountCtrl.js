/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */
projektorApp.controller('accountCtrl', function ($scope, $state, $http, $timeout) {
    $scope.user = null;
    $http.get("/api/users/myself")
            .then(function (response) {
                $scope.user = response.data;
            }, function (response) {
                alert(response.data)
            })

    $scope.validate = function () {
        $http.put("/api/users/myself", $scope.user)
                .then(function (response, status) {
                    $scope.user = response.data;
                    $scope.updated = true;
                    $timeout(function () {
                        $scope.updated = false;
                    }, 3000);
                }, function (response, satus) {
                    alert(response.data)
                })
    }
})