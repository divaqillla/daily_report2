<?php

namespace App\Controllers;

class WpsController extends BaseController
{
    private $dummyData = [
        'PN-001',
        'PN-002',
        'PN-003',
    ];

    public function index()
    {
        $data['wpsList'] = $this->dummyData;
        return view('wps/index', $data);
    }

    public function edit($id)
    {
        echo "Edit data ke-$id";
    }

    public function excel($id)
    {
        echo "Export Excel data ke-$id";
    }

    public function delete($id)
    {
        echo "Hapus data ke-$id";
    }
}
