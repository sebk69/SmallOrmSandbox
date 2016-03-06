/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */
projektorApp.controller('layoutCtrl', ["$scope", "projektorLogin", "projektorUser", "projektorProject", layoutCtrl]);

function layoutCtrl($scope, projektorLogin, projektorUser, projektorProject) {
    projektorUser.get({id: "myself"}, function (user) {
        $scope.user = user;
    })

    projektorProject.queryProjectsAsLeader({"userId": "myself"}, function (projects) {
        $scope.projectsAsLeader = projects;
    })

    $scope.logout = function () {
        projektorLogin.logout();
    }
}