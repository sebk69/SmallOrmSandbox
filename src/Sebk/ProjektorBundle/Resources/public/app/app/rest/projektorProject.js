/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

projektorApp.service("projektorProject", ["$resource", function ($resource) {
        return $resource("/api/projects/:id", {}, {
            new: { method: "GET", url: "/api/projects/new" },
            queryProjectsAsLeader: { method: "GET", url: "/api/projects?leaderId=:userId", isArray: true }
        });
    }])