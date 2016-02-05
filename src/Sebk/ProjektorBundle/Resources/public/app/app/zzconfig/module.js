/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

var projektorApp = angular.module('projektorApp', ['ui.router'])
        .config(['$stateProvider', function ($stateProvider) {
                $stateProvider
                        .state({
                            name: "projektor",
                            templateUrl: "app/main/partials/layout.html",
                            //controller: "loginCtrl",
                            url: "",
                        });
                configAccount($stateProvider);
                configHome($stateProvider);
            }])
        .run(function ($state, $rootScope, $window, $http) {
                $rootScope.activeMenu = null;
                $state.go('projektor.home');
                $http.defaults.headers.common.Authorization = 'Bearer ' + $window.sessionStorage.getItem("token");
            })
        ;