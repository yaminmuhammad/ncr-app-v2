<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NcrModel;

class Ncr extends BaseController
{
    protected $ncrModel;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->ncrModel = new NcrModel();
    }

    public function create_ncr()
    {
        session();
        $data = [
            'title' => 'Create NCR',
        ];
        return view('ncr/form_ncr_view', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'problem' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi'
                ]
            ],
            'area' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi'
                ]
            ],
            'qty' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi'
                ]
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi'
                ]
            ],
            'departemen_tujuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi'
                ]
            ],
            'jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi'
                ]
            ],
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/ncr_form')->withInput();
        };

        // ambil foto 
        $fileFoto = $this->request->getFile('foto');
        // apakah tidak ada foto yang diupload
        if ($fileFoto->getError() == 4) {
            $namaFoto = 'default.jpg';
        } else {
            // generate nama file random
            $namaFoto = $fileFoto->getName();
            // pindahkan file ke folder img
            $fileFoto->move('img_uploaded', $namaFoto);
        }


        // insert data
        $this->ncrModel->save([
            'problem' => $this->request->getVar('problem'),
            'area' => $this->request->getVar('area'),
            'qty' => $this->request->getVar('qty'),
            'satuan' => $this->request->getVar('satuan'),
            'departemen_tujuan' => $this->request->getVar('departemen_tujuan'),
            'jenis' => $this->request->getVar('jenis'),
            'foto' => $namaFoto,
            'status' => "PENDING"
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/ncr_form');
    }

    public function index_ncr()
    {
        $ncr = $this->ncrModel->findAll();
        $total_rows = $this->ncrModel->countRows();
        $data = [
            'title' => 'Daftar Laporan NCR',
            'ncr' => $ncr,
            'total_rows' => $total_rows
        ];
        return view('home', $data);
    }

    public function detail_ncr($id)
    {

        $data = [
            'title' => 'Detail Laporan NCR',
            'id_ncr' =>  $this->ncrModel->getNcr($id)
        ];
        if (empty($data['id_ncr'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('id NCR tidak ditemukan');
        }
        return view('ncr/detail_ncr_view', $data);
    }
}
