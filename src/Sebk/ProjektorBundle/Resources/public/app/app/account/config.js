/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

var configAccount = function($stateProvider) {
    $stateProvider
            .state({
                name: "login",
                templateUrl: "app/account/partials/login.html",
                controller: "loginCtrl",
                url: "/",
            });
}