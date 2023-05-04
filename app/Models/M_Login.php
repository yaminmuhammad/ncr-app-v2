<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Login extends Model
{

    protected $table            = 'users';
    protected $allowedFields    = ['nomor', 'npk', 'nama', 'status', 'divisi', 'departemen', 'seksi', 'bagian', 'roles'];

    // Dates
    protected $useTimestamps = true;

    public function cek_login($nama, $npk)
    {
        $query = $this->db->query('SELECT * FROM users WHERE nama = \'' . $nama . '\' AND npk = \'' . $npk . '\'');
        return $query->getRowArray();
    }
}
