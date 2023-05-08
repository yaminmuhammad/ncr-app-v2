<?php

namespace App\Models;

use CodeIgniter\Model;

class NcrModel extends Model
{
    protected $table            = 'ncr';
    protected $allowedFields    = ['problem', 'area', 'qty', 'satuan', 'departemen_tujuan', 'jenis', 'foto', 'created_at', 'updated_at', 'deleted_at', 'status', 'email'];
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

    public function getStatusCount()
    {
        $pending_count = $this->where('status', 'PENDING')->countAllResults();
        $ok_count = $this->where('status', 'OK')->countAllResults();
        $ng_count = $this->where('status', 'NG')->countAllResults();

        return [
            'pending_count' => $pending_count,
            'ok_count' => $ok_count,
            'ng_count' => $ng_count
        ];
    }

    public function getNcr($id)
    {
        return $this->where([
            'id' => $id
        ])->first();
    }
}
