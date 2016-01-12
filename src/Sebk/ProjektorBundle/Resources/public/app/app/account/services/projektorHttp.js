/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

projektorApp.service("projektorHttp", ["$http", "$state", "$window", "$q", function ($http, $state, $window, $q) {
    this.loginMessage = "";

    this.login = function (login, password) {
        var deffered = $q.defer();

        $http.post("http://localhost/app_dev.php/api/users/login_check", {_username: login, _password: password}, {headers: {'Content-Type': 'application/json'}})
                .then(function (response) {
                    this.loginMessage = "";
                    $window.sessionStorage.setItem("token", response.data);
                    $state.go("home");
                    deffered.resolve();
                }, function (response) {
                    deffered.reject("Wrong login or password");
                })
                
        return deffered.promise;
    }
}])