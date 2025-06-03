<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/styles/icon-font.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/datatables/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/datatables/css/responsive.bootstrap4.min.css') ?>">

<div class="pd-ltr-20 xs-pd-20-10">
  <div class="min-height-200px">
    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="title">
            <h4>Edit CCF Lead Time </h4>
          </div>
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?= site_url('dashboard'); ?>">Home</a>
              </li>
              <li class="breadcrumb-item">
                <a href="<?= route_to('leadTimeCcf.index'); ?>">Master CCF</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Edit Lead Time</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <!-- End Page Header -->

    <div class="pd-20 card-box mb-30">
      <form action="<?= route_to('leadTimeCcf.update', $record['id']) ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-group row">
          <div class="col-md-6">
            <label>Category <span class="text-danger">*</span></label>
            <input type="text"
                   name="category"
                   class="form-control"
                   value="<?= esc($record['category']) ?>"
                   required>
          </div>
          <div class="col-md-6">
            <label>Class <span class="text-danger">*</span></label>
            <input type="text"
                   name="class"
                   class="form-control"
                   value="<?= esc($record['class']) ?>"
                   required>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-6">
            <label>Hour <span class="text-danger">*</span></label>
            <input type="number"
                   name="hour"
                   class="form-control"
                   value="<?= esc($record['hour']) ?>"
                   required>
          </div>
          <div class="col-md-6">
            <label>Week <span class="text-danger">*</span></label>
            <input type="number"
                   name="week"
                   class="form-control"
                   value="<?= esc($record['week']) ?>"
                   required>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-6">
            <label>Status <span class="text-danger">*</span></label>
            <select name="status" class="form-control" required>
              <option value="1" <?= $record['status'] ? 'selected' : '' ?>>Aktif</option>
              <option value="0" <?= !$record['status'] ? 'selected' : '' ?>>Tidak Aktif</option>
            </select>
          </div>
          <div class="col-md-6 text-right align-self-end">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="<?= route_to('master.ccf.index'); ?>" class="btn btn-secondary">Kembali</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
