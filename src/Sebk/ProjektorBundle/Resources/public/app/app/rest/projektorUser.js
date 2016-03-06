projektorApp.service("projektorUser", ["$resource", function ($resource) {
        return $resource("/api/users/:id", {}, {
            queryRole: { method: "GET", url: "/api/users?role=:role", isArray: true },
        });
    }])