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

    public function detail($id)
    {
        $data["election"] = $this->election->find($id);
        $data["otherOnGoing"] = $this->election->where("status", "open")->where("id <>", $id)->first();
        $data["candidate"] = $this->candidate->select('id, nis, name, photo')->findAll();

        $data["candidateGroup"] = $this->candidateGroup->getLiveVoteWithCG($data["election"]["id"]);

        // return $this->response->setJSON($data["otherOnGoing"]);

        return view("admin/election/V_Detail_Election", $data);
    }

    public function switchStatus($id)
    {
        $status = $this->request->getGet("switch");
        $this->election->update($id, ["status" => $status]);
        return redirect()->to("admin/election")->with('msg', "<script>Swal.fire('Status Dirubah', 'Status pemilihan berhasil dirubah', 'success')</script>");
    }

    public function update($id)
    {
        $req = $this->request->getPost();

        $this->election->set([
            "title" => $req["election-title"],
            "start_at" => $req["election-start-at"],
            "end_at" => $req["election-end-at"],
            "updated_at" => date("Y-m-d H:i:s")
        ])->where(["id" => $id])->update();

        return redirect()->to("admin/election/detail/{$id}")->with('msg', "<script>Swal.fire('Edit Berhasil', 'Pemilihan berhasil diedit', 'success')</script>");
    }
}
