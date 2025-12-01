<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\MElection;
use App\Models\MCandidateGroup;
use App\Models\MCandidate;

class Election extends BaseController
{
    protected $election;
    protected $candidate;
    protected $candidateGroup;

    public function __construct()
    {
        $this->election = new MElection();
        $this->candidate = new MCandidate();
        $this->candidateGroup = new MCandidateGroup();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data["elections"] = $this->election->findAll();
        $data["onGoing"] = $this->election->where("status", "open")->first();

        return view('admin/election/V_Election', $data);
    }

    public function store()
    {
        $req = $this->request->getPost();

        $this->election->insert([
            "title" => $req["election-title"],
            "start_at" => $req["start-at"],
            "end_at" => $req["end-at"],
            "status" => "draft",
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s")
        ]);

        return redirect()->to("admin/election")->with('msg', "<script>Swal.fire('Berhasil', 'Pemilihan berhasil disimpan', 'success')</script>");
    }

    public function getCandidateGroup($id)
    {
        $data["candidate"] = $this->candidate->select('id, nis, name, photo')->findAll();

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
            ->where("candidate_group.election_id", $id)
            ->join("candidate cp", "candidate_group.cp_id = cp.id")->join("candidate vcp", "candidate_group.vcp_id = vcp.id")->findAll();

        return view("admin/candidate_group/V_Candidate_Group", $data);
    }

    public function switchStatus($id)
    {
        $status = $this->request->getGet("switch");
        $this->election->update($id, ["status" => $status]);
        return redirect()->to("admin/election")->with('msg', "<script>Swal.fire('Status Dirubah', 'Status pemilihan berhasil dirubah', 'success')</script>");
    }
}
