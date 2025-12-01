<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\MVotingRecords;

use App\Models\MCandidateGroup;
use App\Models\MElection;

class Election extends BaseController
{
    protected $candidateGroup;
    protected $votingRecord;
    protected $participantId;
    protected $election;

    public function __construct()
    {
        $this->candidateGroup = new MCandidateGroup();
        $this->votingRecord = new MVotingRecords();
        $this->participantId = session()->get('participant_id');
        $this->election = new MElection();
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {

        // cek apakah partisipan sudah memilih?
        $userHasVote = $this->votingRecord->where("participant_id", $this->participantId)->countAllResults();

        if ($userHasVote > 0) {
            return view('election/V_Success_Submit');
        } else {

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

            return view('election/V_Election', $data);
        }
    }

    public function saveElection()
    {
        $req = $this->request->getPost();

        $this->votingRecord->insert([
            "group_id" => $req["candidateId"],
            "participant_id" => $this->participantId,
            "created_at" => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Suara berhasil disimpan',
            'data' => $req
        ]);
    }
}
