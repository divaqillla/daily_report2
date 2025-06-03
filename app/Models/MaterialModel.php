<?php

namespace App\Models;

use CodeIgniter\Model;

class MaterialModel extends Model
{
    protected $table      = 'nmaterial';
    protected $primaryKey = 'id';

    // Kolom yang boleh diisi saat insert/update
    protected $allowedFields = [
        'name_material',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'status'
    ];

    // Jika kamu ingin menggunakan timestamp otomatis, bisa diaktifkan
    protected $useTimestamps = false;

    // Kalau kamu mau gunakan kolom waktu otomatis:
    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
}
