<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get("/", "Home::index");
$routes->get("denied", "Home::denied");

$routes->group("admin", ["filter" => "admin-auth"], function ($admin) {

    $admin->get("dashboard", "Admin\Dashboard::index");

    $admin->group("election", function ($election) {
        $election->get("/", "Admin\Election::index");
        $election->get("switch/(:num)", "Admin\Election::switchStatus/$1");
        $election->post('store', 'Admin\Election::store');
        $election->get("detail/(:num)", "Admin\Election::detail/$1");
    });

    $admin->group("candidate", function ($candidate) {
        $candidate->get("/", "Admin\Candidate::index");
        $candidate->get("new", "Admin\Candidate::new");
        $candidate->post("store", "Admin\Candidate::store");
    });

    $admin->group("candidate-group", function ($team) {
        $team->get("/", "Admin\CandidateGroup::index");
        $team->get("delete/(:num)", "Admin\CandidateGroup::delete/$1");
        $team->post("store", "Admin\CandidateGroup::store");
    });

    $admin->group("participant", function ($participant) {
        $participant->get("/", "Admin\Participant::index");
        $participant->get("new", "Admin\Participant::new");
        $participant->post("store", "Admin\Participant::store");
        $participant->post("import", "Admin\Participant::import");
    });
});


$routes->group("login", function ($login) {
    $login->get("participant", "Auth::loginParticipant");
    $login->post("participant", "Auth::processParticipant");

    $login->get("administrator", "Auth::LoginAdministrator");
    $login->post("administrator", "Auth::processAdministrator");
});

$routes->get("logout", "Auth::logout");

$routes->group("election", function ($election) {
    $election->get("/", "Election::index");
    $election->post("store", "Election::saveElection");

    $election->group("ajax", function ($ajaxElection) {
        $ajaxElection->get("live-votes", "Election::getLiveVotes");
    });
});
