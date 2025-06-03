<?php 
namespace App\Models;

use CodeIgniter\Model;

class DcpAksesorisModel extends Model
{
    protected $table         = 'dcp_aksesoris';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'overview_id',
        'aksesoris_part_list',
        'aksesoris_spec',
        'aksesoris_qty'
    ];
    protected $useTimestamps = true;
    protected $returnType    = 'array';
}
