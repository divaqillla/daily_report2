<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="pd-ltr-20 xs-pd-20-10">
  <div class="min-height-200px">
    <!-- Header -->
    <div class="page-header d-flex justify-content-between align-items-center mb-3">
      <h4>Daftar PPS</h4>
    </div>

    <div class="card-box mb-30">
      <div class="pd-20">
        <h4 class="text-blue h4">Daftar PPS</h4>
        <!-- <p class="mb-0">List PPS yang tersedia</p> -->
    
        User guide bisa  
        <a href="<?= base_url('uploads/template/UserGuidePPSDCP.pdf'); ?>" download>download di sini</a>

        <li>Sistem akan mengelompokkan data yang tampil bedasarkan Part Number yang pernah dibuat</li>
       
        <li>Setiap edit data akan menghasilkan dokumen revisi baru</li>
      </div>

      <?php if (has_permission(38)): ?>
        <a href="<?= site_url('pps/create') ?>" class="btn btn-primary btn-sm ml-3 mb-3">
          Tambah
        </a>
      <?php endif; ?>

      <!-- Display Success Message -->
      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= session()->getFlashdata('success') ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <!-- Table -->
      <div class="table-responsive">
        <table id="pps-table" class="table table-striped hover nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>Part No</th>
              <th>Part Name</th>
              <th>Customer</th>
              <th>Model</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($groupedPps as $partNo => $items): ?>
              <?php $first = $items[0]; ?>
              <tr class="main-row" data-items='<?= json_encode($items) ?>'>
                <td><?= $no++ ?></td>
                <td><?= esc($partNo) ?></td>
                <td><?= esc($first['part_name']) ?></td>
                <td><?= esc($first['cust']) ?></td>
                <td><?= esc($first['model']) ?></td>
                <td>
                  <?php if (count($items) > 1): ?>
                      <em>Klik untuk lihat data lainnya</em>
                  <?php else: ?>
                    <div class="btn-group" role="group">
                        <a href="<?= base_url('pps/edit/' . $first['id']) ?>" class="btn btn-warning mr-1 mb-1" data-toggle="tooltip" title="Edit Data">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href="<?= base_url('pps/editNew/' . $first['id']) ?>" class="btn btn-secondary mr-1 mb-1" data-toggle="tooltip" title="Copy As New">
                            <i class="fa fa-save"></i> Save As New Data
                        </a>
                        <a href="<?= base_url('pps/generate/' . $first['id']) ?>" class="btn btn-success mr-1 mb-1" data-toggle="tooltip" title="Generate Excel">
                            <i class="fa fa-file-excel"></i> Excel
                        </a>
                        <a href="<?= base_url('pps/list-process-dies/' . $first['id']) ?>" class="btn btn-primary mr-1 mb-1" data-toggle="tooltip" title="Lihat Proses DCP">
                            <i class="fa fa-cogs"></i> DCP
                        </a>

                        <?php if ($first['status'] == 1): ?>
                            <a href="<?= base_url('pps/delete/' . $first['id']) ?>" class="btn btn-danger mr-1 mb-1 btn-delete" data-toggle="tooltip" title="Delete Data">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                        <?php elseif ($first['status'] == 0): ?>
                            <a href="<?= base_url('pps/rollback/' . $first['id']) ?>" class="btn btn-light mr-1 mb-1 btn-rollback" data-toggle="tooltip" title="Rollback Data">
                                <i class="fa fa-recycle"></i> Rollback
                            </a>
                        <?php endif; ?>
                    </div>

                  <?php endif; ?>
              </td>

              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Footer and Scripts -->
<script>
   const BASE_URL = "<?= base_url() ?>";
$(document).ready(function () {
  // Inisialisasi DataTable hanya jika belum diinisialisasi
  if (!$.fn.dataTable.isDataTable('#pps-table')) {
    var table = $('#pps-table').DataTable({
      "ordering": false,   // Menonaktifkan sorting pada kolom
      "paging": true,      // Aktifkan paging
      "lengthChange": false, // Nonaktifkan perubahan jumlah item per halaman
      "searching": true    // Aktifkan pencarian
    });
  }

  // Event click untuk membuka detail data
  $('#pps-table tbody').on('click', 'tr.main-row', function () {
    var tr = $(this);
    var items = tr.data('items'); // Ambil data dari data-items

    // Jika detail baris sudah muncul, hapus
    if (tr.hasClass('opened')) {
      tr.next('.detail-row').remove();
      tr.removeClass('opened');
      return;
    }

    // Tutup semua detail lain terlebih dulu
    $('.detail-row').remove();
    $('.main-row').removeClass('opened');

    // Buat HTML untuk detail
    var html = '<tr class="detail-row"><td colspan="6"><div class="card p-3 mb-2 bg-light"><ul class="list-group mb-0">';

    // Loop untuk setiap item dalam data
    items.forEach((item, i) => {
      // Menentukan teks yang akan ditampilkan berdasarkan indeks
      const revisionText = i === 0 ? 'Dok Asli' : `Revisi ${i}`;

      html += `
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                  - ${revisionText} ( Waktu Pembuatan : ${item.created_at} )
                </div>
                <div>
                  <a href="${BASE_URL}/pps/edit/${item.id}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit Data">
                    <i class="fa fa-edit"></i> Edit
                  </a>
                  <a href="${BASE_URL}/pps/editNew/${item.id}" class="btn btn-secondary btn-sm" data-toggle="tooltip" title="Copy As New Data">
                    <i class="fa fa-save"></i> Save As New Data
                  </a>
                  <a href="${BASE_URL}/pps/generate/${item.id}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Generate Excel">
                    <i class="fa fa-file-pdf"></i> Excel
                  </a>
                  <a href="${BASE_URL}/pps/list-process-dies/${item.id}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Lihat Proses DCP">
                    <i class="fa fa-cogs"></i> DCP
                  </a>
                </div>
              </li>
              `;


      // Tambahan tombol Delete atau Rollback tergantung status
      if (item.status == 1) {
        html += `
            <a href="${BASE_URL}/pps/delete/${item.id}" class="btn btn-danger btn-sm mr-1 mb-1 btn-delete" data-toggle="tooltip" title="Delete Data">
              <i class="fa fa-trash"></i> Delete
            </a>`;
      } else if (item.status == 0) {
        html += `
            <a href="${BASE_URL}/pps/rollback/${item.id}" class="btn btn-light btn-sm mr-1 mb-1 btn-rollback" data-toggle="tooltip" title="Rollback Data">
              <i class="fa fa-recycle"></i> Rollback
            </a>`;
      }
      html += `
          </div>
        </li>`;
    });

    html += '</ul></div></td></tr>';

    // Sisipkan detail setelah tr utama
    tr.after(html);
    tr.addClass('opened');

    // Aktifkan tooltips setelah elemen baru dimasukkan
    $('[data-toggle="tooltip"]').tooltip();
  });
});


// Handle Delete dengan SweetAlert
$(document).on('click', '.btn-delete', function (e) {
  e.preventDefault();
  var url = $(this).attr('href');

  Swal.fire({
    title: 'Yakin hapus data ini?',
    text: "Data akan dihapus?",
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

// Handle Rollback dengan SweetAlert
$(document).on('click', '.btn-rollback', function (e) {
  e.preventDefault();
  var url = $(this).attr('href');

  Swal.fire({
    title: 'Yakin rollback data ini?',
    text: "Data akan dikembalikan seperti semula.",
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#28a745',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Ya, Rollback!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = url;
    }
  });
});

</script>

<?= $this->endSection() ?>
