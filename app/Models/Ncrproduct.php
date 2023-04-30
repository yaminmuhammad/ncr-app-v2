<?php

namespace App\Models;

use CodeIgniter\Model;

class Ncrproduct extends Model
{
    protected $table            = 'ncr_product';
    protected $allowedFields    = ['problem', 'area', 'qty', 'departemen', 'foto', 'created_at'];

    // Dates
    protected $useTimestamps = true;

    // public function getProduct($id)
    // {
    //     return $this->where([
    //         'id' => $id
    //     ])->first();
    // }
}
