<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NcrModel;
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

    public function printToWord($id)
    {
        $phpWord = new PhpWord();
        $data = $this->ncrModel->find($id);
        $phpWord->addTitleStyle(1, ['size' => 16, 'bold' => true, 'name' => 'Arial', 'allCaps' => true], ['alignment' => 'center']);
        $section = $phpWord->addSection(['orientation' => 'landscape']);
        $section->addTitle('Detail Laporan NCR Process');
        $section->addTextBreak();
        $table = $section->addTable(['borderSize' => 3]);


        // Tambahkan baris pertama dengan 3 kolom terpisah
        $row = $table->addRow();
        $row->addCell(2000, ['vMerge' => 'restart'])->addImage('assets/images/logo.png',  [
            'width' => 100,
            'height' => 50,
            'align' => 'center',
        ]);
        $row->addCell(5000, ['gridSpan' => 2])->addText('Non Conformity Report', [], ['alignment' => 'center']);
        $row->addCell(2500)->addText('Tanggal :' . date('d-F-Y'));

        $row = $table->addRow();
        $row->addCell(2000, ['vMerge' => 'continue']);
        $row->addCell(2000)->addCheckBox('sbd', 'adj', [], []);
        $row->addCell(2000)->addText('Kolom Keenam');

        $row = $table->addRow();
        $row->addCell(2000, ['gridSpan' => 3])->addText('Kolom Pertama dan Keempat');
        $row->addCell(2000)->addText('Kolom Ketujuh');
        $writer = new Word2007($phpWord);

        header('Content-Type: application/msword');
        header('Content-Disposition: attachment;filename="Laporan NCR Process.docx"');
        header('Cache-Control: max-age=0');

        $writer->save("php://output");
        exit();
    }
    // public function printToWord($id)
    // {
    //     // $phpWord = new \PhpOffice\PhpWord\PhpWord();
    //     // $section = $phpWord->addSection();
    //     // $section->addText('Hello World');
    //     // $filename = 'ncr_report_' . date('Y-m-d') . '.docx';
    //     // header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    //     // header('Content-Disposition: attachment;filename="' . $filename . '"');
    //     // header('Cache-Control: max-age=0');
    //     // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    //     // $objWriter->save('php://output');
    //     // exit;
    //     $phpWord = new PhpWord();
    //     $data = $this->ncrModel->find($id);
    //     $phpWord->addTitleStyle(1, ['size' => 16, 'bold' => true, 'name' => 'Arial', 'allCaps' => true], ['alignment' => 'center']);
    //     $section = $phpWord->addSection(['orientation' => 'landscape']);
    //     $section->addTitle('Detail Laporan NCR Process');
    //     $section->addTextBreak();
    //     $table = $section->addTable(['borderSize' => 3]);
    //     $table->addRow();
    //     $table->addCell(5000)->addText('Problem', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);
    //     $table->addCell(5000)->addText('Area', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);
    //     $table->addCell(5000)->addText('Quantity', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);
    //     $table->addCell(5000)->addText('Departemen', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);
    //     $table->addCell(5000)->addText('Tanggal/Waktu dibuat', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);
    //     $table->addCell(5000)->addText('Foto', ['allCaps' => true, 'bold' => true,], ['alignment' => 'center']);

    //     $table->addRow();
    //     $table->addCell()->addText($data['problem']);
    //     $table->addCell()->addText($data['area'], [], ['alignment' => 'center']);
    //     $table->addCell()->addText($data['qty'], [], ['alignment' => 'center']);
    //     $table->addCell()->addText($data['departemen_tujuan'], [], ['alignment' => 'center']);
    //     $table->addCell()->addText($data['created_at'], [], ['alignment' => 'center']);
    //     $table->addCell()->addImage('img_uploaded/' . $data['foto'], [
    //         'width' => 100,
    //         'height' => 100,
    //         'align' => 'center',
    //     ]);

    //     $writer = new Word2007($phpWord);

    //     header('Content-Type: application/msword');
    //     header('Content-Disposition: attachment;filename="Laporan NCR Process.docx"');
    //     header('Cache-Control: max-age=0');

    //     $writer->save("php://output");
    //     exit();
    // }

    public function printToExcel($id)
    {
        $data = $this->ncrModel->find($id);

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set the worksheet title
        $worksheet = $spreadsheet->getActiveSheet();
        $worksheet->setTitle('NCR Report');


        // Set the column widths

        $worksheet->getColumnDimension('B')->setWidth(50);
        $worksheet->getColumnDimension('C')->setWidth(50);
        $worksheet->getColumnDimension('D')->setWidth(50);
        $worksheet->getColumnDimension('E')->setWidth(25);
        $worksheet->getColumnDimension('F')->setWidth(25);
        $worksheet->getColumnDimension('G')->setWidth(25);
        $worksheet->getColumnDimension('H')->setWidth(25);
        $worksheet->getColumnDimension('I')->setWidth(25);
        $spreadsheet->getActiveSheet()
            ->mergeCells("A36:D36");
        $spreadsheet->getActiveSheet()
            ->mergeCells("B8:B17");
        $spreadsheet->getActiveSheet()
            ->mergeCells("B1:B6");
        $spreadsheet->getActiveSheet()
            ->mergeCells("C1:C3");
        $spreadsheet->getActiveSheet()
            ->mergeCells("D1:D7");
        $spreadsheet->getActiveSheet()
            ->mergeCells("C4:C7");
        $spreadsheet->getActiveSheet()
            ->mergeCells("C9:C12");
        $spreadsheet->getActiveSheet()
            ->mergeCells("C13:C17");
        $spreadsheet->getActiveSheet()
            ->mergeCells("D9:D12");
        $spreadsheet->getActiveSheet()
            ->mergeCells("D13:D17");
        $spreadsheet->getActiveSheet()
            ->mergeCells("B18:B29");
        $spreadsheet->getActiveSheet()
            ->mergeCells("C18:C29");
        $spreadsheet->getActiveSheet()
            ->mergeCells("D18:D29");

        $worksheet
            ->setCellValue('A31', '1.')
            ->setCellValue('A32', '2.')
            ->setCellValue('A33', '3.')
            ->setCellValue('A34', '4.')
            ->setCellValue('A35', '5.')
            ->setCellValue('B7', 'Di Isi Departemen Penemu/Pembuat')
            ->setCellValue('B30', 'Di Isi Departemen Quality')
            ->setCellValue('B31', 'Hal')
            ->setCellValue('B32', 'Depart. yang dituju')
            ->setCellValue('B33', 'Nama Part/Tipe')
            ->setCellValue('B34', 'Problem yang terjadi di')
            ->setCellValue('B35', 'Frekuensi problem')
            ->setCellValue('C1', 'NON COMFORMITY REPORT')
            ->setCellValue('C8', 'Aktual')
            ->setCellValue('B8', 'Uraian Masalah : ' . $data['problem'])
            ->setCellValue('C9',  $data['aktual'])
            ->setCellValue('D9',  $data['standar'])
            ->setCellValue('C13', 'OTY : ' .  $data['oty'])
            ->setCellValue('C31', ' : ')
            ->setCellValue('C32', ' : ' . $data['departemen_tujuan'])
            ->setCellValue('C33', ' : ')
            ->setCellValue('C34', ' : ' . $data['area'])
            ->setCellValue('C35', ' : ')
            ->setCellValue('D31', ' 6 . Flow terjadinya masalah/Problem lolos next proses : ')
            ->setCellValue('D13', 'Temporary Action : ' .  $data['temporary_action'])
            ->setCellValue('D8', 'Standar');


        $styleJudul = [
            'font' => [
                'color' => [
                    'rgb' => '000000'
                ],
                'bold' => true,
                'size' => 11
            ],
            'fill' => [
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'ffc107'
                ]
            ],
        ];
        $styleBorder = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];
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
        $styleB = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_TOP,
                'wrapText' => true,
                'textRotation' => 0,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];
        $styleB1 = [
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['argb' => 'FFAOAOAO'],
            ],
        ];
        $styleA = [
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['argb' => 'FFAOAOAO'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];
        // Load the image file
        $imagePath = 'assets/images/logo.png';
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setPath($imagePath);

        // Set the coordinates and size of the image

        $drawing->setWidth(100);
        $drawing->setHeight(100);
        $drawing
            ->setOffsetY(20)
            ->setOffsetX(50)
            ->setCoordinates('B1');

        // Add the image to the worksheet
        $drawing->setWorksheet($worksheet);
        $imagePath = 'img_uploaded/' . $data['foto'];

        // Check if the image file exists
        if (file_exists($imagePath)) {
            // Add the image to the worksheet
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setPath($imagePath);
            $drawing->setWidth(200);
            $drawing->setHeight(200);
            $drawing
                ->setOffsetY(20)
                ->setOffsetX(20)
                ->setCoordinates('B18');

            $drawing->setWorksheet($worksheet);
        }
        $worksheet->getStyle('B7')->applyFromArray($styleJudul);
        $worksheet->getStyle('B30')->applyFromArray($styleJudul);
        $worksheet->getStyle('C30:C35')->applyFromArray($styleB1);
        $worksheet->getStyle('D30:D35')->applyFromArray($styleB1);
        $worksheet->getStyle('B31:B35')->applyFromArray($styleB1);
        $worksheet->getStyle('A31:A35')->applyFromArray($styleA);
        $worksheet->getStyle('B8:B17')->applyFromArray($styleB);
        $worksheet->getStyle('B18:B29')->applyFromArray($styleB);
        $worksheet->getStyle('C9:C12')->applyFromArray($styleB);
        $worksheet->getStyle('D9:D12')->applyFromArray($styleB);
        $worksheet->getStyle('C13:C17')->applyFromArray($styleB);
        $worksheet->getStyle('D13:D17')->applyFromArray($styleB);
        $worksheet->getStyle('C8')->applyFromArray($styleArrayHeader);
        $worksheet->getStyle('D8')->applyFromArray($styleArrayHeader);
        $worksheet->getStyle('C1:C3')->applyFromArray($styleArrayHeader);
        $worksheet->getStyle('B1:B29')->applyFromArray($styleBorder);
        $worksheet->getStyle('C1:C29')->applyFromArray($styleBorder);
        $worksheet->getStyle('D1:D29')->applyFromArray($styleBorder);
        // Set the header content type and attachment filename
        $filename = 'ncr_report_' . date('Y-m-d') . $data['id'] . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Write the Spreadsheet object to a file
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
    // public function printToExcel($id)
    // {
    //     $data = $this->ncrModel->find($id);

    //     // Create a new Spreadsheet object
    //     $spreadsheet = new Spreadsheet();

    //     // Set the worksheet title
    //     $worksheet = $spreadsheet->getActiveSheet();
    //     $worksheet->setTitle('NCR Report');


    //     // Set the column widths

    //     $worksheet->getColumnDimension('B')->setWidth(50);
    //     $worksheet->getColumnDimension('C')->setWidth(50);
    //     $worksheet->getColumnDimension('D')->setWidth(50);
    //     $worksheet->getColumnDimension('E')->setWidth(25);
    //     $worksheet->getColumnDimension('F')->setWidth(25);
    //     $worksheet->getColumnDimension('G')->setWidth(25);
    //     $worksheet->getColumnDimension('H')->setWidth(25);
    //     $worksheet->getColumnDimension('I')->setWidth(25);
    //     $spreadsheet->getActiveSheet()
    //         ->mergeCells("B2:B9");
    //     $spreadsheet->getActiveSheet()
    //         ->mergeCells("C3:C5");
    //     $spreadsheet->getActiveSheet()
    //         ->mergeCells("C6:C9");
    //     $spreadsheet->getActiveSheet()
    //         ->mergeCells("D3:D5");
    //     $spreadsheet->getActiveSheet()
    //         ->mergeCells("D6:D9");
    //     $spreadsheet->getActiveSheet()
    //         ->mergeCells("B10:B21");
    //     $spreadsheet->getActiveSheet()
    //         ->mergeCells("C10:C21");
    //     $spreadsheet->getActiveSheet()
    //         ->mergeCells("D10:D28");
    //     $spreadsheet->getActiveSheet()
    //         ->mergeCells("A28:C28");

    //     // Set the column headers
    //     $worksheet
    //         ->setCellValue('C2', 'Aktual')
    //         ->setCellValue('D2', 'Standar')
    //         ->setCellValue('A23', '1')
    //         ->setCellValue('B1', 'Di Isi Departemen Penemu/Pembuat')
    //         ->setCellValue('B22', 'Di Isi Departemen Quality')
    //         ->setCellValue('B23', 'Hal ')
    //         ->setCellValue('A24', '2')
    //         ->setCellValue('B24', 'Depart. yang dituju ')
    //         ->setCellValue('A25', '3')
    //         ->setCellValue('B25', 'Nama Part/Tipe ')
    //         ->setCellValue('A26', '4')
    //         ->setCellValue('B26', 'Problem yang terjadi di ')
    //         ->setCellValue('A27', '5')
    //         ->setCellValue('B27', 'Frekuensi problem ');

    //     // Style the Header Row 
    //     $styleArrayHeader = [
    //         'font' => [
    //             'bold' => true,
    //         ],
    //         'fill' => [
    //             'fillType' => Fill::FILL_SOLID,
    //             'color' => ['argb' => 'FFAOAOAO'],
    //         ],
    //         'borders' => [
    //             'allBorders' => [
    //                 'borderStyle' => Border::BORDER_THIN,
    //                 'color' => ['argb' => '000000'],
    //             ],
    //         ],
    //         'alignment' => [
    //             'horizontal' => Alignment::HORIZONTAL_CENTER,
    //             'vertical' => Alignment::VERTICAL_CENTER,
    //             'wrapText' => true,
    //         ],
    //     ];
    //     $styleA = [
    //         'font' => [
    //             'bold' => true,
    //         ],
    //         'fill' => [
    //             'fillType' => Fill::FILL_SOLID,
    //             'color' => ['argb' => 'FFAOAOAO'],
    //         ],
    //         'alignment' => [
    //             'horizontal' => Alignment::HORIZONTAL_CENTER,
    //             'vertical' => Alignment::VERTICAL_CENTER,
    //             'wrapText' => true,
    //         ],
    //     ];
    //     $styleB1 = [
    //         'font' => [
    //             'bold' => true,
    //         ],
    //         'fill' => [
    //             'fillType' => Fill::FILL_SOLID,
    //             'color' => ['argb' => 'FFAOAOAO'],
    //         ],
    //     ];
    //     $styleArrayNoBorder = [
    //         'borders' => [
    //             'allBorders' => [
    //                 'borderStyle' => Border::BORDER_NONE,
    //             ],
    //         ],
    //     ];
    //     $styleJudul = [
    //         'font' => [
    //             'color' => [
    //                 'rgb' => '000000'
    //             ],
    //             'bold' => true,
    //             'size' => 11
    //         ],
    //         'fill' => [
    //             'fillType' =>  fill::FILL_SOLID,
    //             'startColor' => [
    //                 'rgb' => 'ffc107'
    //             ]
    //         ],

    //     ];
    //     $worksheet->getStyle('C2:D2')->applyFromArray($styleArrayHeader);
    //     $worksheet->getStyle('B1')->applyFromArray($styleJudul);
    //     $worksheet->getStyle('B22')->applyFromArray($styleJudul);
    //     $worksheet->getStyle('A23:A27')->applyFromArray($styleA);
    //     $worksheet->getStyle('B23:B27')->applyFromArray($styleB1);
    //     $worksheet->getStyle('C22:C27')->applyFromArray($styleB1);
    //     $worksheet->getStyle('B10:B21')->applyFromArray($styleArrayNoBorder);
    //     // Style data rows
    //     $styleArrayData = [
    //         'borders' => [
    //             'allBorders' => [
    //                 'borderStyle' => Border::BORDER_THIN,
    //                 'color' => ['argb' => '000000'],
    //             ],
    //         ],
    //         'alignment' => [
    //             'horizontal' => Alignment::HORIZONTAL_LEFT,
    //             'vertical' => Alignment::VERTICAL_TOP,
    //             'wrapText' => true,
    //             'textRotation' => 0,
    //         ],
    //     ];
    //     $styleB = [
    //         'alignment' => [
    //             'horizontal' => Alignment::HORIZONTAL_LEFT,
    //             'vertical' => Alignment::VERTICAL_TOP,
    //             'wrapText' => true,
    //             'textRotation' => 0,
    //         ],
    //         'borders' => [
    //             'allBorders' => [
    //                 'borderStyle' => Border::BORDER_THIN,
    //                 'color' => ['argb' => '000000'],
    //             ],
    //         ],
    //     ];

    //     // Fill in the data rows
    //     $row = 2;
    //     $worksheet->getStyle('B2:B9')->applyFromArray($styleB);
    //     $worksheet->getStyle('C3:C5')->applyFromArray($styleB);
    //     $worksheet->getStyle('C6:C9')->applyFromArray($styleB);
    //     $worksheet->getStyle('D3:D5')->applyFromArray($styleB);
    //     $worksheet->getStyle('D6:D9')->applyFromArray($styleB);
    //     $worksheet
    //         ->setCellValue('B' . $row, 'Uraian Masalah : ' . $data['problem'])
    //         ->setCellValue('C3',  $data['aktual'])
    //         ->setCellValue('C6', 'OTY : ' .  $data['oty'])
    //         ->setCellValue('D6', 'Temporary Action : ' .  $data['temporary_action'])
    //         ->setCellValue('D3',  $data['standar'])
    //         ->setCellValue('C23', ' : ')
    //         ->setCellValue('C24', ' : ' . $data['departemen_tujuan'])
    //         ->setCellValue('C25', ' : ')
    //         ->setCellValue('C26', ' : ' . $data['area'])
    //         ->setCellValue('C27', ' : ');

    //     $worksheet->getStyle('B10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //     $worksheet->getStyle('B10')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);


    //     $imagePath = 'img_uploaded/' . $data['foto'];

    //     // Check if the image file exists
    //     if (file_exists($imagePath)) {
    //         // Add the image to the worksheet
    //         $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    //         $drawing->setPath($imagePath);
    //         $drawing->setWidth(200);
    //         $drawing->setHeight(200);
    //         $drawing
    //             ->setOffsetY(20)
    //             ->setOffsetX(20)
    //             ->setCoordinates('B10');

    //         $drawing->setWorksheet($worksheet);
    //     }


    //     // Set the header content type and attachment filename
    //     $filename = 'ncr_report_' . date('Y-m-d') . $data['id'] . '.xlsx';
    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="' . $filename . '"');
    //     header('Cache-Control: max-age=0');

    //     // Write the Spreadsheet object to a file
    //     $writer = new Xlsx($spreadsheet);
    //     $writer->save('php://output');
    //     exit;
    // }



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
