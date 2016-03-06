/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

function configAccount($stateProvider) {
    $stateProvider
            .state({
                name: "login",
                templateUrl: "app/app/account/partials/login.html",
                controller: "loginCtrl",
                url: "/login",
            })
            .state({
                name: "projektor.account",
                templateUrl: "app/app/account/partials/account.html",
                controller: "accountCtrl",
                url: "/account",
            });
}