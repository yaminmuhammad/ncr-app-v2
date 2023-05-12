<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NcrModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    public function printToExcel($id)
    {
        $data = $this->ncrModel->find($id);

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set the worksheet title
        $worksheet = $spreadsheet->getActiveSheet();
        $worksheet->setTitle('NCR Report');


        // Set the column widths
        $worksheet->getColumnDimension('A')->setWidth(5);
        $worksheet->getColumnDimension('B')->setWidth(50);
        $worksheet->getColumnDimension('C')->setWidth(25);
        $worksheet->getColumnDimension('D')->setWidth(25);
        $worksheet->getColumnDimension('E')->setWidth(25);
        $worksheet->getColumnDimension('F')->setWidth(25);
        $worksheet->getColumnDimension('G')->setWidth(25);
        $worksheet->getColumnDimension('H')->setWidth(25);
        $worksheet->getColumnDimension('I')->setWidth(25);

        // Set the row heights
        $worksheet->getRowDimension('1')->setRowHeight(30);
        $worksheet->getRowDimension('2')->setRowHeight(100);

        // Set the column headers
        $worksheet->setCellValue('A1', 'No.')
            ->setCellValue('B1', 'Problem')
            ->setCellValue('C1', 'Area')
            ->setCellValue('D1', 'Qty')
            ->setCellValue('E1', 'Satuan')
            ->setCellValue('F1', 'Departemen Tujuan')
            ->setCellValue('G1', 'Jenis')
            ->setCellValue('H1', 'Status')
            ->setCellValue('I1', 'Foto');

        // Style the Header Row 
        $styleArrayHeader = [
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['argb' => 'FFAOAOAO'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];
        $worksheet->getStyle('A1:I1')->applyFromArray($styleArrayHeader);

        // Style data rows
        $styleArrayData = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
                'textRotation' => 0,
            ],
        ];

        // Fill in the data rows
        $row = 2;
        $worksheet->getStyle('A2:H' . ($row - 1))->applyFromArray($styleArrayData);
        $worksheet->setCellValue('A' . $row, $row - 1)
            ->setCellValue('B' . $row, $data['problem'])
            ->setCellValue('C' . $row, $data['area'])
            ->setCellValue('D' . $row, $data['qty'])
            ->setCellValue('E' . $row, $data['satuan'])
            ->setCellValue('F' . $row, $data['departemen_tujuan'])
            ->setCellValue('G' . $row, $data['jenis'])
            ->setCellValue('H' . $row, $data['status']);

        // Center align the cell contents
        $cellRange = 'A' . $row . ':I' . $row;
        $worksheet->getStyle($cellRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle($cellRange)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $imagePath = 'img_uploaded/' . $data['foto'];

        // Check if the image file exists
        if (file_exists($imagePath)) {
            // Add the image to the worksheet
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setPath($imagePath);
            $drawing->setWidth(120);
            $drawing->setHeight(120);
            $drawing->setOffsetX(10)
                ->setOffsetY(10)
                ->setCoordinates('I' . $row);
            $drawing->setWorksheet($worksheet);
        }

        // Set the header content type and attachment filename
        $filename = 'ncr_report_' . date('Y-m-d') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Write the Spreadsheet object to a file
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function sendEmail($id)
    {
        $data = $this->ncrModel->find($id);
        $this->email->setFrom('yaminzaman5@gmail.com', 'YaminZaman');
        $this->email->setTo('yaminzaman5@gmail.com');

        $this->email->setSubject('Test Email');
        $this->email->setMessage('<h1>Test Email <p>Ini tes Email. Silahkan klik <a href="' .  site_url('home/' . $id) . '">link ini</a> untuk mengunjungi halaman utama aplikasi.</p></h1>');

        if (!$this->email->send()) {
            echo 'Email Tidak Terkirim';
        } else {
            echo 'Email Berhasil Terkirim';
        }
        $this->email->send();
    }
}
