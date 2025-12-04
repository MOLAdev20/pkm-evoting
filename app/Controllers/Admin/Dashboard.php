<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\MParticipant;
use App\Models\MCandidateGroup;

class Dashboard extends BaseController
{
    protected $participant;
    protected $candidateGroup;

    public function __construct()
    {
        $this->participant = new MParticipant();
        $this->candidateGroup = new MCandidateGroup();
    }

    public function index()
    {
        $data["totalParticipant"] = $this->participant->where("status", 1)->countAllResults();
        $data["candidates"] = $this->candidateGroup->select([
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
            ->join("candidate cp", "candidate_group.cp_id = cp.id")->join("candidate vcp", "candidate_group.vcp_id = vcp.id")->findAll();

        return view("admin/V_Dashboard", $data);
    }
}
