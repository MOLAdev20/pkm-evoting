<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\MCandidateGroup;
use App\Models\MCandidate;


class CandidateGroup extends BaseController
{
    protected $candidate;
    protected $candidateGroup;

    public function __construct()
    {
        $this->candidate = new MCandidate();
        $this->candidateGroup = new MCandidateGroup();
    }
    public function index()
    {
        $candidates = $this->candidate->select('id, nis, name, photo')->findAll();


        return view("admin/candidate_group/V_Candidate_Group", ['candidate' => $candidates]);
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
            "alias" => $req['alias'],
            "vision" => $req['vision'],
            "mission" => $req['mission']
        ];

        $this->candidateGroup->insert($data);

        return redirect()->to('/admin/candidate-group')->with('success', 'Data berhasil disimpan');
    }
}
