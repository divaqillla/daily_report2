<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ccf\CcfMasterMainMaterialModel;

class CcfMasterMainMaterial extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new CcfMasterMainMaterialModel();
    }

    public function index()
    {
        $data['items'] = $this->model->findAll();
        return view('masterCcf/master_main_material/index', $data);
    }

    public function create()
    {
        return view('masterCcf/master_main_material/create');
    }

    public function store()
    {
        $success = $this->model->insert($this->request->getPost());
        if ($success) {
            return redirect()->to('/ccf-master-main-material')->with('success', 'Data berhasil diupdate');
        } else {
            // Bisa ambil pesan error validasi model jika ada
            $error = $this->model->errors();
            print_r($error);
            exit();
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data. ' . json_encode($error));
        }
        return redirect()->to('/ccf-master-main-material')->with('success','Data berhasil disimpan');
    }

    public function edit($id)
    {
        $data['item'] = $this->model->find($id);
        if (!$data['item']) throw new \CodeIgniter\Exceptions\PageNotFoundException("Data tidak ditemukan");
   
        return view('masterCcf/master_main_material/edit', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
    
        $success = $this->model->update($id, $data);
    
        if ($success) {
            return redirect()->to('/ccf-master-main-material')->with('success', 'Data berhasil diupdate');
        } else {
            // Bisa ambil pesan error validasi model jika ada
            $error = $this->model->errors();
            print_r($error);
            exit();
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data. ' . json_encode($error));
        }
    }
    
    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/ccf-master-main-material')->with('success','Data berhasil dihapus');
    }
}
