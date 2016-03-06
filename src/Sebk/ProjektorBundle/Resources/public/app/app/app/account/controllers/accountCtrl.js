/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */
projektorApp.controller('accountCtrl', ['$scope', 'projektorUser', '$timeout', accountCtrl]);

function accountCtrl($scope, projektorUser, $timeout) {
    $scope.user = null;

    projektorUser.get({id: "myself"}, function (user) {
        $scope.user = user;
    })

    $scope.validate = function () {
        projektorUser.save($scope.user, function (user) {
            $scope.user = user;
            $scope.updated = true;
            $timeout(function () {
                $scope.updated = false;
            }, 3000);
        })
    }
}