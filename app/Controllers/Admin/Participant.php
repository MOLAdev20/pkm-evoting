<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Models\MParticipant;

class Participant extends BaseController
{
    protected $participant;
    public function __construct()
    {
        $this->participant = new MParticipant();
    }

    public function index()
    {
        $data["participant"] = $this->participant->findAll();
        $data["totalParticipant"] = $this->participant->countAll();

        return view("admin/participant/V_Participant", $data);
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
                    "password" => $sheet[$i][5],
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
}
