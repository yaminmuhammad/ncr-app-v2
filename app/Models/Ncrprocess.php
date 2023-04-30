<?php

namespace App\Models;

use CodeIgniter\Model;

class Ncrprocess extends Model
{
    protected $table            = 'ncr_process';
    protected $allowedFields    = ['problem', 'area', 'qty', 'departemen', 'foto', 'created_at'];

    // Dates
    protected $useTimestamps = true;

    // public function getProcess($id)
    // {
    //     return $this->where([
    //         'id' => $id
    //     ])->first();
    // }
}
