<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="pd-ltr-20 xs-pd-20-10">
  <div class="min-height-200px">
    <!-- Page Header -->
    <div class="page-header d-flex justify-content-between align-items-center mb-3">
      <div class="col-md-6 col-sm-12">
        <div class="title">
          <h4>Daftar Cutting Tools</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('home'); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cutting Tools</li>
          </ol>
        </nav>
      </div>
      <div class="col-md-6 col-sm-12 text-right">
        <a href="<?= site_url('cuttingtools/create') ?>" class="btn btn-primary">Tambah Data</a>
      </div>
    </div>
    <!-- End Page Header -->

    <div class="card-box mb-30">
      <?php if(session()->has('success')): ?>
        <div class="alert alert-success" role="alert"><?= session('success') ?></div>
      <?php endif; ?>
      <div class="pd-20">
        <h4 class="text-blue h4">Daftar Cutting Tools</h4>
      </div>
      <div class="pb-20">
      <table class="data-table table stripe hover nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>Spec Cutter</th>
              <th>Jenis Chip</th>
              <th>Class</th>
              <th>Diameter</th>
              <th>Kebutuhan Chip</th>
              <th>Remarks</th>
              <th>Process</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($cuttingtools)) : ?>
              <?php $no = 1; // inisialisasi counter ?>
              <?php foreach($cuttingtools as $row) : ?>
                <tr>
                  <!-- gunakan $no sebagai nomor urut, lalu increment -->
                  <td><?= $no++ ?></td>
                  <td><?= esc($row['spec_cutter']) ?></td>
                  <td><?= esc($row['jenis_chip']) ?></td>
                  <td><?= esc($row['class']) ?></td>
                  <td><?= esc($row['diameter']) ?></td>
                  <td><?= esc($row['kebutuhan_chip']) ?></td>
                  <td><?= esc($row['remarks']) ?></td>
                  <td><?= esc($row['process']) ?></td>
                  <td>
                    <a href="<?= site_url('cuttingtools/edit/' . $row['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                    <form action="<?= site_url('cuttingtools/delete/' . $row['id']) ?>"
                          method="post"
                          style="display:inline;"
                          onsubmit="return confirm('Yakin ingin menghapus data?');">
                      <?= csrf_field() ?>
                      <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="9" class="text-center">Data tidak ditemukan</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
