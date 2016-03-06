/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */
projektorApp.controller("newProjectCtrl", newProjectCtrl, ["$scope", "projektorProject", "projektorUser"]);

function newProjectCtrl ($scope, projektorProject, projektorUser) {
    var newProjectVm = this;

    newProjectVm.leaders = [];

    projektorProject.new(function (project) {
        newProjectVm.project = project;
    })

    projektorUser.queryRole({role: "ROLE_LEADER"}, function(leaders) {
        newProjectVm.leaders = leaders;
    })


    newProjectVm.save = save;

    function save() {
        projektorProject.save(newProjectVm.project);
    }
}