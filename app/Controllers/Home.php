<?php

namespace App\Controllers;

use App\Models\MCandidateGroup;
use App\Models\MElection;

class Home extends BaseController
{
    protected $candidateGroup;
    protected $election;

    public function __construct()
    {
        $this->candidateGroup = new MCandidateGroup();
        $this->election = new MElection();
    }

    public function index(): string
    {
        // cek apakah pemilihan masih berlangsung?
        $electionStatus = $this->election->where("status", "open")->first();

        if ($electionStatus == 0) {
            return view('election/V_Election_Closed');
        }

        $data["candidateGroup"] = $this->candidateGroup->select([
            "candidate_group.id",
            "alias",
            "vision",
            "mission",
            "election_id",
            "cp.name as chairperson",
            "vcp.name as vice_chairperson",
            "cp.photo as cp_photo",
            "vcp.photo as vcp_photo"
        ])
            ->where("election_id", $electionStatus["id"])
            ->join("candidate cp", "candidate_group.cp_id = cp.id")->join("candidate vcp", "candidate_group.vcp_id = vcp.id")->findAll();

        return view('public', $data);
    }

    public function denied()
    {
        return view("denied");
    }
}
