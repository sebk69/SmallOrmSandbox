/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

var configHome = function ($stateProvider) {
    $stateProvider
            .state({
                name: "projektor.home",
                templateUrl: "app/main/partials/home.html",
                //controller: "loginCtrl",
                url: "/home",
            });
}