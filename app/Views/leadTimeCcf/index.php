<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/styles/icon-font.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/datatables/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/datatables/css/responsive.bootstrap4.min.css') ?>">

<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header d-flex justify-content-between align-items-center mb-3">
            <h4>Master CCF Lead Time</h4>
            <a href="<?= route_to('leadTimeCcf.create') ?>" class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Daftar Lead Time</h4>
            </div>
            <div class="pb-20">      
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category</th>
                            <th>Class</th>
                            <th>Hour</th>
                            <th>Week</th>

                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($records)): ?>
                            <?php $no = 1; foreach ($records as $r): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($r['category']) ?></td>
                                    <td><?= esc($r['class']) ?></td>
                                    <td><?= esc($r['hour']) ?></td>
                                    <td><?= esc($r['week']) ?></td>
     
                                    <td>
                                        <a href="<?= route_to('leadTimeCcf.edit', $r['id']) ?>" class="btn btn-sm btn-warning mb-1">Edit</a>
                                        <form action="<?= route_to('leadTimeCcf.delete', $r['id']) ?>"
                                              method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- load JS di bagian akhir -->
<script src="<?= base_url('assets/plugins/datatables/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/js/responsive.bootstrap4.min.js') ?>"></script>

<?= $this->endSection() ?>
