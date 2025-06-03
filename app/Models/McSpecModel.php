<?php namespace App\Models;

use CodeIgniter\Model;

class McSpecModel extends Model
{
    protected $table         = 'mc_spec';  // Nama tabel di database
    protected $primaryKey    = 'id';       // Primary key tabel
    protected $allowedFields = [
        'machine',
        'bolster_length',
        'bolster_width',
        'slide_area_length',
        'slide_area_width',
        'die_height',
        'cushion_pad_length',
        'cushion_pad_width',
        'cushion_stroke',
         'capacity',
        'cushion',
        
    ];  // Kolom-kolom yang dapat di-assign
    // protected $useTimestamps = true;  // Mengaktifkan timestamp jika ada kolom created_at atau updated_at
}