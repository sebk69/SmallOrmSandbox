/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

function configProjects($stateProvider) {
    $stateProvider
            .state({
                name: "projektor.newProject",
                templateUrl: "app/app/project/partials/newProject.partial.html",
                controller: "newProjectCtrl",
                controllerAs: "newProjectVm",
                url: "/project/new",
            });
}