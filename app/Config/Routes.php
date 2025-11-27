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
        $team->post("store", "Admin\CandidateGroup::store");
    });

    $admin->group("participant", function ($participant) {
        $participant->get("/", "Admin\Participant::index");
        $participant->get("new", "Admin\Participant::new");
        $participant->post("import", "Admin\Participant::import");
    });
});
