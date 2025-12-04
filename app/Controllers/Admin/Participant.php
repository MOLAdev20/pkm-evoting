<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Models\MParticipant;
use App\Models\MVotingRecords;

class Participant extends BaseController
{
    protected $participant;
    protected $votingRecords;
    public function __construct()
    {
        $this->participant = new MParticipant();
        $this->votingRecords = new MVotingRecords();
    }

    public function index()
    {
        if ($this->request->getGet("find")) {
            $find = $this->request->getGet("find");
            $this->participant->like("name", $find)->orLike("nisn", $find)->orLike("class", $find);
        }
        $status = empty($this->request->getGet("status")) || $this->request->getGet("status") == "active" ? 1 : 0;

        $this->participant->where("status", $status);

        $data["participant"] = $this->participant->paginate(30);
        $data["pager"] = $this->participant->pager;
        $data["entryYears"] = $this->participant->select("entry_year")->where("entry_year <=", date('Y') - 3)->orderBy("entry_year", "DESC")->distinct()->findAll();
        $data["find"] = $this->request->getGet("find") ?? "";
        $data["filterStatus"] = $status;

        // Statistik
        $data["totalParticipantActive"] = $this->participant->where("status", 1)->countAllResults();
        $data["totalParticipantInactive"] = $this->participant->where("status", 0)->countAllResults();

        return view("admin/participant/V_Participant", $data);
    }

