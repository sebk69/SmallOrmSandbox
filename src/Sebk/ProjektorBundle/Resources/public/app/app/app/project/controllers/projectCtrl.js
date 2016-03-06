/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */
projektorApp.controller('projectCtrl', ["$scope", "$stateParams", "projektorProject", projectCtrl]);

function projectCtrl ($scope, $stateParams, projektorProject) {
    projektorProject.get({"id": $stateParams.idProject}, function (project) {
        $scope.project = project;
    })
}