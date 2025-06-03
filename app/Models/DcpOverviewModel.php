<?php 
namespace App\Models;

use CodeIgniter\Model;

class DcpOverviewModel extends Model
{
    protected $table         = 'dcp_overview'; 
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'id_pps_dies',
        'sketch',
        'id_finishing',
        'id_tool_cost'
    ];
    protected $useTimestamps = true;


    // Method untuk mengambil data DCP dengan join ke pps_dies
    public function getDcpList()
    {
        return $this->select('
                    dcp_overview.*, 
                    pps_dies.process, 
                    pps_dies.process_join, 
                    pps_dies.proses, 
                    pps_dies.die_length, 
                    pps_dies.die_width, 
                    pps_dies.die_height, 
                    pps_dies.die_weight, 
                    pps_dies.class,
                    pps.cust as cust, 
                    pps.part_no as part_no
                ')
                ->join('pps_dies', 'dcp_overview.id_pps_dies = pps_dies.id', 'left')
                ->join('pps', 'pps_dies.pps_id = pps.id', 'left')
                ->findAll();
    }

}
