<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\MParticipant;

class Auth extends BaseController
{
    protected $participant;

    public function __construct()
    {
        $this->participant = new MParticipant();
    }

    public function loginParticipant()
    {
        return view('participant/V_Login');
    }

    public function processParticipant()
    {
        $req = $this->request->getPost();

        $user = $this->participant->where("nisn", $req["identity"])->orWhere("username", $req["identity"])->first();

        if (empty($user)) {
            return redirect()->to("login/participant")->with('msg', "<script>Swal.fire('Akun Tidak Ditemukan', 'NISN atau username tidak ditemukan', 'error')</script>");
        }

        if (!password_verify($req["password"], $user["password"])) {
            return redirect()->to("login/participant")->with('msg', "<script>Swal.fire('Kata Sandi Salah', 'Harap coba lagi', 'error')</script>");
        }

        session()->set([
            "participant_id" => $user["id"]
        ]);

        return redirect()->to("election");
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to("login/participant");
    }
}