    public function detail($id)
    {
        $data["participant"] = $this->participant->find($id);

        if (empty($data["participant"])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data["electionHistory"] = $this->votingRecords->select([
            "election.title",
            "election.start_at",
            "election.end_at",
            "election.status",
            "candidate_group.alias",
            "cp.name as chairperson",
            "vcp.name as vice_chairperson",
        ])->join("election", "election.id = voting_records.election_id")
            ->join("candidate_group", "candidate_group.id = voting_records.group_id")
            ->join("candidate cp", "cp.id = candidate_group.cp_id")
            ->join("candidate vcp", "vcp.id = candidate_group.vcp_id")
            ->where("voting_records.participant_id", $id)->findAll();

        return view("admin/participant/V_Detail_Participant", $data);
    }

    public function new()
    {
        return view("admin/participant/V_Create_Participant");
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'nisn' => [
                'rules' => 'required|numeric|min_length[5]|max_length[20]',
            ],
            'name' => [
                'rules' => 'required|min_length[3]|max_length[100]',
            ],
            'gender' => [
                'rules' => 'required|in_list[l,p]',
            ],
            'class' => [
                'rules' => 'required|min_length[3]|max_length[64]',
            ],
            'username' => [
                'rules' => 'required|min_length[2]|max_length[64]',
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[64]',
            ]
        ];

        if (! $this->validate($rules)) {
            // Jika gagal → redirect back dengan flashdata
            if (! $this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
        }

        /** -----------------------------------
         * INPUT DATA LAINNYA
         * -----------------------------------*/
        $data = [
            'nisn'   => $this->request->getPost('nisn'),
            'name' => $this->request->getPost('name'),
            'gender'    => $this->request->getPost('gender'),
            'class'     => $this->request->getPost('class'),
            'username'      => $this->request->getPost('username'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'created_at'        => date("Y-m-d H:i:s"),
            'updated_at'  => date("Y-m-d H:i:s"),
        ];

        $this->participant->insert($data);

        return redirect()->to('admin/participant/new')
            ->with('success', "<script>swal.fire('Selamat!', 'Siswa berhasil ditambahkan!', 'success')</script>");
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();

        $rules = [
            'nisn' => [
                'rules' => 'required|numeric|min_length[5]|max_length[20]',
            ],
            'name' => [
                'rules' => 'required|min_length[3]|max_length[100]',
            ],
            'gender' => [
                'rules' => 'required|in_list[l,p]',
            ],
            'class' => [
                'rules' => 'required|min_length[3]|max_length[64]',
            ],
            'username' => [
                'rules' => 'required|min_length[2]|max_length[64]',
            ]
        ];

        if (! $this->validate($rules)) {
            // Jika gagal → redirect back dengan flashdata
            if (! $this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
        }

        /** -----------------------------------
         * INPUT DATA LAINNYA
         * -----------------------------------*/
        $data = [
            'nisn'   => $this->request->getPost('nisn'),
            'name' => $this->request->getPost('name'),
            'gender'    => $this->request->getPost('gender'),
            'class'     => $this->request->getPost('class'),
            'username'      => $this->request->getPost('username'),
            'updated_at'  => date("Y-m-d H:i:s"),
        ];

        $this->participant->set($data)->where('id', $id)->update();

        return redirect()->to('admin/participant/detail/' . $id)
            ->with('msg', "<script>swal.fire('Data Siswa Diperbarui!', 'Siswa berhasil diedit!', 'success')</script>");
    }

    public function import()
    {
        $file = $this->request->getFile('excel');

        $validationRules = [
            'excel' => [
                'rules' => 'uploaded[excel]|ext_in[excel,xls,xlsx]|max_size[excel,2048]',
                'errors' => [
                    'uploaded' => 'Please upload an Excel file.',
                    'ext_in'   => 'Only .xls and .xlsx files are allowed.',
                    'max_size' => 'File size cannot exceed 2MB.'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => $this->validator->getErrors()
            ]);
        }

        $reader = IOFactory::load($file->getTempName());
        $sheet = $reader->getActiveSheet()->toArray();

        $db = \Config\Database::connect();
        $db->transBegin(); // START TRANSACTION

        try {

            for ($i = 1; $i < count($sheet); $i++) {

                $this->participant->insert([
                    "nisn" => $sheet[$i][0],
                    "name" => $sheet[$i][1],
                    "gender" => $sheet[$i][2],
                    "class" => $sheet[$i][3],
                    "username" => $sheet[$i][4],
                    "password" => password_hash($sheet[$i][5], PASSWORD_DEFAULT),
                    "entry_year" => $sheet[$i][6],
                    "status" => 1,
                    "created_at" => date('Y-m-d H:i:s'),
                    "updated_at" => date('Y-m-d H:i:s'),
                ]);
            }

            // If everything OK
            if ($db->transStatus() === FALSE) {
                $db->transRollback();
                return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)->setJSON([
                    'status' => false,
                    'message' => 'Database Error: Insert failed'
                ]);
            }

            $db->transCommit(); // SAVE all changes

            return $this->response->setJSON([
                'status' => true,
                'message' => 'All data imported successfully'
            ]);
        } catch (\Throwable $e) {

            // ANY PHP / DB ERRORS → rollback
            $db->transRollback();

            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)->setJSON([
                'status' => false,
                'message' => 'Error occurred during import',
                'error' => $e->getMessage(),
            ]);
        }
    }

    // Method untuk menonaktifkan angkatan
    public function deactivatedEntryYear()
    {
        $entryYear = $this->request->getPost('entry_year');

        // Validasi
        if ($entryYear <= date('Y') - 3) {
            $this->participant->set("status", 0)->where("entry_year", $entryYear)->update();
            return redirect()->to("admin/participant")->with('msg', "<script>Swal.fire('Angkatan Dinonaktifkan', 'Siswa dengan angkatan {$entryYear} berhasil dinonaktifkan', 'success')</script>");
        } else {
            return redirect()->to("admin/participant")->with('msg', "<script>Swal.fire('Gagal Menonaktifkan', 'Angkatan {$entryYear} belum waktunya lulus', 'warning')</script>");
        }
    }

    public function changeStatus($id)
    {
        $status = $this->request->getPost('status');
        $this->participant->set("status", $status)->where("id", $id)->update();
        return redirect()->to("admin/participant/detail/{$id}")->with('msg', "<script>Swal.fire('Status Di'" . ($status == 1 ? "aktifkan" : "nonaktifkan") . ", 'Status siswa berhasil diperbarui', 'success')</script>");
    }
}
