/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

projektorApp.service("projektorLogin", function ($http, $state, $window, $q) {
    this.loginMessage = "";

    this.login = function (login, password) {
        var deffered = $q.defer();

        $http.post("http://projektor/api/users/login_check", {_username: login, _password: password}, {headers: {'Content-Type': 'application/json'}})
                .then(function (response) {
                    this.loginMessage = "";
                    $window.sessionStorage.setItem("token", response.data.token);
                    $http.defaults.headers.common.Authorization = 'Bearer ' + $window.sessionStorage.getItem("token");
                    $state.go("projektor.home");
                    deffered.resolve();
                }, function (response) {
                    deffered.reject("Wrong login or password");
                })

        return deffered.promise;
    }

    this.logout = function () {
        $state.go("login");
    }
})