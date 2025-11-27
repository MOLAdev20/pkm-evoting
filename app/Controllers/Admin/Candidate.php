<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\MCandidate;

class Candidate extends BaseController
{
    protected $candidate;
    public function __construct()
    {
        $this->candidate = new MCandidate();
    }

    public function index()
    {
        $candidate = $this->candidate->findAll();

        // return $this->response->setJSON($candidate);
        return view("admin/candidate/V_Candidate", ["candidate" => $candidate]);
    }

    public function new()
    {
        return view("admin/candidate/V_Create_Candidate");
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
            'birth-date' => [
                'rules' => 'required|valid_date',
            ],
            'class-name' => [
                'rules' => 'required|min_length[2]|max_length[20]',
            ],
            'bio' => [
                'rules' => 'permit_empty|max_length[2000]',
            ],
            'video-url' => [
                'rules' => 'permit_empty|valid_url',
            ],

            /* ----------------------
         * FOTO KANDIDAT
         * ----------------------*/
            'photo' => [
                'rules' => 'uploaded[photo]'
                    . '|is_image[photo]'
                    . '|mime_in[photo,image/jpg,image/jpeg,image/png]'
                    . '|max_size[photo,2048]', // max 2MB
                'errors' => [
                    'uploaded'  => 'Foto kandidat wajib diupload.',
                    'is_image'  => 'File harus berupa gambar.',
                    'mime_in'   => 'Format gambar harus JPG atau PNG.',
                    'max_size'  => 'Ukuran foto maksimal 2MB.',
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            // Jika gagal → redirect back dengan flashdata
            if (! $this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
        }


        /** -----------------------------------
         * UPLOAD FOTO
         * -----------------------------------*/
        $photo = $this->request->getFile('photo');

        // random string
        $randomString = bin2hex(random_bytes(10));

        // Generate nama random biar aman
        $newName = "CND" . $randomString . "." . $photo->getExtension();

        // Simpan ke folder public/uploads/candidates
        $photo->move('uploads/candidates', $newName);


        /** -----------------------------------
         * INPUT DATA LAINNYA
         * -----------------------------------*/
        $data = [
            'nis'       => $this->request->getPost('nisn'),
            'name'       => $this->request->getPost('name'),
            'gender'     => $this->request->getPost('gender'),
            'birth_date' => $this->request->getPost('birth-date'),
            'photo'      => $newName,
            'class'      => $this->request->getPost('class-name'),
            'bio'        => $this->request->getPost('bio', FILTER_UNSAFE_RAW),
            'video_url'  => $this->request->getPost('video-url'),
        ];

        $this->candidate->insert($data);

        return redirect()->to('admin/candidate/new')
            ->with('success', "<script>swal.fire('Selamat!', 'Kandidat berhasil ditambahkan!', 'success')</script>");
    }
}
