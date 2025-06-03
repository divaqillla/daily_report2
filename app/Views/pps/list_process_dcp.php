<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="pd-ltr-20 xs-pd-20-10">
  <div class="min-height-200px">
    <!-- Header -->
    <div class="page-header d-flex justify-content-between align-items-center mb-3">
      <h4>List Process DCP</h4>
    </div>

    <div class="card-box mb-30">
      <div class="pd-20">
        <h4 class="text-blue h4">List Process DCP</h4>
        <p class="mb-0">Berikut adalah daftar process DCP berdasarkan data PPS Dies</p>
      </div>
        <a href="<?= site_url('dcp-excel/'.$id) ?>" class="btn btn-primary btn-sm ml-3 mb-2">
        Generate Excel
      </a>

      <!-- Table Responsive -->
      <div class="table-responsive">
        <table class="data-table table stripe hover nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>Process</th>
              <th>Proses</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($dies) && is_array($dies)): ?>
              <?php foreach ($dies as $i => $row): ?>
                <?php 
                  // Cari record overview (DCP) yang memiliki id_pps_dies sama dengan current die
                  $found = null;
                  if (!empty($dcp) && is_array($dcp)) {
                      foreach ($dcp as $d) {
                          if ($d['id_pps_dies'] == $row['id']) {
                              $found = $d;
                              break;
                          }
                      }
                  }
                ?>
                <tr>
                  <td><?= $i + 1 ?></td>
                  <td>
    <?= esc($row['process']) ?>
    <?php if (!empty($row['process_join'])): ?>
        + <?= esc($row['process_join']) ?>
    <?php endif; ?>
</td>

                  <td><?= esc($row['proses']) ?></td>
                  <td>
                    <?php if ($found === null): ?>
                      <a href="<?= site_url('dcp/create/' . $row['id']) ?>" class="btn btn-success btn-sm">Create</a>
                    <?php else: ?>
                      <a href="<?= site_url('dcp/edit/' . $found['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="text-center">Data tidak ditemukan.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
