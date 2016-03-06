/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

function configHome($stateProvider) {
    $stateProvider
            .state({
                name: "projektor.home",
                templateUrl: "app/app/main/partials/home.html",
                url: "",
            });
}