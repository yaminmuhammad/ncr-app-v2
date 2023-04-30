<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Ncrproduct;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;

class Product extends BaseController
{
    protected $ncrProduct;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->ncrProduct = new Ncrproduct();
    }

    public function create_product()
    {
        session();
        $data = [
            'title' => 'Form Tambah Data Report',
        ];
        return view('form_product_view', $data);
    }

    public function index_product()
    {
        $product = $this->ncrProduct->findAll();
        $data = [
            'title' => 'Daftar Laporan NCR Product',
            'product' => $product
        ];
        return view('report/index_product_view', $data);
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
            'departemen' => [
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
            // $validation = \Config\Services::validation();

            return redirect()->to('/form_product')->withInput();
        }

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
        $this->ncrProduct->save([
            'problem' => $this->request->getVar('problem'),
            'area' => $this->request->getVar('area'),
            'qty' => $this->request->getVar('qty'),
            'departemen' => $this->request->getVar('departemen'),
            'foto' => $namaFoto
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/form_product');
    }

    public function export()
    {
        $phpWord = new PhpWord();
        $phpWord->addTitleStyle(1, ['size' => 16, 'bold' => true, 'name' => 'Arial', 'allCaps' => true], ['alignment' => 'center']);
        $section = $phpWord->addSection(['orientation' => 'landscape']);
        $section->addTitle('Laporan NCR Product');
        $section->addTextBreak();
        $table = $section->addTable(['borderSize' => 3]);
        $table->addRow();
        $table->addCell(1000)->addText('No', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);
        $table->addCell(5000)->addText('Problem', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);
        $table->addCell(5000)->addText('Area', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);
        $table->addCell(5000)->addText('Qty', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);
        $table->addCell(5000)->addText('Departemen', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);
        $table->addCell(5000)->addText('Tanggal/Waktu dibuat', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);
        $table->addCell(5000)->addText('Foto', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);

        $data = $this->ncrProduct->findAll();
        $no = 1;
        foreach ($data as $item) {
            $table->addRow();
            $table->addCell()->addText($no, [], ['alignment' => 'center']);
            $table->addCell()->addText($item['problem']);
            $table->addCell()->addText($item['area'], [], ['alignment' => 'center']);
            $table->addCell()->addText($item['qty'], [], ['alignment' => 'center']);
            $table->addCell()->addText($item['departemen'], [], ['alignment' => 'center']);
            $table->addCell()->addText($item['created_at'], [], ['alignment' => 'center']);
            $table->addCell()->addImage('img_uploaded/' . $item['foto'], [
                'width' => 100,
                'height' => 100,
                'align' => 'center',
            ]);
            $no++;
        }

        $writer = new Word2007($phpWord);

        header('Content-Type: application/msword');
        header('Content-Disposition: attachment;filename="Laporan NCR Product.docx"');
        header('Cache-Control: max-age=0');

        $writer->save("php://output");
        exit();
    }

    public function exportid($id)
    {
        $phpWord = new PhpWord();
        $data = $this->ncrProduct->find($id);
        $phpWord->addTitleStyle(1, ['size' => 16, 'bold' => true, 'name' => 'Arial', 'allCaps' => true], ['alignment' => 'center']);
        $section = $phpWord->addSection(['orientation' => 'landscape']);
        $section->addTitle('Detail Laporan NCR Product');
        $section->addTextBreak();
        $table = $section->addTable(['borderSize' => 3]);
        $table->addRow();
        $table->addCell(5000)->addText('Problem', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);
        $table->addCell(5000)->addText('Area', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);
        $table->addCell(5000)->addText('Quantity', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);
        $table->addCell(5000)->addText('Departemen', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);
        $table->addCell(5000)->addText('Tanggal/Waktu dibuat', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);
        $table->addCell(5000)->addText('Foto', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);

        $table->addRow();
        $table->addCell()->addText($data['problem']);
        $table->addCell()->addText($data['area'], [], ['alignment' => 'center']);
        $table->addCell()->addText($data['qty'], [], ['alignment' => 'center']);
        $table->addCell()->addText($data['departemen'], [], ['alignment' => 'center']);
        $table->addCell()->addText($data['created_at'], [], ['alignment' => 'center']);
        $table->addCell()->addImage('img_uploaded/' . $data['foto'], [
            'width' => 100,
            'height' => 100,
            'align' => 'center',
        ]);

        $writer = new Word2007($phpWord);

        header('Content-Type: application/msword');
        header('Content-Disposition: attachment;filename="Laporan NCR Process.docx"');
        header('Cache-Control: max-age=0');

        $writer->save("php://output");
        exit();
    }
}
