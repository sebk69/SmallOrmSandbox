/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

var projektorApp = angular.module('projektorApp', ['ui.router'])
        .config(['$stateProvider', function ($stateProvider) {
                configAccount($stateProvider);
            }])
        .run(['$state', function ($state) {
            $state.go('login');
        }])
        ;