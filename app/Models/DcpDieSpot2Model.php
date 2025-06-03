<?php

namespace App\Models;

use CodeIgniter\Model;

class DcpDieSpot2Model extends Model
{
    protected $table         = 'dcp_die_spot2';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'overview_id',
        'die_spot_kom',
        // 'die_spot_process',
        'die_spot_lead_time'
    ];
    protected $useTimestamps = true;
}
