<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
  
    protected $table            = 'payment';
    protected $primaryKey       = 'id_transaksi';
    protected $useAutoIncrement = false;
   
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

  
}
