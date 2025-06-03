<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Tambah Data Main Material</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= site_url('/') ?>">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?= site_url('ccf-master-main-material') ?>">Main Material</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Tambah Data
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="card-box p-4">
            <form action="<?= site_url('ccf-master-main-material/store') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Part List <span style="color: red;">*</span></label>
                    <div class="col-sm-9">
                        <input name="mm_part_list" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Material Spec <span style="color: red;">*</span></label>
                    <div class="col-sm-9">
                        <input name="mm_material_spec" class="form-control" required>
                    </div>
                </div>

                <!-- <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Size (L x W x H)</label>
                    <div class="col-sm-3">
                        <input name="mm_size_type_l" class="form-control" placeholder="L">
                    </div>
                    <div class="col-sm-3">
                        <input name="mm_size_type_w" class="form-control" placeholder="W">
                    </div>
                    <div class="col-sm-3">
                        <input name="mm_size_type_h" class="form-control" placeholder="H">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Qty / Weight</label>
                    <div class="col-sm-3">
                        <input name="mm_qty" class="form-control" placeholder="Qty">
                    </div>
                    <div class="col-sm-3">
                        <input name="mm_weight" class="form-control" placeholder="Weight">
                    </div>
                </div> -->

                <div class="form-group row">
                    <div class="col-sm-9 offset-sm-3">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="<?= site_url('ccf-master-main-material') ?>" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
