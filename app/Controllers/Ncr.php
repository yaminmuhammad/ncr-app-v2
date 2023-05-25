<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NcrModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;

class Ncr extends BaseController
{
    protected $ncrModel;
    protected $email;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->ncrModel = new NcrModel();
        $this->email = \Config\Services::email();
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
            'temporary_action' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi'
                ]
            ],
            'oty' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi'
                ]
            ],
            'standar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi'
                ]
            ],
            'aktual' => [
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
            'temporary_action' => $this->request->getVar('temporary_action'),
            'oty' => $this->request->getVar('oty'),
            'standar' => $this->request->getVar('standar'),
            'aktual' => $this->request->getVar('aktual'),
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
        $status_count  = $this->ncrModel->getStatusCount();
        $data = [
            'title' => 'Daftar Laporan NCR',
            'ncr' => $ncr,
            'total_rows' => $total_rows,
            'status_count' => $status_count,
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

    public function update_ncr($id)
    {
        $ncrLama = $this->ncrModel->getNcr($id);
        if ($ncrLama['status'] == "PENDING") {
            $data = [
                'title' => 'Update Laporan NCR',
                'id_ncr' =>  $this->ncrModel->getNcr($id)
            ];
            if ($this->request->getMethod() == 'post') {
                $this->ncrModel->save([
                    'id' => $id,
                    'status' => $this->request->getVar('status')
                ]);
                session()->setFlashdata('pesan', 'Status Berhasil Diubah');
                return redirect()->to('/home');
            } else {
                return view('ncr/detail_ncr_view', $data);
            }
        } else {
            session()->setFlashdata('pesan-error', 'Status Tidak Bisa Diubah Lebih Dari Sekali');
            return redirect()->to('/home');
        }
    }

    // public function printToExcel($id)
    // {
    //     $data = $this->ncrModel->find($id);

    //     $spreadsheet = IOFactory::load(ROOTPATH . 'public/templates/template.xlsx');

    //     // Set the worksheet title
    //     $sheet = $spreadsheet->getActiveSheet();


    //     $sheet
    //         ->setCellValue('AO2', 'Tanggal :' . date('d F Y'))
    //         ->setCellValue('L43', 'Temporary / Correction Action :  ' . $data['temporary_action'])
    //         ->setCellValue('L41',  $data['aktual'])
    //         ->setCellValue('P41',  $data['standar'])
    //         ->setCellValue('G40', ' :  ' . $data['problem'])
    //         ->setCellValue('H12', ':         ' . $data['departemen_tujuan'])
    //         ->setCellValue('G45', ':  ' . $data['qty'] . '  ' . $data['satuan']);

    //     $sheet->mergeCells("E22:E26");
    //     $imagePath = 'img_uploaded/' . $data['foto'];

    //     // Check if the image file exists
    //     if (file_exists($imagePath)) {
    //         // Add the image to the worksheet
    //         $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    //         $drawing->setPath($imagePath);
    //         $drawing->setWidth(900);
    //         $drawing->setHeight(400);
    //         $drawing
    //             // ->setOffsetY(30)
    //             // ->setOffsetX(30)
    //             ->setCoordinates('E22');

    //         $drawing->setWorksheet($sheet);
    //     }

    //     // Set the header content type and attachment filename
    //     $filename = 'ncr_report_' . date('Y-m-d') . $data['id'] . '.xlsx';
    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="' . $filename . '"');
    //     header('Cache-Control: max-age=0');

    //     // Write the Spreadsheet object to output
    //     $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    //     $writer->save('php://output');
    // }

    public function printToExcel($id)
    {
        $data = $this->ncrModel->find($id);

        $templatePath = ROOTPATH . 'public/templates/template.xlsx';

        // Check if the template file exists
        if (!file_exists($templatePath)) {
            // Handle file not found error
            return 'Template file not found';
        }

        $spreadsheet = IOFactory::load($templatePath);

        // Set the worksheet title
        $sheet = $spreadsheet->getActiveSheet();

        $sheet
            ->setCellValue('AO2', 'Tanggal :' . date('d F Y'))
            ->setCellValue('L43', 'Temporary / Correction Action :  ' . htmlspecialchars($data['temporary_action']))
            ->setCellValue('L41', $data['aktual'])
            ->setCellValue('P41', $data['standar'])
            ->setCellValue('G40', ' :  ' . htmlspecialchars($data['problem']))
            ->setCellValue('H12', ':         ' . htmlspecialchars($data['departemen_tujuan']))
            ->setCellValue('G45', ':  ' . $data['qty'] . '  ' . $data['satuan']);

        $sheet->mergeCells("E22:E26");
        $imagePath = 'img_uploaded/' . $data['foto'];

        // Check if the image file exists
        if (file_exists($imagePath)) {
            // Add the image to the worksheet
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setPath($imagePath);
            $drawing->setWidth(900);
            $drawing->setHeight(400);
            $drawing->setCoordinates('E22');

            $drawing->setWorksheet($sheet);
        }

        // Set the header content type and attachment filename
        $filename = 'ncr_report_' . date('Y-m-d') . $data['id'] . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Write the Spreadsheet object to output
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }



    public function sendEmail($id)
    {
        // $data = $this->ncrModel->find($id);
        $this->email->setFrom('yaminzaman5@gmail.com', 'YaminZaman');
        $this->email->setTo('yaminzaman5@gmail.com');

        $this->email->setSubject('Test Email');
        $this->email->setMessage('<h1>Test Email <p>Ini tes Email. Silahkan klik <a href="' .  site_url('home/' . $id) . '">link ini</a> untuk mengunjungi halaman utama aplikasi.</p></h1>');

        if (!$this->email->send()) {
            session()->setFlashdata('pesan-error', 'Email Gagal Dikirim');
            return redirect()->to('/home');
        } else {
            session()->setFlashdata('pesan', 'Email Berhasil Dikirim');
            return redirect()->to('/home');
        }
        $this->email->send();
    }
}
