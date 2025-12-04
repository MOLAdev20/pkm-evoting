<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\MCandidateGroup;
use App\Models\MCandidate;
use App\Models\MElection;
use App\Models\MVotingRecords;


class CandidateGroup extends BaseController
{
    protected $candidate;
    protected $candidateGroup;
    protected $election;
    protected $votingRecord;

    public function __construct()
    {
        $this->candidate = new MCandidate();
        $this->candidateGroup = new MCandidateGroup();
        $this->election = new MElection();
        $this->votingRecord = new MVotingRecords();
    }
    public function index()
    {
        $data["candidate"] = $this->candidate->select('id, nis, name, photo')->findAll();

        $data["candidateGroup"] = $this->candidateGroup->select([
            "candidate_group.id",
            "alias",
            "vision",
            "mission",
            "cp.name as chairperson",
            "vcp.name as vice_chairperson",
            "cp.photo as cp_photo",
            "vcp.photo as vcp_photo"
        ])->join("candidate cp", "candidate_group.cp_id = cp.id", "left")->join("candidate vcp", "candidate_group.vcp_id = vcp.id", "left")->findAll();

        return view("admin/candidate_group/V_Candidate_Group", $data);
    }

    public function store()
    {
        $req = $this->request->getPost();

        $validation = \Config\Services::validation();

        $rules = [
            'cp-id' => [
                'rules' => 'required|numeric',
            ],
            'vcp-id' => [
                'rules' => 'required|numeric',
            ],
            'alias' => [
                'rules' => 'required|min_length[2]|max_length[28]',
            ],
            'vision' => [
                'rules' => 'required|min_length[2]',
            ],
            'mission' => [
                'rules' => 'required|min_length[2]',
            ],
            'election-id' => [
                'rules' => 'required|numeric',
            ]
        ];

        if (! $this->validate($rules)) {
            // Jika gagal → redirect back dengan flashdata
            if (! $this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
        }

        $data = [
            "cp_id" => $req['cp-id'],
            "vcp_id" => $req['vcp-id'],
            "election_id" => $req['election-id'],
            "alias" => $req['alias'],
            "vision" => $req['vision'],
            "mission" => $req['mission']
        ];

        $this->candidateGroup->insert($data);

        return redirect()->to('/admin/candidate-group')->with('success', 'Data berhasil disimpan');
    }

    public function delete($id)
    {
        // Dapatkan candidateGroup
        $cg = $this->candidateGroup->find($id);

        if (empty($cg)) {
            // throw 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            exit;
        }

        // Dapatkan election
        $election = $this->election->find($cg["election_id"]);

        // cek apakah pemilihan sedang berlangsung?
        if ($election["status"] == "open") {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Pemilihan sedang berlangsung',
            ]);
        }

        // cek apakah voting record 0?
        $votingRecordCount = $this->votingRecord->where("group_id", $id)->countAllResults();
        if ($votingRecordCount >= 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'paslon sudah ada yang memilih',
            ]);
        }

        // Hapus paslon
        $this->candidateGroup->delete($id);
    }
}
