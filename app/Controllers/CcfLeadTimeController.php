<?php

namespace App\Controllers;

use App\Models\ccf\CcfLeadTimeModel;
use CodeIgniter\Controller;

class CcfLeadTimeController extends Controller
{
    protected $model;
    protected $helpers = ['form', 'url', 'filesystem'];

    public function __construct()
    {
        $this->model = new CcfLeadTimeModel();
    }

    /** List semua record */
    public function index()
    {
        $data['records'] = $this->model->orderBy('id', 'DESC')->findAll();
        return view('leadTimeCcf/index', $data);
    }

    /** Tampilkan form create */
    public function create()
    {
        return view('leadTimeCcf/create');
    }

    /** Simpan record baru */
    public function store()
    {
        $post = $this->request->getPost();
    
        $data = [
            'category'    => $post['category'],
            'class'       => $post['class'],
            'hour'        => $post['hour'],
            'week'        => $post['week'],
            'status'      => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'created_by'  => session()->get('user_id') ?? null,
        ];
    
        $this->model->insert($data);
    
        return redirect()->route('master.ccf.index')
                         ->with('success', 'Data berhasil ditambah');
    }
    

    /** Tampilkan form edit */
    public function edit($id)
    {
        $record = $this->model->find($id);
      
        if (!$record) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("ID $id tidak ditemukan");
        }
    
        return view('leadTimeCcf/edit', ['record' => $record]);
    }

    /** Update record */
    public function update($id)
    {
        $post = $this->request->getPost();
        $this->model->update($id, [
            'category'    => $post['category'],
            'class'       => $post['class'],
            'hour'        => $post['hour'],
            'week'        => $post['week'],
            'status'      => 1,
            'modified_at' => date('Y-m-d H:i:s'),
            'modified_by' => session()->get('user_id') ?? null
        ]);
        return redirect()->route('leadTimeCcf.index')->with('success', 'Data berhasil diubah');
    }

    /** Hapus record */
    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->route('leadTimeCcf.index')->with('success', 'Data berhasil dihapus');
    }
}
