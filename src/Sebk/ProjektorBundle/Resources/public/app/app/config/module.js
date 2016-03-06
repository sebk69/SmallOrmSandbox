/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

var projektorApp = angular.module('projektorApp', ['ui.router', 'ngResource'])
        .config(['$stateProvider', function ($stateProvider) {
                $stateProvider
                        .state({
                            name: "projektor",
                            templateUrl: "app/app/main/partials/layout.html",
                            controller: "layoutCtrl",
                            url: "",
                        });
                configAccount($stateProvider);
                configHome($stateProvider);
                configProjects($stateProvider);
            }])
        .run(function ($state, $rootScope, $window, $http) {
            $rootScope.activeMenu = null;
            $state.go('projektor.home');
            $http.defaults.headers.common.Authorization = 'Bearer ' + $window.sessionStorage.getItem("token");
        })
        .config(function ($httpProvider) {
            $httpProvider.interceptors.push('projektor401Detector');
        })
        .factory('projektor401Detector', function ($q, $window, $location) {
            return {
                responseError: function (response) {
                    if (response.status === 401) {
                        $window.sessionStorage.setItem("token", "");
                        $location.path("/login");
                        return $q.reject(response);
                    } else {
                        return $q.reject(response);
                    }
                }
            };
        });


