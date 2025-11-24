<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group("admin", function ($admin) {
    $admin->group("candidate", function ($candidate) {
        $candidate->get("/", "Admin\Candidate::index");
        $candidate->get("new", "Admin\Candidate::new");
        $candidate->post("store", "Admin\Candidate::store");
    });

    $admin->group("candidate-group", function ($team) {
        $team->get("/", "Admin\CandidateGroup::index");
        $team->get("new", "Admin\CandidateGroup::new");
        $team->post("store", "Admin\CandidateGroup::store");
    });
});
