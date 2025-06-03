<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Edit Standard Part</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= site_url('/') ?>">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?= site_url('ccf-master-standard-part') ?>">Standard Part</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit Data
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="card-box p-4">
            <form action="<?= site_url('ccf-master-standard-part/update/' . $part['id']) ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Part List <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="sp_part_list" class="form-control" value="<?= esc($part['sp_part_list']) ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Material Spec <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="sp_material_spec" class="form-control" value="<?= esc($part['sp_material_spec']) ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Size Type</label>
                    <div class="col-sm-9">
                        <input type="text" name="sp_size_type" class="form-control" value="<?= esc($part['sp_size_type']) ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Quantity</label>
                    <div class="col-sm-9">
                        <input type="number" name="sp_qty" class="form-control" value="<?= esc($part['sp_qty']) ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Category</label>
                    <div class="col-sm-9">
                        <input type="text" name="sp_category" class="form-control" value="<?= esc($part['sp_category']) ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Cost</label>
                    <div class="col-sm-9">
                        <input type="number" step="0.01" name="sp_cost" class="form-control" value="<?= esc($part['sp_cost']) ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-9 offset-sm-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="<?= site_url('ccf-master-standard-part') ?>" class="btn btn-secondary">Batal</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
