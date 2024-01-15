<?php

namespace App\Models;

use CodeIgniter\Model;

class CatalogModel extends Model
{
    protected $table            = 'ruangan';
    protected $primaryKey       = 'id_ruangan';
    protected $allowedFields    = ['gambar','deskripsicom','nomor_ruangan', 'status','tipe'];

    
    public function getCatalog()
    {
        return $this->select('gambar,nomor_ruangan,deskripsicom,tipe')
            ->where('status','kosong')
            ->findAll();
    }
}
