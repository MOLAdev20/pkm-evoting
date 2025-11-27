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
