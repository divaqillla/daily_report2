<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="pd-ltr-20 xs-pd-20-10">
  <div class="min-height-200px">
    <!-- Header -->
    <div class="page-header d-flex justify-content-between align-items-center mb-3">
      <h4>Daftar WPS</h4>
    </div>

    <div class="card-box mb-30">
      <div class="pd-20">
        <h4 class="text-blue h4">Form WPS</h4>
        <p class="mb-0">Daftar part number yang tersedia</p>
      </div>

      <!-- Tombol Tambah -->
      <?php if (has_permission(38)): ?>
        <a href="<?= site_url('wps/create') ?>" class="btn btn-primary btn-sm ml-3 mb-3">
          Tambah
        </a>
      <?php endif; ?>

      <!-- Flashdata sukses -->
      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= session()->getFlashdata('success') ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <!-- Tabel -->
      <div class="table-responsive px-3 mb-3">
        <table id="wps-table" class="table table-striped hover nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>Part Number</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($wpsList)): ?>
              <?php $no = 1; foreach ($wpsList as $index => $partNumber): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= esc($partNumber) ?></td>
                  <td>
                    <div class="btn-group" role="group">
                      <a href="<?= base_url('wps/edit/' . $index) ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                        <i class="fa fa-edit"></i> Edit
                      </a>
                      <a href="<?= base_url('wps/excel/' . $index) ?>" class="btn btn-success btn-sm" data-toggle="tooltip" title="Export Excel">
                        <i class="fa fa-file-excel"></i> Excel
                      </a>
                      <a href="<?= base_url('wps/delete/' . $index) ?>" class="btn btn-danger btn-sm btn-delete" data-toggle="tooltip" title="Delete">
                        <i class="fa fa-trash"></i> Delete
                      </a>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="3" class="text-center">Tidak ada data.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Script -->
<script>
  $(document).ready(function () {
    if (!$.fn.dataTable.isDataTable('#wps-table')) {
      $('#wps-table').DataTable({
        "ordering": false,
        "paging": true,
        "lengthChange": false,
        "searching": true
      });
    }

    $('[data-toggle="tooltip"]').tooltip();
  });

  // SweetAlert untuk konfirmasi delete
  $(document).on('click', '.btn-delete', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');

    Swal.fire({
      title: 'Yakin hapus data ini?',
      text: "Data tidak bisa dikembalikan setelah dihapus.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Ya, Hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = url;
      }
    });
  });
</script>

<?= $this->endSection() ?>
