<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_Login;

class Login extends BaseController
{
    protected $M_Login;
    protected $session;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->M_Login = new M_Login();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('login', $data);
    }

    public function auth()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'npk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NPK harus diisi'
                ]
            ]
        ])) {
            return redirect()->to(base_url('login'))->withInput();
        }

        $nama = $this->request->getPost('nama');
        $npk = $this->request->getPost('npk');
        $cek = $this->M_Login->cek_login($nama, $npk);
        if (!empty($cek)) {
            $session_data = [
                'nama' => $cek['nama'],
                'npk' => $cek['npk'],
                'is_login' => true
            ];
            $this->session->set($session_data);
            $this->session->setFlashdata('pesan', 'Login Berhasil');
            return redirect()->to(base_url('home'));
        } else {
            $this->session->setFlashdata('pesan', 'Nama atau NPK salah');
            return redirect()->to(base_url('login'));
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('login'));
    }
}
