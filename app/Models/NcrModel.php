<?php

namespace App\Models;

use CodeIgniter\Model;

class NcrModel extends Model
{
    protected $table            = 'ncr';
    protected $allowedFields    = ['problem', 'area', 'qty', 'satuan', 'departemen_tujuan', 'jenis', 'foto', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $useTimestamps = true;

    // public function getNcr($id)
    // {
    //     return $this->where([
    //         'id' => $id
    //     ])->first();
    // }

    public function countRows()
    {
        return $this->countAllResults();
    }

    public function getNcr($id)
    {
        return $this->where([
            'id' => $id
        ])->first();
    }
}
