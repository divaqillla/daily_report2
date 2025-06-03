<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<style>
    /* Tambahan styling untuk step wizard */
    .step-wizard {
        margin-bottom: 2rem;
        position: relative;
    }
    
    .step-progress {
        display: flex;
        justify-content: space-between;
        list-style: none;
        padding: 0;
        margin: 0 0 1rem 0;
    }
    
    .step-progress li {
        flex: 1;
        text-align: center;
        position: relative;
    }
    
    .step-progress li:before {
        content: "";
        width: 20px;
        height: 20px;
        background-color: #e9ecef;
        border-radius: 50%;
        display: block;
        margin: 0 auto 0.5rem;
        position: relative;
        z-index: 1;
    }
    
    .step-progress li:after {
        content: "";
        position: absolute;
        width: 100%;
        height: 2px;
        background-color: #e9ecef;
        top: 10px;
        left: -50%;
    }
    
    .step-progress li:first-child:after {
        content: none;
    }
    
    .step-progress li.active:before {
        background-color: #007bff;
        color: white;
    }
    
    .step {
        display: none;
    }
    
    .step.active {
        display: block;
        animation: fadeIn 0.5s;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .suggestions-dropdown {
        border: 1px solid #ccc;
        max-height: 250px;
        overflow-y: auto;
        background: white;
        position: absolute;
        z-index: 999;
        width: 100%;
        display: none;
    }
    
    .suggestion-item {
        padding: 5px 10px;
        cursor: pointer;
    }
    
    .suggestion-item:hover {
        background-color: #f0f0f0;
    }
    
    .file-preview {
        max-width: 200px;
        margin: 10px 0;
    }
    
    .nav-buttons {
        margin-top: 2rem;
        display: flex;
        justify-content: space-between;
    }

        .hidden-column {
            display: none;
        }
        .modal-lg {
    max-width: 90%;
}

.modal-body {
    max-height: 70vh;
    overflow-y: auto;
}

.machine-tab {
    margin-bottom: 1rem;
}

.table td, .table th {
    vertical-align: middle;
    font-size: 14px;
}

</style>
<div class="pd-ltr-20 xs-pd-20-10">
  <div class="min-height-200px">
    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="title">
            <h4>Form Tambah PPS</h4>
          </div>
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= site_url('pps'); ?>">PPS</a></li>
              <li class="breadcrumb-item active" aria-current="page">Form Tambah PPS</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  
    <!-- Card Box Form -->
    <div class="card-box p-4">
      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
      <?php endif; ?>
      <div class="step-wizard mb-4">
        <ul class="step-progress list-unstyled d-flex justify-content-between">
          <li class="active">Data Utama</li>
          <li>Detail Material</li>
          <li>Konfigurasi Dies I </li>
          <!-- <li>Konfigurasi Dies II </li> -->
          <li>Die Construction</li>
          <li>Upload & Submit</li>
        </ul>
      </div>
      <div id="docsuggestions_insert" class="suggestions-dropdown" style="display: none; position: absolute; background: #fff; border: 1px solid #ccc; z-index: 1000;"></div>
          <div id="docsuggestions_heat_treatment" class="suggestions-dropdown" style="display: none; position: absolute; background: #fff; border: 1px solid #ccc; z-index: 1000;"></div>
          <div id="docsuggestions_pad_lifter" class="suggestions-dropdown" style="display: none; position: absolute; background: #fff; border: 1px solid #ccc; z-index: 1000;"></div>
          <div id="docsuggestions_guide" class="suggestions-dropdown" style="display: none; position: absolute; background: #fff; border: 1px solid #ccc; z-index: 1000;"></div>
          <div id="docsuggestions_pad" class="suggestions-dropdown" style="display: none; position: absolute; background: #fff; border: 1px solid #ccc; z-index: 1000;"></div>

      <form action="<?= site_url('pps/submit') ?>" method="post" enctype="multipart/form-data">
        <!-- Step 1: Data Utama -->
        <div class="step active" data-step="1">
          <!-- Header Information -->
          <div class="card p-3 mb-3">
            <h5>Header Information</h5>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label>Customer <span class="text-danger">*</span></label>
                <input type="text" id="cust" name="cust" class="form-control" required>
                <!-- Container untuk suggestion cust -->
                <div id="cust-suggestions" class="suggestions-dropdown" style="display: none;"></div>
              </div>
              <div class="col-md-6 mb-3">
                <label>Model <span class="text-danger">*</span></label>
                <input type="text" id="model" name="model" class="form-control" required>
              </div>
              <div class="col-md-6 mb-3">
                <label>Receive</label>
                <input type="date" id="receive" name="receive" class="form-control">
              </div>
            </div>
          </div>

          <!-- Part Information -->
          <div class="card p-3 mb-3">
            <h5>Part Information</h5>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label>Part No</label>
                <input type="text" id="part_no" name="part_no" class="form-control" oninput="updateCf()">
              </div>
              <div class="col-md-6 mb-3">
                <label>Part Name</label>
                <input type="text" id="part_name" name="part_name" class="form-control">
              </div>
            </div>
          </div>

          <div class="nav-buttons text-right">
            <button type="button" class="btn btn-primary next-step" data-next="2">Selanjutnya</button>
          </div>
        </div>
        <!-- End Step 1 -->

        <!-- Step 2: Detail Material -->
      <!-- Segmen Material yang sudah ada -->
      <div class="step" data-step="2" style="display: none;">
        <!-- Material Details -->
        <div class="text-left mb-2">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#materialHintModal">
              <i class="fa fa-lightbulb-o" aria-hidden="true"></i> Petunjuk
            </button>
        </div>
        <div class="card p-3 mb-3">
          <h5>Material</h5>
          <div class="row">
            
            <div class="col-md-4 mb-3">
              <label>Jenis Material</label>
              <input type="text" id="material" name="material" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
              <label>Thickness</label>
              <input type="text" id="tonasi" name="tonasi" class="form-control" oninput="calculateMainPressure(this)">
            </div>
          </div>
        <!-- </div> -->

        <!-- Measurement -->
        <!-- <div class="card p-3 mb-3">
          <h5>Material</h5> -->
          <div class="row">
            <div class="col-md-4 mb-3">
              <label>Length</label>
              <input type="number" id="length" name="length" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
              <label>Width</label>
              <input type="number" id="width" name="width" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
              <label>BOQ</label>
              <input type="number" id="boq" name="boq" class="form-control" oninput="calculate">
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 mb-3">
              <label>Blank (Kg)</label>
              <input type="number" id="blank" name="blank" class="form-control" readonly>
            </div>
            <div class="col-md-4 mb-3">
              <label>Panel (Kg)</label>
              <input type="number" id="panel" name="panel" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
              <label>Scrap (Kg)</label>
              <input type="number" id="scrap" name="scrap" class="form-control" readonly>
              <span id="scrapError" style="color: red;"></span>
            </div>
          </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="nav-buttons text-right">
          <button type="button" class="btn btn-secondary prev-step" data-prev="1">Sebelumnya</button>
          <button type="button" class="btn btn-primary next-step" data-next="3">Selanjutnya</button>
        </div>
      </div>

      <!-- Modal Pop-Up untuk Hint Material -->
      <div class="modal fade" id="materialHintModal" tabindex="-1" role="dialog" aria-labelledby="materialHintModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header">
              <h5 class="modal-title" id="materialHintModalLabel">Logika Sistem Segment Material</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <!-- Body Modal -->
            <div class="modal-body">
              <img src="<?= base_url('assets/images/mater.jpg') ?>" alt="Material Hint" class="img-fluid mb-3">
              <p>Segmen ini adalah untuk mengisi bagian dari Material seperti yang tampil pada gambar diatas.</p>
              <hr>
              <!-- Keterangan Perhitungan -->
              <p><strong>Perhitungan Blank:</strong> (Length * Width * Thickness * 7.85 / 1000000) / BOQ</p>
              <p><strong>Perhitungan Scrap:</strong> Panel - Blank </p>
            </div>
          </div>
        </div>
      </div>

        <!-- End Step 2 -->

        <!-- Step 3: Konfigurasi Dies -->
        <div class="step" data-step="3" style="display: none;">

          <!-- Tombol untuk membuka modal -->
          <div class="text-left mb-2">
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#diesHintModal">
                  <i class="fa fa-lightbulb-o" aria-hidden="true"></i> Petunjuk
              </button>
          </div>

          <!-- Modal Dies Configuration -->
          <div class="modal fade" id="diesHintModal" tabindex="-1" role="dialog" aria-labelledby="diesHintModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      <!-- Header Modal -->
                      <div class="modal-header">
                          <h5 class="modal-title" id="diesHintModalLabel">Logika Sistem Dies Configuration</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <!-- Body Modal -->
                      <div class="modal-body">
                          <h6><strong>1. Dies Configuration</strong></h6>
                          <img src="<?= base_url('assets/images/DiesConfiguration.png') ?>" alt="Dies Configuration" class="img-fluid mb-3">
                          <p>Dies Configuration digunakan untuk mengisi PRESS M/C SPEC dan PROCESS DETAIL yang akan ditempelkan pada bagian Excel seperti gambar di atas.</p>

                          <hr>

                          <h6><strong>2. Konversi Tensile Material</strong></h6>
                          <p>Tensile material dikonversi berdasarkan nilai material yang digunakan:</p>
                          <pre>
                            if (tensile_material === 270) {
                            konversi = 30;
                            } else if (tensile_material === 440) {
                            konversi = 45;
                            } else if (material === 590) {
                            konversi = 60;
                            } else {
                            konversi = 100; 
                            }
                          </pre>

                          <hr>

                          <h6><strong>3. Perhitungan Main Pressure</strong></h6>
                          <p>Rumus perhitungan tekanan utama (Main Pressure):</p>
                          <ul>
                              <li>BL/TR: <code>(Keliling * thickness * 0.8 * konversi * 1.2 * 1) / 1000</code></li>
                              <li>DR/DO: <code>(Keliling * thickness * 0.8 * konversi * 1.2 * 2.5) / 1000</code></li>
                          </ul>
                      </div>

                      <!-- Footer Modal -->
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Dies Configuration -->
          <div class="card p-3 mb-3">
              <h5>Dies Configuration</h5>
              <div class="row">
                  <div class="col-md-4 mb-3">
                      <label>CF</label>
                      <input type="text" id="cf" name="cf" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label>Total Dies (max 6) <span class="text-danger">*</span></label>
                      <div class="input-group">
                          <input type="number" id="total_dies" name="total_dies" class="form-control" max="6" min="1">
                          <div class="input-group-append">
                              <button type="button" class="btn btn-info" onclick="generateRows()">Generate</button>
                              <!-- <button type="button" class="btn btn-secondary ms-2" onclick="showMachineMatchModal()">Tampilkan Machine Match List</button> -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
     


          <!-- Process Table -->
          <div class="card p-3 mb-3">
              <h5>Process</h5>
              <div class="table-responsive">
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th width="8%">OP</th>
                              <th width="8%">OP Gang</th>
                              <th width="12%">Nama Proses</th>
                              <th width="12%">Nama Proses Gang</th>
                              <th width="8%">Panjang Part</th>
                              <th width="8%">Lebar Part</th>
                              <th width="8%">Keliling</th>
                              <th width="8%">Main Pressure</th>
                              <th class="hidden-column" id="machineColumn" width="8%">Machine</th>
                              <th class="hidden-column" id="capacityColumn" width="8%">Capacity</th>
                              <th class="hidden-column" id="cushionColumn" width="8%">Cushion</th>
                          </tr>
                      </thead>
                      <tbody id="basicTableBody"></tbody>
                  </table>
              </div>
          </div>
          <div class="d-flex justify-content-center mb-3">
              <button type="button" class="btn btn-primary" onclick="fetchMachineData()">Generate Data</button>
            
              <div class="modal fade" id="machineMatchModal" tabindex="-1">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Machine Match List</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <ul class="nav nav-tabs" id="pressureTabs" role="tablist">
                    <!-- Diisi oleh JS -->
                  </ul>
                  <div class="tab-content mt-3" id="pressureTabContent">
                    <!-- Diisi oleh JS -->
                  </div>
                </div>
              </div>
            </div>
          </div>

          </div>
           <!-- Die Table -->
           <div id="dieTable" style="display: none;">
            <div class="d-flex justify-content-center mb-3">
              <button type="button" class="btn btn-secondary ms-2" onclick="showMachineMatchModal()">Tampilkan Machine Match List</button>
            </div>
           <div class="card p-3 mb-3">
                <h5>Die Sizing Process</h5>
                <p>Silahkan memilih Proses Standard Die untuk menentukan ukuran sesuai dengan master data Standard Die</p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Process</th>
                                <th>Die Size ( Dapat mengganti jika tidak sesuai kebutuhan)</th>
                                <th>Die Size (L)</th>
                                <th>Die Size (W)</th>
                                <th>Die Size (H)</th>
                                <th>Casting/Plate</th>
                                <th>Die Weight</th>
                            </tr>
                        </thead>
                        <tbody id="dieTableBody"></tbody>
                    </table>
                </div>
            </div>
        
          <!-- Press M/C Spec Table -->
          <div class="card p-3 mb-3">
              <h5>Press M/C Spec</h5>
              <div class="table-responsive">
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th>Machine</th>
                              <th>Bolster Area L</th>
                              <th>Bolster Area W</th>
                              <th>Slide Area L</th>
                              <th>Slide Area W</th>
                              <th>Die Height</th>
                              <th>Cushion Pad L</th>
                              <th>Cushion Pad W</th>
                              <th>Cushion Stroke</th>
                          </tr>
                      </thead>
                      <tbody id="newTableBody"></tbody>
                  </table>
              </div>
          </div>

          </div>

          <div class="nav-buttons text-right">
              <button type="button" class="btn btn-secondary prev-step" data-prev="2">Sebelumnya</button>
              <button type="button" class="btn btn-primary next-step" data-next="4">Selanjutnya</button>
          </div>

          </div>

        <!-- End Step 3 -->

        <!-- Step 4: Die Construction -->
        <div class="step" data-step="4" style="display: none;">
          <div class="text-left mb-2">
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#dieConstructionHintModal">
                  <i class="fa fa-lightbulb-o" aria-hidden="true"></i> Petunjuk
              </button>
          </div>

          <!-- Modal Die Construction -->
          <div class="modal fade" id="dieConstructionHintModal" tabindex="-1" role="dialog" aria-labelledby="dieConstructionHintModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      <!-- Header Modal -->
                      <div class="modal-header">
                          <h5 class="modal-title" id="dieConstructionHintModalLabel">Logika Sistem untuk Die Construction</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <!-- Body Modal -->
                      <div class="modal-body">
                          <h6><b>1. Penjelasan Die Construction</b></h6>
                          <img src="<?= base_url('assets/images/DiesConfiguration.png') ?>" alt="Dies Construction" class="img-fluid mb-3">
                          <p>Dies Configuration digunakan untuk mengisi <b>PRESS M/C SPEC</b> dan <b>PROCESS DETAIL</b> yang akan ditempelkan pada bagian Excel seperti pada gambar di atas.</p>

                          <hr>

                          <h6><b>2. Pemilihan Material pada Die Construction</b></h6>
                          <ul>
                              <li>Bagian <b>Upper & Lower Die</b> menggunakan material <b>SS41</b> jika <b>Die Plate</b>, sedangkan <b>Die Casting</b> menggunakan <b>FC300</b>.</li>
                              <li>Bagian <b>Pad</b> menggunakan material <b>S45C</b> untuk <b>Die Plate</b>, dan <b>FCD55</b> untuk <b>Die Casting</b>.</li>
                              <li>Bagian <b>Pad Lifter</b> menggunakan <b>Coil Spring</b> jika prosesnya melibatkan <b>FL, DR, BE, RE, atau FO</b>, sedangkan proses lainnya menggunakan <b>Gas Spring</b>.</li>
                              <li>Bagian <b>Sliding</b> selalu menggunakan <b>Wear Plate</b>.</li>
                              <li>Bagian <b>Guide</b> menggunakan <b>Guide Post</b> jika <b>Die Plate</b> dan proses melibatkan <b>BL, CUT, atau TR</b>. Selain itu, maka menggunakan <b>Guide Heel</b>.</li>
                          </ul>

                          <hr>

                          <h6><b>3. Pemilihan Insert dan Heat Treatment</b></h6>
                          <ul>
                              <li>Jika material lebih dari <b>440 MPa</b> dan tonase lebih dari <b>1 ton</b>, maka insert menggunakan <b>SKD11</b>.</li>
                              <li>Proses seperti <b>FL, DR, BE, RE, dan FO</b> menggunakan insert <b>SXACE</b>, sementara <b>PI</b> menggunakan <b>S45C</b>.</li>
                              <li>Proses seperti <b>BL, TR, SEP, dan CUT</b> menggunakan <b>SKD11</b>.</li>
                              <li>Insert <b>SXACE</b> mendapatkan perlakuan <b>FULL HARD + COATING</b>, sementara lainnya menggunakan <b>FLAME HARDENING</b>.</li>
                          </ul>

                          <hr>

                          <h6><b>4. Output Tabel Configuration</b></h6>
                          <p>Output yang ditampilkan pada tabel configuration hanya sebagai <b>rekomendasi</b> dan dapat disesuaikan dengan kondisi yang dibutuhkan.</p>

                          <hr>

                          <h6><b>5. Upload Gambar</b></h6>
                          <p>Fitur upload gambar bersifat <b>opsional</b> dan tidak wajib diisi melalui program jika lebih mudah dilakukan melalui Excel.</p>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Die Construction Table -->
          <div class="card p-3 mb-3">
            <h5>Die Construction</h5>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Nama Proses</th>
                    <th>Machine</th>
                    <th>Upper</th>
                    <th>Lower</th>
                    <th>Pad</th>
                    <th>Pad Lifter</th>
                    <th>Sliding</th>
                    <th>Guide</th>
                    <th>Insert</th>
                    <th>Heat Treatment</th>
                  </tr>
                </thead>
                <tbody id="dieConstructionTableBody">
                </tbody>
              </table>
            </div>
          </div>
          <div class="card p-3 mb-3">
            <h5>Upload Gambar C-Layout dan Die Construction</h5>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Process</th>
                    <th>C-Layout</th>
                    <th>Die Construction</th>
                 
                  </tr>
                </thead>
                <tbody id="dieImage">
                  <!-- Baris akan di-generate oleh fungsi generateRows() -->
                </tbody>
              </table>
            </div>
          </div>

          <div class="nav-buttons text-right">
            <button type="button" class="btn btn-secondary prev-step" data-prev="3">Sebelumnya</button>
            <button type="button" class="btn btn-primary next-step" data-next="5">Selanjutnya</button>
          </div>
        </div>
        <!-- End Step 4 -->

        <!-- Step 5: Upload & Submit -->
        <div class="step" data-step="5" style="display: none;">
          <!-- Tombol untuk membuka modal -->
        <div class="text-left mb-2">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#additionalInfoHintModal">
                <i class="fa fa-lightbulb-o" aria-hidden="true"></i> Petunjuk
            </button>
        </div>

        <!-- Modal Additional Information -->
        <div class="modal fade" id="additionalInfoHintModal" tabindex="-1" role="dialog" aria-labelledby="additionalInfoHintModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <!-- Header Modal -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="additionalInfoHintModalLabel">Panduan Additional Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Body Modal -->
                    <div class="modal-body">
                        <h6><strong>1. Penjelasan Additional Information</strong></h6>
                        <img src="<?= base_url('assets/images/DiesCons.png') ?>" alt="Dies Construction" class="img-fluid mb-3">
                        <p>Dies Configuration digunakan untuk mengisi **PROCESS LAYOUT** dan **PROCESS DETAIL** yang akan ditempelkan pada bagian Excel seperti pada gambar di atas.</p>

                        <hr>

                        <h6><strong>2. Perhitungan Total MP</strong></h6>
                        <ul>
                            <li><strong>Jika Mesin Big Press</strong>: Setiap mesin **x 2 orang**, kecuali **Line E**.</li>
                            <li><strong>Jika Mesin 300T & SP</strong>: Setiap mesin **x 1 orang**.</li>
                            <li><strong>Untuk Line E</strong>: **4 mesin** hanya memerlukan **3 orang**.</li>
                        </ul>

                        <hr>

                        <h6><strong>3. Upload Gambar</strong></h6>
                        <p>Upload gambar bersifat **opsional** dan tidak wajib diisi melalui program.</p>
                    </div>
                </div>
            </div>
        </div>

          <!-- Additional Information -->
          <div class="card p-3 mb-3">
              <h5>Additional Information</h5>
              <div class="form-group row">
                <div class="col-md-4 mb-3">
                  <label for="total_mp" class="col-form-label">Total MP</label>
                  <input type="text" id="total_mp" name="total_mp" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                  <label for="doc_level" class="col-form-label">Doc Level</label>
                  <input type="text" id="doc_level" name="doc_level" class="form-control">
                  <div id="docsuggestions" class="suggestions-dropdown" style="display: none;"></div>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="total_stroke" class="col-form-label">Total Stroke</label>
                  <input type="text" id="total_stroke" name="total_stroke" class="form-control">
                </div>
              </div>
          </div>
     
          <!-- Upload Blank Layout -->
          <div class="card p-3 mb-3">
  <div class="row">
    <div class="col-md-6 mb-3">
      <label>Gambar Blank Layout <span class="text-danger">*</span></label>

      <!-- Upload manual -->
      <input type="file" name="blank_layout_img" class="form-control mb-2" accept=".png,.jpg,.jpeg" id="blankUpload">
      
      <!-- Preview -->
      <img id="blankPreview" style="max-width: 120px; display: none; margin-top: 5px;" />

      <!-- Hidden input jika user pilih dari list -->
      <input type="hidden" name="blank_layout_selected" id="blankSelected">

      <!-- Container list gambar -->
      <div id="blankList" class="dcp-image-list mt-2" style="display:flex; flex-wrap:wrap; gap:10px;"></div>
    </div>
  </div>
</div>

<div class="card p-3 mb-3">
  <div class="row">
    <div class="col-md-6 mb-3">
      <label>Gambar Proses Layout <span class="text-danger">*</span></label>

      <input type="file" name="process_layout_img" class="form-control mb-2" accept=".png,.jpg,.jpeg" id="processUpload">
      <img id="processPreview" style="max-width: 120px; display: none; margin-top: 5px;" />
      <input type="hidden" name="process_layout_selected" id="processSelected">
      <div id="processList" class="dcp-image-list mt-2" style="display:flex; flex-wrap:wrap; gap:10px;"></div>
    </div>
  </div>
</div>

          <div class="nav-buttons text-right">
            <button type="button" class="btn btn-secondary prev-step" data-prev="4">Sebelumnya</button>
            <button type="submit" class="btn btn-success">Submit Data</button>
          </div>
        </div>
        <!-- End Step 5 -->
      </form>
      <div id="errorMessage" style="color: red;"></div>
    </div>
  </div>
</div>

<!-- Global CSRF Token -->

<!-- Letakkan script ini di bagian head atau tepat di atas script lainnya -->
<script>
  var csrfName = "<?= csrf_token() ?>";
  var csrfHash = "<?= csrf_hash() ?>";
</script>
<script>
  function updateCf() {
      // Mendapatkan element input Part No dan CF
      var partNoInput = document.getElementById("part_no");
      var cfInput = document.getElementById("cf");

      // Mengecek apakah nilai Part No mengandung karakter "/" atau ","
      if (partNoInput.value.includes("/") || partNoInput.value.includes(",")) {
        // Jika mengandung, set nilai CF menjadi "1/1"
        cfInput.value = "1/1";
      } else {
        // Jika tidak, set nilai CF menjadi "1"
        cfInput.value = "1";
      }
    }

</script>

<script>
  var InsertSuggestions = ["SKD11", "SXACE", "S45C"];
  var HeatTreatmentSuggestions = ["FULLHARD", "FULLHARD + COATING", "FLAMEHARD"];
  var PadLifterSuggestions = ["Coil Spring", "Gas Spring"];
  var GuideSuggestions = ["Guide Post", "Guide Heel"];
  var PadSuggestions = ["S45C", "FCD55"];

  var currentSuggestionInput = null;

   $(document).on('focus', 'input[name="insert[]"], input[name="heat_treatment[]"], input[name="pad_lifter[]"], input[name="guide[]"], input[name="pad[]"]', function(){
    currentSuggestionInput = $(this);
  });

  function setupSuggestion(selector, suggestionArray, containerId) {
    $(document).on('input', selector, function(){
      var inputVal = $(this).val().toLowerCase();
      var suggestionBox = $(containerId);
      suggestionBox.empty();
      
      var matches = suggestionArray.filter(function(item){
        return item.toLowerCase().indexOf(inputVal) !== -1;
      });
      
      var offset = $(this).offset();
      suggestionBox.css({
        top: offset.top + $(this).outerHeight(),
        left: offset.left,
        width: $(this).outerWidth()
      });
      
      if(matches.length > 0 && inputVal.length > 0){
        matches.forEach(function(match){
          suggestionBox.append('<div class="suggestion-item">' + match + '</div>');
        });
        suggestionBox.show();
      } else {
        suggestionBox.hide();
      }
    });
    
    $(document).on('click', containerId + ' .suggestion-item', function(){
      if (currentSuggestionInput) {
        currentSuggestionInput.val($(this).text());
      }
      $(containerId).hide();
    });
    
   $(document).on('click', function(event){
      if(!$(event.target).closest(selector + ', ' + containerId).length){
        $(containerId).hide();
      }
    });
  }

  setupSuggestion('input[name="insert[]"]', InsertSuggestions, '#docsuggestions_insert');
  setupSuggestion('input[name="heat_treatment[]"]', HeatTreatmentSuggestions, '#docsuggestions_heat_treatment');
  setupSuggestion('input[name="pad_lifter[]"]', PadLifterSuggestions, '#docsuggestions_pad_lifter');
  setupSuggestion('input[name="guide[]"]', GuideSuggestions, '#docsuggestions_guide');
  setupSuggestion('input[name="pad[]"]', PadSuggestions, '#docsuggestions_pad');
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const steps = document.querySelectorAll('.step');
  const stepProgress = document.querySelectorAll('.step-progress li');
  let currentStep = 1;

  function showStep(stepNumber) {
    steps.forEach(step => {
      step.style.display = 'none';
      step.classList.remove('active');
    });
    const activeStep = document.querySelector(`.step[data-step="${stepNumber}"]`);
    if (activeStep) {
      activeStep.style.display = 'block';
      activeStep.classList.add('active');
    }
    
    stepProgress.forEach((item, index) => {
      if (index < stepNumber) {
        item.classList.add('active');
      } else {
        item.classList.remove('active');
      }
    });
  }

  document.querySelectorAll('.next-step').forEach(button => {
    button.addEventListener('click', function() {
      const nextStep = parseInt(this.dataset.next);
      if (validateStep(currentStep)) {
        currentStep = nextStep;
        showStep(currentStep);
      }
    });
  });

  document.querySelectorAll('.prev-step').forEach(button => {
    button.addEventListener('click', function() {
      const prevStep = parseInt(this.dataset.prev);
      currentStep = prevStep;
      showStep(currentStep);
    });
  });

  function validateStep(stepNumber) {
    const currentStepElement = document.querySelector(`.step[data-step="${stepNumber}"]`);
    const requiredFields = currentStepElement.querySelectorAll('[required]');
    let isValid = true;
    requiredFields.forEach(field => {
      if (!field.value.trim()) {
        isValid = false;
        field.classList.add('is-invalid');
      } else {
        field.classList.remove('is-invalid');
      }
    });
    if (!isValid) {
      Swal.fire({
          icon: 'warning',  // Menggunakan ikon peringatan
          title: 'Data Tidak Lengkap!',
          text: 'Silakan lengkapi semua field yang wajib diisi.',
          confirmButtonText: 'OK'
      });

    }
    return isValid;
  }

  showStep(currentStep);
});
</script>
<script>
    var custSuggestions = ["MMKI", "ADM", "TMMIN", "GMR", "HMMI", "HPM"];

    $(document).ready(function(){
        $('#cust').on('input', function(){
            var inputVal = $(this).val().toLowerCase();
            var suggestionBox = $('#cust-suggestions');
            suggestionBox.empty();
            
            var matches = custSuggestions.filter(function(item){
                return item.toLowerCase().indexOf(inputVal) !== -1;
            });
            
            if(matches.length > 0 && inputVal.length > 0){
                matches.forEach(function(match){
                    suggestionBox.append('<div class="suggestion-item">' + match + '</div>');
                });
                suggestionBox.show();
            } else {
                suggestionBox.hide();
            }
        });

        $('#cust-suggestions').on('click', '.suggestion-item', function(){
            $('#cust').val($(this).text());
            $('#cust-suggestions').hide();
        });

        $(document).on('click', function(event){
            if(!$(event.target).closest('#cust, #cust-suggestions').length){
                $('#cust-suggestions').hide();
            }
        });
    });
</script>
<script>
  const partNoInput = document.getElementById('part_no');
  const cfInput = document.getElementById('cf');

  partNoInput.addEventListener('input', function() {
  
    const value = partNoInput.value;

   
    if (value.includes(',') || value.includes('/')) {
      cfInput.value = '1/1';
    } else {
      cfInput.value = '1';
    }
  });
</script>
<script>
  
    var DocSuggestions = ["RFQ"];

    $(document).ready(function(){
        $('#doc_level').on('input', function(){
            var inputVal = $(this).val().toLowerCase();
            var suggestionBox = $('#docsuggestions');
            suggestionBox.empty();
            
            var matches = DocSuggestions.filter(function(item){
                return item.toLowerCase().indexOf(inputVal) !== -1;
            });
            
            if(matches.length > 0 && inputVal.length > 0){
                matches.forEach(function(match){
                    suggestionBox.append('<div class="suggestion-item">' + match + '</div>');
                });
                suggestionBox.show();
            } else {
                suggestionBox.hide();
            }
        });

         $('#docsuggestions').on('click', '.suggestion-item', function(){
            $('#doc_level').val($(this).text());
            $('#docsuggestions').hide();
        });

        $(document).on('click', function(event){
            if(!$(event.target).closest('#cust, #cust-suggestions').length){
                $('#cust-suggestions').hide();
            }
        });
    });
</script>
<script>
    var custSuggestions = ["MMKI", "ADM", "TMMIN", "GMR", "HMMI"];

    $(document).ready(function(){
        
        $('#cust').on('input', function(){
            var inputVal = $(this).val().toLowerCase();
            var suggestionBox = $('#cust-suggestions');
            suggestionBox.empty();
            
           
            var matches = custSuggestions.filter(function(item){
                return item.toLowerCase().indexOf(inputVal) !== -1;
            });
            
            if(matches.length > 0 && inputVal.length > 0){
                matches.forEach(function(match){
                    suggestionBox.append('<div class="suggestion-item">' + match + '</div>');
                });
                suggestionBox.show();
            } else {
                suggestionBox.hide();
            }
        });

       
        $('#cust-suggestions').on('click', '.suggestion-item', function(){
            $('#cust').val($(this).text());
            $('#cust-suggestions').hide();
        });

      
        $(document).on('click', function(event){
            if(!$(event.target).closest('#cust, #cust-suggestions').length){
                $('#cust-suggestions').hide();
            }
        });
    });
</script>
<script>
function updateDCProcessDropdown(rowIndex) {
  var basicTableBody = document.getElementById('basicTableBody');
  var basicRow = basicTableBody.children[rowIndex];
  if (!basicRow) return; 

 
  var processInput = basicRow.querySelector('.input-proses input[name="proses[]"]');
  var process = processInput ? processInput.value.toUpperCase() : "";

  
  var gangContainer = basicRow.querySelector('.input-proses-gang');
  var gangSelects = gangContainer ? gangContainer.querySelectorAll('select') : [];
  var gangValues = [];
  gangSelects.forEach(function(select) {
    if (select.value !== "") {
      gangValues.push(select.value.toUpperCase());
    }
  });
  
  var cbGang = gangContainer ? gangContainer.querySelector('input.gang-checkbox') : null;
  if (cbGang && cbGang.checked) {
    gangValues.push("CAM");
  }
 
  var prosesGang = gangValues.join("-");

  
  var machineSelect = basicRow.querySelector('select[name="machine[]"]');
  var machine = machineSelect ? machineSelect.value : "";
  var machineUpper = machine.toUpperCase();


  var processJoinSelect = basicRow.querySelector('select[name="process_join[]"]');
  var processJoin = processJoinSelect ? processJoinSelect.value.toUpperCase() : "";

  
  var category = "";
  if (/[ADEFG]/.test(machineUpper)) {
    category = "BIG DIE";
  } else if (/[BHC]/.test(machineUpper)) {
    category = "MEDIUM DIE";
  } else {
    category = "SMALL DIE";
  }

  var jenisProses = /[A-Z]/.test(prosesGang) ? "GANG" : "SINGLE";
  console.log("Nilai proses gang:", jenisProses);

  var prosesValue = "";
  if (category === "BIG DIE") {
   
    jenisProses = "SINGLE";
    if (/DRAW|FORM|FLANGE|BEND|REST/.test(process)) {
      prosesValue = "DRAW";
    } else if(/CAM-FLANGE/.test(process)){
      prosesValue = "CAM FLANGE";
    }else if(/FLANGE/.test(process)){
      prosesValue = "FLANGE";
    }
    else {
      prosesValue = "TRIM";
    }
  } else if (category === "MEDIUM DIE") {
    if (jenisProses === "SINGLE") {
      if (/DRAW|FORM|BEND|REST/.test(process)) {
        prosesValue = "DRAW";
      } else if (process.includes("CAM") && process.includes("PIE")) {
        prosesValue = "CAM PIE";
      } else if (process.includes("FLANGE") ) {
        prosesValue = "FLANGE";
      } else {
        prosesValue = "TRIM";
      }
    } else { 
      if (/DRAW|FLANGE|FORM|BEND|REST/.test(process)) {
        prosesValue = "DRAW";
      } else if (process.includes("CAM") && process.includes("PIE")) {
        if (processJoin.includes("FLANGE")) {
          prosesValue = "FLANGE-CAM PIE";
        } else {
          prosesValue = "DRAW";
        }
      } else if (process.includes("FLANGE")) {
        if (processJoin.includes("CAM") && processJoin.includes("PIE")) {
          prosesValue = "FLANGE-CAM PIE";
        } else {
          prosesValue = "DRAW";
        }
      } else {
        prosesValue = "TRIM";
      }
    }
  } else if (category === "SMALL DIE") {
    if (jenisProses === "SINGLE") {
      if (process.includes("CAM") && process.includes("PIE")) {
        prosesValue = "CAM PIE";
      }else if (/DRAW|FLANGE|FORM|BEND|PIERCE|REST/.test(process)) {
        prosesValue = "FORMING";
      } else {
        prosesValue = "BLANK";
      }
    } else if (jenisProses === "GANG") {
      if (process.includes("BEND") || processJoin.includes("BEND")) {
        prosesValue = "BEND 1, BEND 2";
      } else if (
        (process.includes("FORM") || processJoin.includes("FORM")) &&
        (process.includes("PIE") || processJoin.includes("PIE"))
      ) {
        prosesValue = "FORMING, PIE";
      } else if (
        (process.includes("BLANK") || processJoin.includes("BLANK")) &&
        (process.includes("PIE") || processJoin.includes("PIE"))
      ) {
        prosesValue = "BLANK-PIE";
      } else if (
        (
              /TRIM|PIE|BLANK|SEP/.test(process) ||
              /TRIM|PIE|BLANK|SEP/.test(processJoin)
          )
      ) {
        prosesValue = "BLANK-PIE";
      } else {
        prosesValue = "FORM-FLANGE";
      }
    }
  }

 
  var dcProcessValue = category + "|" + jenisProses + "|" + prosesValue;

  
  var dieTableBody = document.getElementById('dieTableBody');
  if (dieTableBody && dieTableBody.children[rowIndex]) {
    var dieRow = dieTableBody.children[rowIndex];
    
    var dcProcessSelect = dieRow.querySelector('select[name="die_proses_standard_die[]"]');
    if (dcProcessSelect) {
      var optionFound = false;
     
      for (var i = 0; i < dcProcessSelect.options.length; i++) {
        if (dcProcessSelect.options[i].value === dcProcessValue) {
          dcProcessSelect.selectedIndex = i;
          optionFound = true;
          break;
        }
      }
      
      if (!optionFound) {
        var newOption = document.createElement("option");
        newOption.value = dcProcessValue;
        newOption.textContent = dcProcessValue;
        newOption.selected = true;
        dcProcessSelect.appendChild(newOption);
      }
      onStandardChange(dcProcessSelect);
      console.log("Updated DC Process (select):", dcProcessValue);
    }
  }
}

  function updateDieConstructionRow(rowIndex) {
 
  var basicRow = document.querySelector('#tableBasic tbody tr[data-index="'+ rowIndex +'"]');
  var dieRow = document.querySelector('#tableDie tbody tr[data-index="'+ rowIndex +'"]');
  if (!basicRow) return;
 
  
  const proses = basicRow.querySelector('input[name^="dies"][name$="[proses]"]').value;
  const casting_plate = dieRow.querySelector('[name^="dies"][name$="[casting_plate]"]').value;
  const machine = basicRow.querySelector('[name^="dies"][name$="[machine]"]').value;
  
  var angka = document.getElementById('material').value;
  var material = parseFloat(angka.replace(/\D/g, '')) || 0;
  var tonasi = parseFloat(document.getElementById('tonasi').value) || 0;

  var upperValue = ( casting_plate.includes("plate")) ? "SS41" : "FC300";

  var lowerValue = upperValue;
  var padValue = ( casting_plate.includes("plate")) ? "S45C" : "FCD55";
  
 
  var insertVal;
  if (material > 440 || tonasi > 1) {
    insertVal = "SKD11";
  } else if (
    proses.toUpperCase().includes("FL") ||
    proses.toUpperCase().includes("DR") ||
    proses.toUpperCase().includes("BE") ||
    proses.toUpperCase().includes("RE") ||
    proses.toUpperCase().includes("FO")
  ) {
    insertVal = "SXACE";
  } else if (proses.toUpperCase().includes("PI")) {
    insertVal = "S45C";
  } else if (
    proses.toUpperCase().includes("BL") ||
    proses.toUpperCase().includes("TR") ||
    proses.toUpperCase().includes("SEP") ||
    proses.toUpperCase().includes("CUT")
  ) {
    insertVal = "SKD11";
  } else {
    insertVal = "";
  }
  
  var heat_treatment = (insertVal === "SXACE") ? "FULLHARD + COATING" : "FLAMEHARD";
  var padLifterValue = (
    proses.toUpperCase().includes("FL") ||
    proses.toUpperCase().includes("DR") ||
    proses.toUpperCase().includes("BE") ||
    proses.toUpperCase().includes("RE") ||
    proses.toUpperCase().includes("FO")
  ) ? "Coil Spring" : "Gas Spring";
  var slidingValue = "Wear Plate";
  var guideValue = ( casting_plate.includes("plate") ||
                    proses.toUpperCase().includes("BL") ||
                    proses.toUpperCase().includes("CUT") ||
                    proses.toUpperCase().includes("SEP") ||
                    proses.toUpperCase().includes("PIE") ||
                    proses.toUpperCase().includes("TR"))
                    ? "Guide Post" : "Guide Heel";

 
  var dieConsRow = document.querySelector('#tableDieConstruction tbody tr[data-index="'+ rowIndex +'"]');
  if (!dieConsRow) return; 

  
  var inputProcess = dieConsRow.querySelector('input[name^="dies"][name$="[process]"]');
  if (inputProcess) inputProcess.value = proses;
  
  var inputProcess = dieConsRow.querySelector('input[name^="dies"][name$="[machine]"]');
  if (inputProcess) inputProcess.value = machine;

  var inputcasting_plate = dieConsRow.querySelector('select[name^="dies"][name$="[casting_plate]"]');
  if (inputcasting_plate) inputcasting_plate.value = casting_plate;
  
  var inputUpper = dieConsRow.querySelector('input[name^="dies"][name$="[upper]"]');
  if (inputUpper) inputUpper.value = upperValue;
  
  var inputLower = dieConsRow.querySelector('input[name^="dies"][name$="[lower]"]');
  if (inputLower) inputLower.value = lowerValue;
  
  var inputPad = dieConsRow.querySelector('input[name^="dies"][name$="[pad]"]');
  if (inputPad) inputPad.value = padValue;
  
  var inputPadLifter = dieConsRow.querySelector('input[name^="dies"][name$="[pad_lifter]"]');
  if (inputPadLifter) inputPadLifter.value = padLifterValue;
  
  var inputSliding = dieConsRow.querySelector('input[name^="dies"][name$="[sliding]"]');
  if (inputSliding) inputSliding.value = slidingValue;
  
  var inputGuide = dieConsRow.querySelector('input[name^="dies"][name$="[guide]"]');
  if (inputGuide) inputGuide.value = guideValue;
  
  var inputInsert = dieConsRow.querySelector('input[name^="dies"][name$="[insert]"]');
  if (inputInsert) inputInsert.value = insertVal;
  
  var inputHeat = dieConsRow.querySelector('input[name^="dies"][name$="[heat_treatment]"]');
  if (inputHeat) inputHeat.value = heat_treatment;
}

document.addEventListener('DOMContentLoaded', function () {
  let length = document.getElementById('length');
  let width = document.getElementById('width');
  let tonasi = document.getElementById('tonasi');
  let boq = document.getElementById('boq');
  let blank = document.getElementById('blank');
  let panel = document.getElementById('panel');
  let scrap = document.getElementById('scrap');

  function calculateBlank() {
    let l = parseFloat(length.value) || 0;
    let w = parseFloat(width.value) || 0;
    let t = parseFloat(tonasi.value) || 0;
    let b = parseFloat(boq.value) || 1;

    let tes = (l * w * t * 7.85 / 1000000).toFixed(3);
    let result = ((l * w * t * 7.85 / 1000000) / b).toFixed(3);
    
    blank.value = result;
    
    calculateScrap();
  }

    
  function calculateScrap() {
      let blankVal = parseFloat(blank.value) || 0;
      let panelVal = parseFloat(panel.value) || 0;
      let scrapVal = blankVal - panelVal;
      scrap.value = scrapVal.toFixed(3);

      let scrapError = document.getElementById('scrapError');
      if (scrapVal < 0) {
        scrapError.textContent = "Warning: Nilai Scrap negatif!";
      } else {
        scrapError.textContent = "";
      }
    }
    [length, width, tonasi, boq].forEach(input => {
      input.addEventListener('input', calculateBlank);
    });
    panel.addEventListener('input', calculateScrap);
  });
  function updateProsesHidden(row) {
   
    var inputs = row.querySelectorAll('input[name^="proses_input"]');
    var checkbox = row.querySelector('input[name="proses_cam[]"]');
    var hidden = row.querySelector('input[name="proses[]"]');

    var values = [];
    inputs.forEach(function(inp) {
      if (inp.value.trim() !== "") {
        values.push(inp.value.trim());
      }
    });

    // Jika checkbox tercentang, tambahkan "CAM"
    if (checkbox && checkbox.checked) {
      values.push(checkbox.value);
    }

    hidden.value = values.join("-");
  }

  // function updateProsesGangHidden(row) {
  //   var inputs = row.querySelectorAll('input[name^="proses_gang_input"]');
  //   var checkbox = row.querySelector('input[name="proses_gang_cam[]"]');
  //   var hidden = row.querySelector('input[name="proses_gang[]"]');

  //   var values = [];
  //   inputs.forEach(function(inp) {
  //     if (inp.value.trim() !== "") {
  //       values.push(inp.value.trim());
  //     }
  //   });

  //   if (checkbox && checkbox.checked) {
  //     values.push(checkbox.value);
  //   }
  //   hidden.value = values.join("-");
  // }

  // Fungsi untuk menyembunyikan/menampilkan kolom Process Gang
  function toggleProcessGang(selectElement) {
    var selectedValue = selectElement.value;
    // Ambil baris tempat dropdown "process_join[]" berada
    var row = selectElement.closest('tr');
    // Kolom tdProcessGang di baris yang sama
    var tdPG = row.querySelector('.tdProcessGang');
    
    if (!selectedValue || selectedValue === "") {
      // jika value kosong, sembunyikan
      tdPG.style.display = "none";
    } else {
      tdPG.style.display = "";
    }
  }
  function generateRows() {
    var totalDies = parseInt(document.getElementById('total_dies').value);
    if (isNaN(totalDies) || totalDies < 1 || totalDies > 6) {
      swal({
        title: "Peringatan!",
        text: "Total Dies harus antara 1 dan 6.",
        icon: "warning",
        button: "OK"
      });
      return;
    }
    var basicTableBody = document.getElementById('basicTableBody');
    var dieTableBody = document.getElementById('dieTableBody'); // Tabel baru untuk Die
    var dieImageBody = document.getElementById('dieImage');
    basicTableBody.innerHTML = '';
    dieTableBody.innerHTML = '';
    dieImageBody.innerHTML = '';

    var processOptions = [];
    for (var j = 1; j <= 8; j++) {
      processOptions.push("OP" + (j * 10));
    }
    var prosesOptions = ["DRAW", "FORM","BEND", "REST", "FLANGE", "BLANK", "TRIM",   "SEP", "PIE"];
    var opsi1 = ["DRAW", "FORM","BEND", "REST", "FLANGE", "BLANK", "TRIM",   "SEP", "PIE"];
    var opsi2 = ["DRAW", "FORM","BEND", "REST", "FLANGE", "BLANK", "TRIM",   "SEP", "PIE"];
    var opsi3 = ["DRAW", "FORM","BEND", "REST", "FLANGE", "BLANK", "TRIM",   "SEP", "PIE"];
    var opsi4 = ["DRAW", "FORM","BEND", "REST", "FLANGE", "BLANK", "TRIM",   "SEP", "PIE"];
    var opsiProses  = ["DRAW", "FORM","BEND", "REST", "FLANGE", "BLANK", "TRIM",   "SEP", "PIE"];
    var letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
    var machineOptions = [];

    letters.forEach(function(letter) {
      for (var i = 1; i <= 4; i++) {
        if (!(letter === 'C' && (i === 3 || i === 4))) {
          machineOptions.push(letter + i);
        }
      }
    });

    machineOptions = machineOptions.concat(['MP', 'SP1', 'SP2', 'SP3']);

    function updateProcessStandardDieForRow(rowIndex) {

      var basicRow = basicTableBody.children[rowIndex];
      var mainPressureInput = basicRow.querySelector('input[name="main_pressure[]"]');
      var processSelect = basicRow.querySelector('input[name="proses[]"]');
      var mainPressure = parseFloat(mainPressureInput.value) || 0;
      var process = processSelect.value;
      var valueToSet = "";
      if (mainPressure > 3914) {
        if (["DRAW", "FORM", "FORM-BEND", "BEND1-BEND2", "BEND", "BEND-REST", "BEND-FL", "FORM-FL"].includes(process)) {
          valueToSet = "BIG DIE|SINGLE|DRAW";
        } else if (process === "FLANGE") {
          valueToSet = "BIG DIE|SINGLE|FLANGE";
        } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-TRIM", "REST", "TR", "CUT"].includes(process)) {
          valueToSet = "BIG DIE|SINGLE|TRIM";
        } else {
          valueToSet = "";
        }
      } else if (mainPressure >= 848 && mainPressure <= 3914) {
        if (["DRAW", "FORM", "FORM-BEND", "FORM-FL", "BEND", "BEND-REST", "BEND-FL", "BEND1-BEND2"].includes(process)) {
          valueToSet = "MEDIUM DIE|SINGLE|DRAW";
        } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-PIE", "SEP-TRIM", "REST"].includes(process)) {
          valueToSet = "MEDIUM DIE|SINGLE|TRIM";
        } else if (process === "FLANGE") {
          valueToSet = "MEDIUM DIE|SINGLE|FLANGE";
        } else {
          valueToSet = "";
        }
      } else {
        if (["DRAW", "FORM", "FORM-BEND", "BEND1-BEND2", "BEND", "BEND-REST"].includes(process)) {
          valueToSet = "SMALL DIE|SINGLE|FORMING";
        } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-TRIM", "REST", "TR", "CUT"].includes(process)) {
          valueToSet = "SMALL DIE|SINGLE|BLANK";
        } else {
          valueToSet = "SMALL DIE";
        }
      }
      
      var dieRow = dieTableBody.children[rowIndex];
      if (dieRow) {
        var psdInput = dieRow.querySelector('input[name="die_proses_standard_die[]"]');
        if (psdInput) {
          psdInput.value = valueToSet;
          console.log(psdInput);
        }
      }
    }

    for (var i = 0; i < totalDies; i++) {
      var basicRow = document.createElement('tr');

      var cell1 = document.createElement('td');
      var select1 = document.createElement('select');
      select1.name = 'process[]';
      select1.className = 'custom-select2 form-control';
      processOptions.forEach(function(opt, index) {
        var option = document.createElement('option');
        option.value = opt;
        option.textContent = opt;
        if (i === index) { option.selected = true; }
        select1.appendChild(option);
      });
     
      select1.addEventListener('change', function() {

        calculateTotalMP();
        generateDieConstructionTable();
        var basicRow = this.closest('tr');
        var basicRows = Array.from(basicTableBody.children);
        var rowIndex = basicRows.indexOf(basicRow);
        
        
        updateProcessStandardDieForRow(rowIndex);
        
      
        var dieImageBody = document.getElementById('dieImage');
        var dieImageRow = dieImageBody.children[rowIndex];
        if (dieImageRow) {
          var processImgInput = dieImageRow.querySelector('input[name="die_image_process[]"]');
          if (processImgInput) {
            processImgInput.value = this.value;
          }
        }
        
        var dieRow = dieTableBody.children[rowIndex];
        if (dieRow) {
          var dieProcessInput = dieRow.querySelector('input[name="die_proses[]"]');
          if (dieProcessInput) {
            dieProcessInput.value = this.value;
          }
        }
      });

      cell1.appendChild(select1);
      basicRow.appendChild(cell1);

      var celljoin = document.createElement('td');
      var selectjoin = document.createElement('select');
      selectjoin.name = 'process_join[]';
      selectjoin.className = 'custom-select2 form-control';
      var defaultOptJoin = document.createElement('option');
      defaultOptJoin.value = "";
      defaultOptJoin.textContent = "Pilih";
      selectjoin.appendChild(defaultOptJoin);
      processOptions.forEach(function(opt, index) {
        var option = document.createElement('option');
        option.value = opt;
        option.textContent = opt;
        // if (i === index) { option.selected = true; }
        selectjoin.appendChild(option);
      });
     
      selectjoin.addEventListener('change', function() {

        calculateTotalMP();
        generateDieConstructionTable();
        var basicRow = this.closest('tr');
        var basicRows = Array.from(basicTableBody.children);
        var rowIndex = basicRows.indexOf(basicRow);
      
        updateProcessStandardDieForRow(rowIndex);

        var dieImageBody = document.getElementById('dieImage');
        var dieImageRow = dieImageBody.children[rowIndex];
        if (dieImageRow) {
          var processImgInput = dieImageRow.querySelector('input[name="die_image_process[]"]');
          if (processImgInput) {
            processImgInput.value = this.value;
          }
        }
      });
      celljoin.appendChild(selectjoin);
      basicRow.appendChild(celljoin);
      var cellProcess = document.createElement('td');

      var containerProses = document.createElement('div');
      containerProses.className = 'input-proses';

      // Fungsi untuk membuat dropdown + checkbox CAM
      function createProsesDropdown(name, options) {
          var wrapper = document.createElement('div');
          wrapper.className = 'proses-wrapper';

          var select = document.createElement('select');
          select.className = 'custom-select2 form-control mb-2';
          select.name = name;

          var defaultOption = document.createElement('option');
          defaultOption.value = "";
          defaultOption.textContent = "Pilih";
          select.appendChild(defaultOption);

          options.forEach(function(item) {
              var opt = document.createElement('option');
              opt.value = item;
              opt.textContent = item;
              select.appendChild(opt);
          });

          // Checkbox CAM
          var cb = document.createElement('input');
          cb.type = 'checkbox';
          cb.className = 'proses-checkbox mb-2';
          cb.dataset.selectName = name; // Simpan nama dropdown terkait

          var labelCb = document.createElement('label');
          labelCb.textContent = 'CAM';

          // Tambahkan elemen ke wrapper
          wrapper.appendChild(select);
          wrapper.appendChild(cb);
          wrapper.appendChild(labelCb);

          return { wrapper, select, cb };
      }

      // Buat dropdown dan checkbox CAM untuk setiap proses
      var dp1 = createProsesDropdown('proses_gang_input1', opsi1);
      var dp2 = createProsesDropdown('proses_gang_input2', opsi2);
      var dp3 = createProsesDropdown('proses_gang_input3', opsi3);

      containerProses.appendChild(dp1.wrapper);
      containerProses.appendChild(dp2.wrapper);
      containerProses.appendChild(dp3.wrapper);

      // Input tersembunyi untuk menyimpan hasil gabungan proses
      var inputProsesHidden = document.createElement('input');
      inputProsesHidden.type = 'text';
      inputProsesHidden.readOnly = true;
      inputProsesHidden.className = 'form-control';
      inputProsesHidden.name = 'proses[]';
      containerProses.appendChild(inputProsesHidden);

      // Fungsi untuk mengupdate input tersembunyi berdasarkan dropdown & checkbox
      function updateProsesHidden(row) {
          var containerProses = row.querySelector('.input-proses');
          if (!containerProses) return;

          var selects = containerProses.querySelectorAll('select');
          var checkboxes = containerProses.querySelectorAll('.proses-checkbox');
          var hidden = containerProses.querySelector('input[name="proses[]"]');

          var gabungan = [];

          selects.forEach((select, index) => {
              if (select.value) {
                  var value = select.value;
                  if (checkboxes[index].checked) {
                      value = "CAM " + value;
                  }
                  gabungan.push(value);
              }
          });

          hidden.value = gabungan.join('-');
          hidden.setAttribute('value', hidden.value);
          console.log("Updated proses hidden in row:", hidden.value);
      }

      // Pasang event listener pada dropdown & checkbox
      [dp1.select, dp1.cb, dp2.select, dp2.cb, dp3.select, dp3.cb].forEach(function(el) {
          el.addEventListener('change', function() {
              var row = this.closest('tr');
              if (!row) return;

              updateProsesHidden(row);

              var rowIndex = Array.from(basicTableBody.children).indexOf(row);
              if (rowIndex !== -1 && typeof updateDCProcessDropdown === "function") {
                  updateDCProcessDropdown(rowIndex);
              } else {
                  console.error("updateDCProcessDropdown tidak ditemukan atau rowIndex tidak valid");
              }
          });
      });

      // Inisialisasi nilai awal
      updateProsesHidden(basicRow);

      cellProcess.appendChild(containerProses);
      basicRow.appendChild(cellProcess);


    var cellProsesGang = document.createElement('td');
    cellProsesGang.className = 'cell-proses-gang';

    var containerGang = document.createElement('div');
    containerGang.className = 'input-proses-gang';

    // Function to create dropdown + CAM checkbox
    function createGangDropdown(name, options) {
        var wrapper = document.createElement('div');
        wrapper.className = 'gang-wrapper';

        var select = document.createElement('select');
        select.className = 'custom-select2 form-control mb-2';
        select.name = name;

        var defaultOption = document.createElement('option');
        defaultOption.value = "";
        defaultOption.textContent = "Pilih";
        select.appendChild(defaultOption);

        options.forEach(function(item) {
            var opt = document.createElement('option');
            opt.value = item;
            opt.textContent = item;
            select.appendChild(opt);
        });

        // CAM Checkbox
        var cbGang = document.createElement('input');
        cbGang.type = 'checkbox';
        cbGang.className = 'gang-checkbox mb-2';
        cbGang.dataset.selectName = name; // Store dropdown name for reference

        var labelGang = document.createElement('label');
        labelGang.textContent = 'CAM';

        // Append elements
        wrapper.appendChild(select);
        wrapper.appendChild(cbGang);
        wrapper.appendChild(labelGang);

        return { wrapper, select, cbGang };
    }

    // Create Dropdowns with Checkboxes
    var gang1 = createGangDropdown('gang1[]', opsi1);
    var gang2 = createGangDropdown('gang2[]', opsi2);
    var gang3 = createGangDropdown('gang3[]', opsi3);

    containerGang.appendChild(gang1.wrapper);
    containerGang.appendChild(gang2.wrapper);
    containerGang.appendChild(gang3.wrapper);

    // Hidden input to store combined values
    var inputGangHidden = document.createElement('input');
    inputGangHidden.type = 'text';
    inputGangHidden.readOnly = true;
    inputGangHidden.className = 'form-control';
    inputGangHidden.name = 'proses_gang[]';
    containerGang.appendChild(inputGangHidden);

    // Function to update hidden input
    function updateProsesGangHidden(row) {
        var containerGang = row.querySelector('.input-proses-gang');
        if (!containerGang) return;

        var selects = containerGang.querySelectorAll('select');
        var checkboxes = containerGang.querySelectorAll('.gang-checkbox');
        var hidden = containerGang.querySelector('input[name="proses_gang[]"]');

        var gabunganGang = [];

        selects.forEach((select, index) => {
            if (select.value) {
                var value = select.value;
                if (checkboxes[index].checked) {
                    value = "CAM " + value;
                }
                gabunganGang.push(value);
            }
        });

        hidden.value = gabunganGang.join('-');
        hidden.setAttribute('value', hidden.value);
        console.log("Updated gang hidden in row:", hidden.value);
    }

    // Attach event listeners for updating hidden input
    [gang1.select, gang1.cbGang, gang2.select, gang2.cbGang, gang3.select, gang3.cbGang].forEach(function(el) {
        el.addEventListener('change', function() {
            var row = this.closest('tr');
            if (row) {
                updateProsesGangHidden(row);
            }
        });
    });

    // Initial update
    updateProsesGangHidden(basicRow);
    cellProsesGang.appendChild(containerGang);
    basicRow.appendChild(cellProsesGang);


      var panjang = document.createElement('td');
      var inputPanjang = document.createElement('input');
      inputPanjang.type = 'number';
      inputPanjang.name = 'panjang[]';
      inputPanjang.placeholder = 'Panjang Part ';
      inputPanjang.className = 'form-control';
      inputPanjang.setAttribute("oninput", "calculateLuas(this)");
      panjang.appendChild(inputPanjang);
      basicRow.appendChild(panjang);

      var lebar = document.createElement('td');
      var inputLebar = document.createElement('input');
      inputLebar.type = 'number';
      inputLebar.name = 'lebar[]';
      inputLebar.placeholder = 'Lebar Part ';
      inputLebar.className = 'form-control';
      inputLebar.setAttribute("oninput", "calculateLuas(this)");
      lebar.appendChild(inputLebar);
      basicRow.appendChild(lebar);
     
      var cell4 = document.createElement('td');
      var input4 = document.createElement('input');
      input4.type = 'text';
      input4.name = 'length_mp[]';
      input4.placeholder = 'Keliling ';
      input4.readOnly = true;
      input4.className = 'form-control';
      input4.setAttribute("oninput", "calculateMainPressure(this)");
      cell4.appendChild(input4);
      basicRow.appendChild(cell4);

     
      var cell5 = document.createElement('td');
      var input5 = document.createElement('input');
      input5.type = 'text';
      input5.name = 'main_pressure[]';
      input5.placeholder = 'Main Pressure';
      input5.className = 'form-control';
      input5.readOnly = true;
       input5.addEventListener('change', updateProcessStandardDie);
      cell5.appendChild(input5);
      basicRow.appendChild(cell5);

      
      var cellMachine = document.createElement('td');
      var selectMachine = document.createElement('select');
      selectMachine.name = 'machine[]';
      selectMachine.id = 'machine[]';
      cellMachine.style.display = 'none'; 
      selectMachine.className = 'custom-select2 form-control';
      machineOptions.forEach(function(opt) {
        var option = document.createElement('option');
        option.value = opt;
        option.textContent = opt;
        selectMachine.appendChild(option);
      });
      selectMachine.addEventListener('change', function() {
        onMachineChange(this);
        calculateTotalMP();
        generateDieConstructionTable();
        var row = this.closest('tr');
            var rowIndex = Array.from(basicTableBody.children).indexOf(row);
            updateDCProcessDropdown(rowIndex);
      });
      cellMachine.appendChild(selectMachine);
      basicRow.appendChild(cellMachine);

      
      var cellCapacity = document.createElement('td');
      cellCapacity.style.display = 'none'; 
      var inputCapacity = document.createElement('input');
      inputCapacity.type = 'text';
      inputCapacity.name = 'capacity[]';
      inputCapacity.placeholder = 'Capacity';
      inputCapacity.className = 'form-control';
      inputCapacity.readOnly = true;
      cellCapacity.appendChild(inputCapacity);
      basicRow.appendChild(cellCapacity);

      // Cushion

      var cellCushion = document.createElement('td');
      cellCushion.style.display = 'none'; 
      var inputCushion = document.createElement('input');
      inputCushion.type = 'text';
      inputCushion.name = 'cushion[]';
      inputCushion.placeholder = 'Cushion';
      inputCushion.className = 'form-control';
      inputCushion.readOnly = true;
      cellCushion.appendChild(inputCushion);
      basicRow.appendChild(cellCushion);

      basicTableBody.appendChild(basicRow);

     
      var dieRow = document.createElement('tr');
      var dieProcessCell = document.createElement('td');
      var dieProcessInput = document.createElement('input');
      dieProcessInput.type = 'text';
      dieProcessInput.name = 'die_proses[]';
      dieProcessInput.value = processOptions[i];

      dieProcessInput.className = 'form-control';
      dieProcessInput.readOnly = true;
      dieProcessCell.appendChild(dieProcessInput);
      dieRow.appendChild(dieProcessCell);

      var dieProsesStdCell = document.createElement('td');
      var select = document.createElement('select');
      select.name = 'die_proses_standard_die[]';
      select.className = 'form-control';

      var options = [
        { value: "BIG DIE|SINGLE|DRAW",           text: "BIG DIE, SINGLE, DRAW" },
        { value: "BIG DIE|SINGLE|DEEP DRAW",        text: "BIG DIE, SINGLE, DEEP DRAW" },
        { value: "BIG DIE|SINGLE|TRIM",             text: "BIG DIE, SINGLE, TRIM" },
        { value: "BIG DIE|SINGLE|FLANGE",          text: "BIG DIE, SINGLE, FLANGE" },
        { value: "BIG DIE|SINGLE|CAM FLANGE",       text: "BIG DIE, SINGLE, CAM FLANGE" },
        { value: "MEDIUM DIE|SINGLE|DRAW",          text: "MEDIUM DIE, SINGLE, DRAW" },
        { value: "MEDIUM DIE|SINGLE|TRIM",          text: "MEDIUM DIE, SINGLE, TRIM" },
        { value: "MEDIUM DIE|SINGLE|FLANGE",        text: "MEDIUM DIE, SINGLE, FLANGE" },
        { value: "MEDIUM DIE|SINGLE|CAM PIE",       text: "MEDIUM DIE, SINGLE, CAM PIE" },
        { value: "MEDIUM DIE|GANG|DRAW",            text: "MEDIUM DIE, GANG, DRAW" },
        { value: "MEDIUM DIE|GANG|TRIM",            text: "MEDIUM DIE, GANG, TRIM" },
        { value: "MEDIUM DIE|GANG|FLANGE-CAM PIE",  text: "MEDIUM DIE, GANG, FLANGE-CAM PIE" },
        { value: "SMALL DIE|SINGLE|BLANK",           text: "SMALL DIE, SINGLE, BLANK" },
        { value: "SMALL DIE|SINGLE|FORMING",         text: "SMALL DIE, SINGLE, FORMING" },
        { value: "SMALL DIE|SINGLE|CAM PIE",         text: "SMALL DIE, SINGLE, CAM PIE" },
        { value: "SMALL DIE|GANG|FORM-FLANGE",       text: "SMALL DIE, GANG, FORM-FLANGE" },
        { value: "SMALL DIE|GANG|BEND 1, BEND 2",     text: "SMALL DIE, GANG, BEND 1, BEND 2" },
        { value: "SMALL DIE|GANG|FORMING, PIE",       text: "SMALL DIE, GANG, FORMING, PIE" },
        { value: "SMALL DIE|PROGRESSIVE|BLANK-PIE",    text: "SMALL DIE, PROGRESSIVE, BLANK-PIE" }
      ];

      options.forEach(function(opt) {
          var option = document.createElement('option');
            option.value = opt.value;
            option.textContent = opt.text;
            select.appendChild(option);
            
          });
          select.addEventListener('change', function() {
    
      });

    dieProsesStdCell.appendChild(select);
    dieRow.appendChild(dieProsesStdCell);


    // Die Length
    var cellDieLength = document.createElement('td');
    var inputDieLength = document.createElement('input');
    inputDieLength.type = 'text';
    inputDieLength.name = 'die_length[]';
    inputDieLength.placeholder = 'Die Length';
    inputDieLength.readOnly = true;
    inputDieLength.className = 'form-control';
    inputDieLength.setAttribute("oninput", "calculateDieWeight(this)");
    cellDieLength.appendChild(inputDieLength);
    dieRow.appendChild(cellDieLength);

    // Die Width
    var cellDieWidth = document.createElement('td');
    var inputDieWidth = document.createElement('input');
    inputDieWidth.type = 'text';
    inputDieWidth.name = 'die_width[]';
    inputDieWidth.placeholder = 'Die Width';
    inputDieWidth.className = 'form-control';
    inputDieWidth.readOnly = true;
    inputDieWidth.setAttribute("oninput", "calculateDieWeight(this)");
    cellDieWidth.appendChild(inputDieWidth);
    dieRow.appendChild(cellDieWidth);

    // Die Height
    var cellDieHeight = document.createElement('td');
    var inputDieHeight = document.createElement('input');
    inputDieHeight.type = 'text';
    inputDieHeight.name = 'die_height[]';
    inputDieHeight.placeholder = 'Die Height';
    inputDieHeight.className = 'form-control';
    inputDieHeight.readOnly = true;
    inputDieHeight.setAttribute("oninput", "calculateDieWeight(this)");
    cellDieHeight.appendChild(inputDieHeight);
    dieRow.appendChild(cellDieHeight);

    // Casting/Plate
    var cellCastingPlate = document.createElement('td');
    var selectCastingPlate = document.createElement('select');
    selectCastingPlate.name = 'casting_plate[]';
    selectCastingPlate.className = 'custom-select2 form-control';

    var optionCasting = document.createElement('option');
    optionCasting.value = 'casting';
    optionCasting.textContent = 'Casting';
    optionCasting.selected = true;

    var optionPlate = document.createElement('option');
    optionPlate.value = 'plate';
    optionPlate.textContent = 'Plate';

    selectCastingPlate.appendChild(optionCasting);
    selectCastingPlate.appendChild(optionPlate);

    selectCastingPlate.addEventListener('change', function() {
      calculateDieWeight(this);
    });

    cellCastingPlate.appendChild(selectCastingPlate);
    dieRow.appendChild(cellCastingPlate);


    // Die Weight
    var cellDieWeight = document.createElement('td');
    var inputDieWeight = document.createElement('input');
    inputDieWeight.type = 'text';
    inputDieWeight.name = 'die_weight[]';
    inputDieWeight.placeholder = 'Die Weight';
    inputDieWeight.className = 'form-control';
    inputDieWeight.readOnly = true;
    cellDieWeight.appendChild(inputDieWeight);
    dieRow.appendChild(cellDieWeight);

    dieTableBody.appendChild(dieRow);

    
    var dieImageRow = document.createElement('tr');
    var dieImageCell = document.createElement('td');
    var dieImageProcessInput = document.createElement('input');
    dieImageProcessInput.type = 'text';
    dieImageProcessInput.name = 'die_image_process[]';
    dieImageProcessInput.value = select1.value;
    dieImageProcessInput.className = 'form-control';
    dieImageProcessInput.readOnly = true;
    dieImageCell.appendChild(dieImageProcessInput);
    dieImageRow.appendChild(dieImageCell);
        // Kolom C-Layout
    var clayoutCell = document.createElement('td');

    // 1. Input upload gambar
    var clayoutInput = document.createElement('input');
    clayoutInput.type = 'file';
    clayoutInput.name = 'c_layout[]';
    clayoutInput.className = 'form-control mb-2';
    clayoutInput.accept = 'image/*';
    clayoutCell.appendChild(clayoutInput);

    // 2. Preview upload langsung
    var clayoutPreview = document.createElement('img');
    clayoutPreview.style.maxWidth = '100px';
    clayoutPreview.style.marginTop = '5px';
    clayoutPreview.style.display = 'none';
    clayoutCell.appendChild(clayoutPreview);

    // 3. Container list gambar
    var clayoutImageList = document.createElement('div');
    clayoutImageList.className = 'dcp-image-list mb-2';
    clayoutImageList.style.display = 'flex';
    clayoutImageList.style.flexWrap = 'wrap';
    clayoutImageList.style.gap = '10px';
    clayoutCell.appendChild(clayoutImageList);

    // 4. Hidden input untuk simpan path gambar terpilih
    var clayoutHiddenInput = document.createElement('input');
    clayoutHiddenInput.type = 'hidden';
    clayoutHiddenInput.name = 'c_layout_selected[]';
    clayoutHiddenInput.className = 'selected-image';
    clayoutCell.appendChild(clayoutHiddenInput);

    // 5. Preview saat upload
    clayoutInput.addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            clayoutPreview.src = URL.createObjectURL(e.target.files[0]);
            clayoutPreview.style.display = 'block';

            clayoutHiddenInput.value = '';
            clayoutImageList.querySelectorAll('img').forEach(img => {
                img.style.border = '2px solid transparent';
            });
        }
    });

    // 6. Tambahkan ke baris
    dieImageRow.appendChild(clayoutCell);

    // 7. Load gambar
    loadDcpImages(clayoutImageList, clayoutHiddenInput);



    // Kolom Die Construction
    var dieConstrCell = document.createElement('td');

    // 1. Input upload gambar
    var dieConstrInput = document.createElement('input');
    dieConstrInput.type = 'file';
    dieConstrInput.name = 'die_construction_img[]';
    dieConstrInput.className = 'form-control mb-2';
    dieConstrInput.accept = 'image/*';
    dieConstrCell.appendChild(dieConstrInput);

    // 2. Preview upload langsung
    var dieConstrPreview = document.createElement('img');
    dieConstrPreview.style.maxWidth = '100px';
    dieConstrPreview.style.marginTop = '5px';
    dieConstrPreview.style.display = 'none';
    dieConstrCell.appendChild(dieConstrPreview);

    // 3. Container list gambar
    var dieConstrImageList = document.createElement('div');
    dieConstrImageList.className = 'dcp-image-list mb-2';
    dieConstrImageList.style.display = 'flex';
    dieConstrImageList.style.flexWrap = 'wrap';
    dieConstrImageList.style.gap = '10px';
    dieConstrCell.appendChild(dieConstrImageList);

    // 4. Hidden input untuk simpan path gambar terpilih
    var dieConstrHiddenInput = document.createElement('input');
    dieConstrHiddenInput.type = 'hidden';
    dieConstrHiddenInput.name = 'die_cons_selected[]';
    dieConstrHiddenInput.className = 'selected-image';
    dieConstrCell.appendChild(dieConstrHiddenInput);

    // 5. Preview saat upload
    dieConstrInput.addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            dieConstrPreview.src = URL.createObjectURL(e.target.files[0]);
            dieConstrPreview.style.display = 'block';

            dieConstrHiddenInput.value = '';
            dieConstrImageList.querySelectorAll('img').forEach(img => {
                img.style.border = '2px solid transparent';
            });
        }
    });

    // 6. Tambahkan ke baris
    dieImageRow.appendChild(dieConstrCell);

    // 7. Load gambar
    loadDcpImages(dieConstrImageList, dieConstrHiddenInput);


    // Kolom Aksi: tombol hapus
    // var aksiCell = document.createElement('td');
    // var deleteButton = document.createElement('button');
    // deleteButton.type = 'button';
    // deleteButton.className = 'btn btn-danger btn-sm';
    // deleteButton.textContent = 'Hapus';
    // deleteButton.addEventListener('click', function() {
    //   var row = this.closest('tr');
    //   row.parentNode.removeChild(row);
    // });
    // aksiCell.appendChild(deleteButton);
    // dieImageRow.appendChild(aksiCell);
    
    dieImageBody.appendChild(dieImageRow);
  }
    calculateTotalMP();
    
    document.getElementById('total_stroke').value = document.getElementById('total_dies').value;
    generateDieConstructionTable(); 
  }
  // function changeStandardDesign(el) {
  //   // Cari baris (tr) terdekat dari elemen yang memicu event di Basic Table
  //   var basicRow = el.closest('tr');
  //   if (!basicRow) return;

  //   // Ambil nilai main_pressure dan proses dari Basic Table
  //   var mainPressureInput = basicRow.querySelector('input[name="main_pressure[]"]');
  //   var processSelect = basicRow.querySelector('select[name="proses[]"]');
  //   if (!mainPressureInput || !processSelect) return;
    
  //   var mainPressure = parseFloat(mainPressureInput.value) || 0;
  //   var processVal = processSelect.value;
  //   var valueToSet = "";
    
  //   if (machine > 3914) {
  //     if (["DRAW", "FORM", "FORM-BEND", "BEND1-BEND2", "BEND", "BEND-REST", "BEND-FL", "FORM-FL"].includes(processVal)) {
  //       valueToSet = "BIG DIE|SINGLE|DRAW";
  //     } else if (processVal === "FLANGE") {
  //       valueToSet = "BIG DIE|SINGLE|FLANGE";
  //     } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-TRIM", "REST", "TR", "CUT"].includes(processVal)) {
  //       valueToSet = "BIG DIE|SINGLE|TRIM";
  //     } else {
  //       valueToSet = "";
  //     }
  //   } else if (machine >= 848 && machine <= 3914) {
  //     if (["DRAW", "FORM", "FORM-BEND", "FORM-FL", "BEND", "BEND-REST", "BEND-FL", "BEND1-BEND2"].includes(processVal)) {
  //       valueToSet = "MEDIUM DIE|SINGLE|DRAW";
  //     } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-PIE", "SEP-TRIM", "REST"].includes(processVal)) {
  //       valueToSet = "MEDIUM DIE|SINGLE|TRIM";
  //     } else if (processVal === "FLANGE") {
  //       valueToSet = "MEDIUM DIE|SINGLE|FLANGE";
  //     } else {
  //       valueToSet = "";
  //     }
  //   } else {
  //     if (["DRAW", "FORM", "FORM-BEND", "BEND1-BEND2", "BEND", "BEND-REST"].includes(processVal)) {
  //       valueToSet = "SMALL DIE|SINGLE|FORMING";
  //     } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-TRIM", "REST", "TR", "CUT"].includes(processVal)) {
  //       valueToSet = "SMALL DIE|SINGLE|BLANK";
  //     } else {
  //       valueToSet = "SMALL DIE";
  //     }
  //   }
    
  //   // Dapatkan row index dari Basic Table
  //   var basicTableBody = document.getElementById('basicTableBody');
  //   var basicRows = Array.from(basicTableBody.children);
  //   var rowIndex = basicRows.indexOf(basicRow);

  //   // Gunakan rowIndex untuk mendapatkan row yang sama di Die Table
  //   var dieTableBody = document.getElementById('dieTableBody');
  //   if (!dieTableBody || !dieTableBody.children[rowIndex]) return;
  //   var dieRow = dieTableBody.children[rowIndex];
    
  //   // Ambil select die_proses_standard_die pada row Die Table
  //   var dieStandardSelect = dieRow.querySelector('select[name="die_proses_standard_die[]"]');
  //   if (dieStandardSelect) {
  //     dieStandardSelect.value = valueToSet;
  //   }
  // }


  function updateProcessStandardDie() {
   
    const mainPressureInput = document.getElementById("main_pressure");
    const processSelect = document.getElementById("process");
    const processStandardDie = document.getElementById("process_standard_die");

    let mainPressure = parseFloat(mainPressureInput.value) || 0;
    let process = processSelect.value;

    if (mainPressure > 3914) {
      if (["DRAW", "FORM", "BEND"].includes(process)) {
        processStandardDie.value = "BIG DIE|SINGLE|DRAW";
      } else if (process === "FLANGE") {
        processStandardDie.value = "BIG DIE|SINGLE|FLANGE";
      } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-TRIM", "REST", "TR", "CUT"].includes(process)) {
        processStandardDie.value = "BIG DIE|SINGLE|TRIM";
      } else {
        processStandardDie.value = "";
      }
    } else if (mainPressure >= 848 && mainPressure <= 3914) {
      if (["DRAW", "FORM", "FORM-BEND", "FORM-FL", "BEND", "BEND-REST", "BEND-FL", "BEND1-BEND2"].includes(process)) {
        processStandardDie.value = "MEDIUM DIE|SINGLE|DRAW";
      } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-PIE", "SEP-TRIM", "REST"].includes(process)) {
        processStandardDie.value = "MEDIUM DIE|SINGLE|TRIM";
      } else if (process === "FLANGE") {
        processStandardDie.value = "MEDIUM DIE|SINGLE|FLANGE";
      } else {
        processStandardDie.value = "";
      }
    } else {
      if (["DRAW", "FORM", "FORM-BEND", "BEND1-BEND2", "BEND", "BEND-REST"].includes(process)) {
        processStandardDie.value = "SMALL DIE|SINGLE|FORMING";
      } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-TRIM", "REST", "TR", "CUT"].includes(process)) {
        processStandardDie.value = "SMALL DIE|SINGLE|BLANK";
      } else {
        processStandardDie.value = "SMALL DIE";
      }
    }
  }
 
  function calculateTotalMP() {
    var table = document.getElementById('basicTableBody');
    var machineSelects = table.querySelectorAll('select[name="machine[]"]');
    var totalMP = 0;

    for (var i = 0; i < machineSelects.length; i++) {
        var machineVal = machineSelects[i].value;
        if (machineVal.toUpperCase().indexOf("E") !== -1) {
            totalMP = 3; // jika ada mesin mengandung "E", langsung 3
            break;       // hentikan perulangan karena E langsung override
        } else if(machineVal.toUpperCase().includes("SP")) {
            totalMP += 1;
        } else {
            totalMP += 2;
        }
    }

    document.getElementById('total_mp').value = totalMP;
}

    function calculateLuas(element) {
      var row = element.closest('tr');

        var panjang = row.querySelector('input[name="panjang[]"]').value;
        var lebar = row.querySelector('input[name="lebar[]"]').value;

        var panjangValue = parseFloat(panjang) || 0;
        var lebarValue = parseFloat(lebar) || 0;

        var luas = 2*panjangValue + 2*lebarValue;

        // Masukkan hasil ke input length_mp yang sesuai
        var lengthMpInput = row.querySelector('input[name="length_mp[]"]');
        if (lengthMpInput) {
            lengthMpInput.value = luas;
            calculateMainPressure(row);
        }
    }

  function generateDieConstructionTable() {
    var processSelects = document.getElementsByName('process[]');
    var machineSelects = document.getElementsByName('machine[]');
    var prosesSelects = document.getElementsByName('proses[]');
    var dieConstructionBody = document.getElementById('dieConstructionTableBody');
    dieConstructionBody.innerHTML = ""; 

    var angka = document.getElementById('material').value;
    var material = parseFloat(angka.replace(/\D/g, ''));
    var tonasi = parseFloat(document.getElementById('tonasi').value) || 0;

    for (var i = 0; i < processSelects.length; i++) {
      var processValue = processSelects[i].value;
      var machineValue = machineSelects[i].value;
      var prosesValue = prosesSelects[i].value;

      var upperValue = (machineValue.includes("SP") || machineValue.includes("MP")) ? "SS41" : "FC300";
      var lowerValue = upperValue; 

      var padValue = (machineValue.includes("SP") || machineValue.includes("MP")) ? "S45C" : "FCD55";

      var insertVal;
      if (material > 440 && tonasi > 1) {
        insertVal = "SKD11";
      } else if (
        prosesValue.includes("FL") ||
        prosesValue.includes("DR") ||
        prosesValue.includes("BE") ||
        prosesValue.includes("RE") ||
        prosesValue.includes("FO")
      ) {
        insertVal = "SXACE";
      } else if (prosesValue.includes("PI")) {
        insertVal = "S45C";
      } else if (
        prosesValue.includes("BL") ||
        prosesValue.includes("TR") ||
        prosesValue.includes("SEP") ||
        prosesValue.includes("CUT")
      ) {
        insertVal = "SKD11";
      } else {
        insertVal = "";
      }
      var heat_treatment = (insertVal === "SXACE") ? "FULLHARD + COATING" : "FLAMEHARD";

      var padLifterValue = (
        prosesValue.includes("FL") || 
        prosesValue.includes("DR") || 
        prosesValue.includes("FL") || 
        prosesValue.includes("BE") || 
        prosesValue.includes("RE") || 
        prosesValue.includes("FO")
      ) ? "Coil Spring" : "Gas Spring";

      var slidingValue = "Wear Plate";

      var guideValue;
      if (machineValue.includes("SP") || machineValue.includes("MP")) {
        guideValue = "Guide Post";
      } else if (prosesValue.includes("BL") || prosesValue.includes("CUT") || prosesValue.includes("TR")) {
        guideValue = "Guide Post";
      } else {
        guideValue = "Guide Heel";
      }

      var tr = document.createElement("tr");

      function createTdInput(name, value) {
    var td = document.createElement("td");
    var input = document.createElement("input");
    input.type = "text";
    input.value = value;
    input.name = name;
    input.className = "form-control text-wrap"; // Menggunakan class wrap-text untuk efek ellipsis
    input.style.width = "100%"; // Pastikan input menyesuaikan lebar kolom
    td.appendChild(input);
    return td;
}

function createTdInputR(name, value) {
    var td = document.createElement("td");
    var input = document.createElement("input");
    input.type = "text";
    input.value = value;
    input.name = name;
    input.readOnly = true;
    input.className = "form-control text-wrap"; // Menggunakan class wrap-text untuk efek ellipsis
    input.style.width = "100%"; // Pastikan input menyesuaikan lebar kolom
    td.appendChild(input);
    return td;
}


    tr.appendChild(createTdInputR("process2[]", prosesValue));    // Process (readonly)
    tr.appendChild(createTdInputR("machine2[]", machineValue));     // Machine (readonly)
    tr.appendChild(createTdInput("upper[]", upperValue));             // Upper
    tr.appendChild(createTdInput("lower[]", lowerValue));             // Lower
    tr.appendChild(createTdInput("pad[]", padValue));                 // Pad (editable dengan suggestion)
    tr.appendChild(createTdInput("pad_lifter[]", padLifterValue));    // Pad Lifter (editable dengan suggestion)
    tr.appendChild(createTdInput("sliding[]", slidingValue));         // Sliding
    tr.appendChild(createTdInput("guide[]", guideValue));             // Guide (editable dengan suggestion)
    tr.appendChild(createTdInput("insert[]", insertVal));             // Insert (editable dengan suggestion)
    tr.appendChild(createTdInput("heat_treatment[]", heat_treatment));  // Heat Treatment (editable dengan suggestion)
    
    // Kolom Upload Gambar (misalnya kosong atau nanti diisi)
    // var tdUpload = document.createElement("td");
    // tdUpload.innerHTML = "";
    // tr.appendChild(tdUpload);


      dieConstructionBody.appendChild(tr);
    }
  }
  function calculateMainPressure(element) {
     
      if (!element) return;

      var row = element.closest('tr');
      if (!row) return;

      var panjangInput = row.querySelector('input[name="panjang[]"]');
      var lebarInput = row.querySelector('input[name="lebar[]"]');
      if (!panjangInput || !lebarInput) return;

      var panjang = panjangInput.value;
      var lebar = lebarInput.value;
      if (!panjang || !lebar) return;

      var lengthMpInput = row.querySelector('input[name="length_mp[]"]');
      if (!lengthMpInput) return;
      var length_mp = parseFloat(lengthMpInput.value) || 0;

      var materialEl = document.getElementById('material');
      if (!materialEl) return;
      var materialText = materialEl.value;
      var materialMatch = materialText.match(/\d+/); 
      var material = materialMatch ? parseInt(materialMatch[0]) : 0;

      var tensile_material;
      if (material === 270) {
          tensile_material = 30;
      } else if (material === 440) {
          tensile_material = 45;
      } else if (material === 590) {
          tensile_material = 60;
      } else {
          tensile_material = 100;
      }

      var tonasiEl = document.getElementById('tonasi');
      if (!tonasiEl) return;
      var thickness = parseFloat(tonasiEl.value) || 0;

      var prosesInput = row.querySelector('input[name="proses[]"]');
      if (!prosesInput) return;
      var proses = prosesInput.value;

      var mainPressureInput = row.querySelector('input[name="main_pressure[]"]');
      if (!mainPressureInput) return;

      var specialProcesses = ["BLANK", "PIE", "TRIM", "SEP"];
      var multiplier = specialProcesses.some(sp => proses.includes(sp)) ? 1 : 2.5;

      var mainPressure = (length_mp * thickness * tensile_material * 1.2 * multiplier) / 1000;
      console.log("Length MP:", length_mp, "Thickness:", thickness, "Tensile Material:", tensile_material, "Multiplier:", multiplier);

      mainPressureInput.value = mainPressure.toFixed(2);
  }

  function calculateDieWeight(element) {
    var row = element.closest('tr');
    var dieLength = parseFloat(row.querySelector('input[name="die_length[]"]').value) || 0;
    var dieWidth = parseFloat(row.querySelector('input[name="die_width[]"]').value) || 0;
    var dieHeight = parseFloat(row.querySelector('input[name="die_height[]"]').value) || 0;
    var dieProsesStandardDieElem = row.querySelector('select[name="die_proses_standard_die[]"]');
    var castplateElem = row.querySelector('select[name="casting_plate[]"]');
    
    if (!dieProsesStandardDieElem || !castplateElem) {
      console.error("Element die_proses_standard_die atau casting_plate tidak ditemukan.", row);
      return;
    }

    var rowIndex = Array.from(row.parentElement.children).indexOf(row);
    var basicTableRow = document.querySelector(`#basicTableBody tr:nth-child(${rowIndex + 1})`);
    var prosesElem = basicTableRow ? basicTableRow.querySelector('input[name="proses[]"]') : null;

    if (!prosesElem) {
      console.error("Element proses tidak ditemukan di tabel basicTableBody untuk baris ke-", rowIndex + 1);
      return;
    }

    var prosesValue = prosesElem.value.toLowerCase();
    var castplateValue = castplateElem.value.toLowerCase();
    var factor = 1;

    // Hitung faktor berdasarkan proses dan jenis casting plate
    if (castplateValue === "casting") {
      if (prosesValue.includes("bend")) { factor = 0.44; }
      else if (prosesValue.includes("form") || prosesValue.includes("rest")) { factor = 0.43; }
      else if (prosesValue.includes("blank")) { factor = 0.40; }
      else if (prosesValue.includes("fl")) { factor = 0.40; }
      else if (prosesValue.includes("pie")) { factor = 0.39; }
      else if (prosesValue.includes("trim") || prosesValue.includes("sep")) { factor = 0.38; }
      else if (prosesValue.includes("draw")) { factor = 0.37; }
      else { factor = 0.44; }
    } else if (castplateValue.includes("plate")) {
      if (prosesValue.includes("blank")) { factor = 0.52; }
      else if (prosesValue.includes("trim") || prosesValue.includes("sep")) { factor = 0.52; }
      else if (prosesValue.includes("bend")) { factor = 0.50; }
      else if (prosesValue.includes("form") || prosesValue.includes("rest")) { factor = 0.50; }
      else if (prosesValue.includes("pie")) { factor = 0.46; }
      else if (prosesValue.includes("fl")) { factor = 0.46; }
      else if (prosesValue.includes("draw")) { factor = 0.45; }
      else { factor = 0.50; }
    }

    console.log("Factor1:", factor + "lengjt"+dieLength+"w"+dieWidth+ "h"+dieHeight);

    // Menghitung berat die
    var dieWeight = (dieLength * dieWidth * dieHeight * factor * 7.85) / 1000000;
    var dieWeightElem = row.querySelector('input[name="die_weight[]"]');
    console.log("Factor:"+ dieWeight);
    if (dieWeightElem) {
      dieWeightElem.value = dieWeight.toFixed(2);
    } else {
      console.error("Element input[name='die_weight[]'] tidak ditemukan.", row);
    }
  }

  function calculateDieWeight2(element) {
      var dieTableRow = element.closest("tr");
      
      var dieTableRows = document.querySelectorAll("#dieTableBody tr");
      var basicTableRows = document.querySelectorAll("#basicTableBody tr");
      
      var rowIndex = Array.from(dieTableRows).indexOf(dieTableRow);

      if (rowIndex >= 0 && rowIndex < basicTableRows.length) {
          var basicTableRow = basicTableRows[rowIndex];
          var prosesElem = basicTableRow.querySelector('input[name="proses[]"]'); 
      } else {
          console.error("Baris tidak ditemukan di basicTableBody");
          return;
      }

      var prosesValue = prosesElem ? prosesElem.value.toLowerCase() : "";
      console.log("Proses yang dipilih:", prosesValue);

      var dieLength = parseFloat(element.closest("tr").querySelector('input[name="die_length[]"]').value) || 0;
      var dieWidth = parseFloat(element.closest("tr").querySelector('input[name="die_width[]"]').value) || 0;
      var dieHeight = parseFloat(element.closest("tr").querySelector('input[name="die_height[]"]').value) || 0;
      var dieProsesStandardDieElem = element.closest("tr").querySelector('select[name="die_proses_standard_die[]"]');
      var castplateElem = element.closest("tr").querySelector('select[name="casting_plate[]"]'); 

      if (!dieProsesStandardDieElem || !castplateElem) {
          return;
      }

      var dieProsesStandardDie = dieProsesStandardDieElem.value.toLowerCase();
      var castplateValue = castplateElem.value.toLowerCase();

      var factor = 1;

      if (castplateValue === "casting") {
          if (prosesValue.includes("bend")) { factor = 0.44; }
          else if (prosesValue.includes("form") || prosesValue.includes("rest")) { factor = 0.43; }
          else if (prosesValue.includes("blank")) { factor = 0.40; }
          else if (prosesValue.includes("flange")) { factor = 0.40; }
          else if (prosesValue.includes("pie")) { factor = 0.39; }
          else if (prosesValue.includes("trim")|| prosesValue.includes("sep")) { factor = 0.38; }
          else if (prosesValue.includes("draw")) { factor = 0.37; }
      } else if (castplateValue.includes("plate")) {
          if (prosesValue.includes("blank")) { factor = 0.52; }
          else if (prosesValue.includes("trim")|| prosesValue.includes("sep")) { factor = 0.52; }
          else if (prosesValue.includes("bend")) { factor = 0.50; }
          else if (prosesValue.includes("form")|| prosesValue.includes("rest")) { factor = 0.50; }
          else if (prosesValue.includes("pie")) { factor = 0.46; }
          else if (prosesValue.includes("fl")) { factor = 0.46; }
          else if (prosesValue.includes("draw")) { factor = 0.45; }
      }

      var dieWeight = (dieLength * dieWidth * dieHeight * factor * 7.85) / 1000000;
      var dieWeightElem = element.closest("tr").querySelector('input[name="die_weight[]"]');

      console.log("Factor2:"+ dieWeight);

      if (dieWeightElem) {
          dieWeightElem.value = dieWeight.toFixed(2);
      } else {
          console.error("Element input[name='die_weight[]'] tidak ditemukan.", row);
      }
  }
  var machineMatchListGlobal = [];
  function fetchMachineData() {
    document.getElementById('errorMessage').innerHTML = '';
    var processes = document.getElementsByName('process[]');
    var prosess   = document.getElementsByName('proses[]');
    var length_mps = document.getElementsByName('length_mp[]');
    var main_pressures = document.getElementsByName('main_pressure[]');
    // Elemen ini adalah dropdown (select) untuk die_proses_standard_die
    // var die_proses_standard_die = document.getElementsByName('die_proses_standard_die[]');
    var process_join = document.getElementsByName('process_join[]');
    var totalRows = processes.length;
    // Validasi input untuk setiap baris
    for (var i = 0; i < totalRows; i++) {
      if (
        processes[i].value === '' ||
        prosess[i].value === '' ||
        length_mps[i].value === '' ||
        main_pressures[i].value === ''
      ) {
        Swal.fire({
          icon: 'error', // Menampilkan ikon error
          title: 'Input Tidak Lengkap!',
          text: 'Pastikan kolom OP, Nama Proses, Keliling, dan Main Pressure tidak kosong pada baris ke-' + (i + 1),
          confirmButtonText: 'OK'
        });
        return;
      }
    }

    var formData = new FormData();
    for (var i = 0; i < totalRows; i++) {
      formData.append('process[]', processes[i].value);
      formData.append('proses[]', prosess[i].value);
      formData.append('length_mp[]', length_mps[i].value);
      formData.append('main_pressure[]', main_pressures[i].value);
      formData.append('process_join[]', process_join[i].value);
      let mainPressure = parseFloat(main_pressures[i].value) || 0;
    
      let prosesVal = prosess[i].value;
      let computedValue = "";


    }
    

    var dieTable = document.getElementById("dieTable"); 
    dieTable.style.display = "block";

    formData.append(csrfName, csrfHash);

    fetch("<?= site_url('pps/fetchMachine') ?>", {
      method: "POST",
      body: formData,
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
      if (data.csrfHash) { csrfHash = data.csrfHash; }
      if (data.error) {
        document.getElementById('errorMessage').innerHTML = data.error;
        Swal.fire({
            icon: 'error', // Menampilkan ikon error
            title: 'Error!',
            text: data.error, // Menampilkan pesan error dari server
            confirmButtonText: 'OK'
        });

      } else if (data.success) {
        var machineSelects = document.getElementsByName('machine[]');
        var capacityInputs = document.getElementsByName('capacity[]');
        var cushionInputs = document.getElementsByName('cushion[]');
        var die_heightInputs = document.getElementsByName('die_height[]');
      
        for (var i = 0; i < machineSelects.length; i++) {
          var machineValue = data.data['machine' + (i + 1)];
          var capacityValue = data.data['capacity' + (i + 1)];
          var cushionValue = data.data['cushion' + (i + 1)];
        
          var die_heightValue = data.data['dh_dies' + (i + 1)];
          console.log('Row ' + (i + 1) + ':', machineValue, capacityValue, cushionValue, die_heightValue);

          if (machineValue) { machineSelects[i].value = machineValue; }
          if (capacityValue && capacityInputs[i]) { capacityInputs[i].value = capacityValue; }
          if (cushionValue && cushionInputs[i]) { cushionInputs[i].value = cushionValue; }
          if (die_heightValue !== undefined && die_heightInputs[i]) {
            die_heightInputs[i].value = die_heightValue;
          }
          generateDieConstructionTable(); 
        }

        var dieProsesSelects = document.querySelectorAll('select[name="die_proses_standard_die[]"]');
        dieProsesSelects.forEach(function(select, index) {
            var selectedValue = data.die_proses_standard_die && data.die_proses_standard_die[index];
            if (selectedValue) {
              
                var options = select.options;
                for (var j = 0; j < options.length; j++) {
                    if (options[j].value === selectedValue) {
                        options[j].selected = true;
                        break;
                    }
                }
            }
        });

      if (data.machine_data) {
        populateNewMasterTable(data.machine_data, data.die_width_standard, data.die_length_standard, data.die_height_standard);
      
      }
      document.getElementById("capacityColumn").style.display = "table-cell";
      document.getElementById("cushionColumn").style.display = "table-cell";
      document.getElementById("machineColumn").style.display = "table-cell";
      

      var capacityCells = document.querySelectorAll('td input[name="capacity[]"]');
      capacityCells.forEach(function(input) {
          input.parentElement.style.display = "table-cell";
      });
      
      var machineCells = document.querySelectorAll('td select[name="machine[]"]');
    machineCells.forEach(function(select) {
    
      select.closest('td').style.display = "table-cell";
    });
      
      var cushionCells = document.querySelectorAll('td input[name="cushion[]"]');
      cushionCells.forEach(function(input) {
          input.parentElement.style.display = "table-cell";
      });
      calculateTotalMP();
      if (data.machine_match_list) {
            machineMatchListGlobal = data.machine_match_list;
        }
      }
    })
    .catch(error => {
      var errorMsg = 'Terjadi kesalahan: ' + error;
      document.getElementById('errorMessage').innerHTML = errorMsg;
      console.error(errorMsg);
      Swal.fire({
          icon: 'error',  // Menampilkan ikon error
          title: 'Terjadi Kesalahan!',
          text: errorMsg, // Menampilkan pesan error
          confirmButtonText: 'OK'
      });

    });
  }
  function showMachineMatchModal() {
      const mainPressureInputs = document.querySelectorAll('input[name="main_pressure[]"]');
      const dieLengthInputs = document.querySelectorAll('input[name="die_length[]"]');
      const dieWidthInputs = document.querySelectorAll('input[name="die_width[]"]');

      let mainPressures = [];
      let dieLengths = [];
      let dieWidths = [];
      let rowIndices = []; // To track which form row each pressure belongs to

      // Collect data and track row indices
      mainPressureInputs.forEach((input, index) => {
          const val = parseFloat(input.value);
          if (!isNaN(val)) {
              mainPressures.push(val);
              rowIndices.push(index); // Store the row index
          }
      });

      dieLengthInputs.forEach(input => {
          const val = parseFloat(input.value);
          if (!isNaN(val)) dieLengths.push(val);
      });

      dieWidthInputs.forEach(input => {
          const val = parseFloat(input.value);
          if (!isNaN(val)) dieWidths.push(val);
      });

      // Show loading state
      const modal = new bootstrap.Modal(document.getElementById('machineMatchModal'));
      const modalBody = document.querySelector('#machineMatchModal .modal-body');
      modalBody.innerHTML = '<div class="text-center py-4"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div><p class="mt-2">Loading machine matches...</p></div>';
      modal.show();

      fetch('/machine-match/checkMatch', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
          },
          body: JSON.stringify({
              main_pressures: mainPressures,
              die_lengths: dieLengths,
              die_widths: dieWidths
          })
      })
      .then(res => {
          if (!res.ok) throw new Error('Network response was not ok');
          return res.json();
      })
      .then(data => {
          let tabHeaderHtml = '';
          let tabContentHtml = '';

          data.forEach((row, index) => {
              const tabId = `pressure-tab-${index}`;
              const activeClass = index === 0 ? 'active' : '';
              const showClass = index === 0 ? 'show active' : '';
              const rowIndex = rowIndices[index]; // Get the corresponding form row index

              let tableRows = '';
              row.matches.forEach(match => {
                  const highlightStyle = match.highlight ? ' style="background-color: #e6ffe6;"' : '';
                  tableRows += `
                      <tr${highlightStyle}>
                          <td>${match.machine}</td>
                          <td>${match.capacity}</td>
                          <td>${match.cushion}</td>
                          <td>${match.bolster_length} x ${match.bolster_width}</td>
                          <td>${match.slide_area_length} x ${match.slide_area_width}</td>
                      <td>${match.match ? '✅ Match' : `❌ ${match.reason}`}</td>

                          
                      </tr>
                  `;
              });

              tabHeaderHtml += `
                  <li class="nav-item" role="presentation">
                      <button class="nav-link ${activeClass}" id="${tabId}-tab" data-bs-toggle="tab" data-bs-target="#${tabId}" type="button" role="tab" aria-controls="${tabId}" aria-selected="${index === 0 ? 'true' : 'false'}">
                          Row ${rowIndex + 1}
                      </button>
                  </li>
              `;

              tabContentHtml += `
                  <div class="tab-pane fade ${showClass}" id="${tabId}" role="tabpanel" aria-labelledby="${tabId}-tab">
                      <div class="alert alert-info">
                          <strong>Main Pressure:</strong> ${row.main_pressure} ton<br>
                          <strong>Die Size:</strong> ${row.die_length} x ${row.die_width} mm
                      </div>
                      <div class="table-responsive">
                          <table class="table table-bordered table-hover mt-2">
                              <thead class="table-light">
                                  <tr>
                                      <th>Machine</th>
                                      <th>Capacity</th>
                                      <th>Cushion</th>
                                      <th>Bolster Area</th>
                                      <th>Slide Area</th>
                                      <th>Status</th>
                                  </tr>
                              </thead>
                              <tbody>${tableRows}</tbody>
                          </table>
                      </div>
                  </div>
              `;
          });

          modalBody.innerHTML = `
              <ul class="nav nav-tabs" id="pressureTabs" role="tablist">
                  ${tabHeaderHtml}
              </ul>
              <div class="tab-content mt-3" id="pressureTabContent">
                  ${tabContentHtml}
              </div>
          `;
      })
      .catch(err => {
          console.error('Error:', err);
          modalBody.innerHTML = `
              <div class="alert alert-danger">
                  <h5>Error Loading Machine Matches</h5>
                  <p>${err.message}</p>
                  <button class="btn btn-sm btn-secondary" onclick="showMachineMatchModal()">Try Again</button>
              </div>
          `;
      });
  }

  // Function to apply machine selection to the form
  function applyMachineMatch(rowIndex, machine) {
      // Find the corresponding row in the form
      const rows = document.querySelectorAll('#tableBasic tbody tr');
      if (rowIndex >= rows.length) {
          alert('Error: Could not find the corresponding form row.');
          return;
      }

      const row = rows[rowIndex];
      const machineSelect = row.querySelector('.basic-machine');
      
      if (machineSelect) {
          // Store the current scroll position
          const scrollPosition = window.scrollY;
          
          // Find the option that matches the machine
          let found = false;
          const options = machineSelect.options;
          for (let i = 0; i < options.length; i++) {
              if (options[i].value === machine) {
                  machineSelect.selectedIndex = i;
                  found = true;
                  
                  // Trigger the change event to update dependent fields
                  const event = new Event('change', { bubbles: true });
                  machineSelect.dispatchEvent(event);
                  
                  // Show a temporary success indicator
                  const originalBg = machineSelect.style.backgroundColor;
                  machineSelect.style.backgroundColor = '#d4edda'; // Light green
                  setTimeout(() => {
                      machineSelect.style.backgroundColor = originalBg;
                  }, 1000);
                  break;
              }
          }
          
          if (found) {
              // Show a subtle notification instead of alert
              const notification = document.createElement('div');
              notification.className = 'alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3';
              notification.style.zIndex = '9999';
              notification.innerHTML = `
                  <strong>Applied:</strong> Machine ${machine} set for ${row.querySelector('.basic-process').value}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              `;
              document.body.appendChild(notification);
              
              // Auto-dismiss after 2 seconds
              setTimeout(() => {
                  notification.classList.remove('show');
                  setTimeout(() => notification.remove(), 150);
              }, 2000);
              
              // Restore scroll position (in case the change triggered any layout shifts)
              window.scrollTo(0, scrollPosition);
          } else {
              // Show error notification
              const notification = document.createElement('div');
              notification.className = 'alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3';
              notification.style.zIndex = '9999';
              notification.innerHTML = `
                  <strong>Error:</strong> Machine ${machine} not found in options
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              `;
              document.body.appendChild(notification);
              
              // Auto-dismiss after 3 seconds
              setTimeout(() => {
                  notification.classList.remove('show');
                  setTimeout(() => notification.remove(), 150);
              }, 3000);
          }
      } else {
          // Show error notification
          const notification = document.createElement('div');
          notification.className = 'alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3';
          notification.style.zIndex = '9999';
          notification.innerHTML = `
              <strong>Error:</strong> Could not find machine select element
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          `;
          document.body.appendChild(notification);
          
          // Auto-dismiss after 3 seconds
          setTimeout(() => {
              notification.classList.remove('show');
              setTimeout(() => notification.remove(), 150);
          }, 3000);
      }
  }
  function populateNewMasterTable(machineDataArray, dieWidthStandard, dieLengthStandard, dieHeightStandard) {
    var tableBody = document.getElementById('newTableBody');
    var dieTableBody = document.getElementById('dieTableBody');
    tableBody.innerHTML = "";
    if (machineDataArray.length === 0) {
      tableBody.innerHTML = "<tr><td colspan='11'>No data found.</td></tr>";
      return;
    }
    if (dieWidthStandard.length === 0) {
      dieTableBody.innerHTML = "<tr><td colspan='11'>No data found.</td></tr>";
      return;
    }
    machineDataArray.forEach(function(item, index) {
      var tr = document.createElement("tr");

      function createInputCell(value, name) {
        var td = document.createElement("td");
        var input = document.createElement("input");
        input.type = "text";
        input.name = name;
        input.value = value;
        input.readOnly = true;
        input.classList.add("form-control");
        td.appendChild(input);
        return td;
      }
    
      tr.appendChild(createInputCell(item.machine, "machine[]"));
      tr.appendChild(createInputCell(item.bolster_length, "bolster_length[]"));
      tr.appendChild(createInputCell(item.bolster_width, "bolster_width[]"));
      tr.appendChild(createInputCell(item.slide_area_length, "slide_area_length[]"));
      tr.appendChild(createInputCell(item.slide_area_width, "slide_area_width[]"));
      tr.appendChild(createInputCell(item.die_height, "die_height[]"));
      tr.appendChild(createInputCell(item.cushion_pad_length, "cushion_pad_length[]"));
      tr.appendChild(createInputCell(item.cushion_pad_width, "cushion_pad_width[]"));
      tr.appendChild(createInputCell(item.cushion_stroke, "cushion_stroke[]"));

      tableBody.appendChild(tr);
    });
    var die_length = document.getElementsByName('die_length[]');
    var die_width  = document.getElementsByName('die_width[]');
    // var die_height  = document.getElementsByName('die_height[]');
    dieWidthStandard.forEach(function(item, index) {
      if(die_width[index]) {
        die_width[index].value = dieWidthStandard[index];
      }
      if(die_length[index]) {
        die_length[index].value = dieLengthStandard[index];
      }
      var row = die_length[index].closest('tr');
      calculateDieWeight2(row);
    });
  }
  function onStandardChange(selectElem) {  
    var selectedStandard = selectElem.value; 

    var basicRow = selectElem.closest('tr');
    var dieTableBody = document.getElementById('dieTableBody');
    var dieRows = Array.from(dieTableBody.children);
    var rowIndex = dieRows.indexOf(basicRow);
    
    var formData = new FormData();
    formData.append('standard', selectedStandard);
    formData.append(csrfName, csrfHash);

    fetch("<?= site_url('pps/fetchStandard') ?>", {
      method: "POST",
      body: formData,
      headers: { "X-Requested-With": "XMLHttpRequest" }
    })
    .then(response => response.json())
    .then(data => {
      if (data.csrfHash) { 
        csrfHash = data.csrfHash; 
      }
      if (data.error) {
        Swal.fire({
            icon: 'error',  // Menampilkan ikon error
            title: 'Terjadi Kesalahan!',
            text: data.error, // Menampilkan pesan error dari server
            confirmButtonText: 'OK'
        });

      } else if (data.success) {
        var dieLengthValue = data.data['die_length'];
        var dieWidthValue = data.data['die_width'];
        
        var currentRow = dieRows[rowIndex];
        if (currentRow) {
          var dieLengthInput = currentRow.cells[2].querySelector('input[name="die_length[]"]');
          var dieWidthInput  = currentRow.cells[3].querySelector('input[name="die_width[]"]'); // atau "die_height[]", sesuai kebutuhan
          
          if (dieLengthInput) {
            dieLengthInput.value = dieLengthValue;
          }
          if (dieWidthInput) {
            dieWidthInput.value = dieWidthValue;
          }
        }

      }
    })
    .catch(error => {
      Swal.fire({
          icon: 'error',  // Menampilkan ikon error
          title: 'Terjadi Kesalahan!',
          text: 'Terjadi kesalahan: ' + error, // Menampilkan pesan error dari variabel error
          confirmButtonText: 'OK'
      });

      console.error(error);
    });
  }

function onMachineChange(selectElem) {  
  var selectedMachine = selectElem.value; 
  var basicRow = selectElem.closest('tr');
  var basicTbody = document.getElementById('basicTableBody');
  var basicRows = Array.from(basicTbody.children);
  var rowIndex = basicRows.indexOf(basicRow); 

  var formData = new FormData();
  formData.append('machine', selectedMachine);
  formData.append(csrfName, csrfHash);

  fetch("<?= site_url('pps/fetchMachineByMachine') ?>", {
    method: "POST",
    body: formData,
    headers: { "X-Requested-With": "XMLHttpRequest" }
  })
  .then(response => response.json())
  .then(data => {
    if (data.csrfHash) { 
      csrfHash = data.csrfHash; 
    }
    if (data.error) {
      Swal.fire({
          icon: 'error',  // Menampilkan ikon error
          title: 'Terjadi Kesalahan!',
          text: data.error, // Menampilkan pesan error dari server
          confirmButtonText: 'OK'
      });

    } else if (data.success) {
      var capacityValue = data.data['capacity'];
      var cushionValue = data.data['cushion'];

      var newTbody = document.getElementById('newTableBody');
      while (newTbody.children.length <= rowIndex) {
        var tempRow = document.createElement("tr");
        for (var j = 0; j < 9; j++) {
          var td = document.createElement("td");
          td.textContent = "";
          tempRow.appendChild(td);
        }
        newTbody.appendChild(tempRow);
      }

     
      var newRow = newTbody.children[rowIndex];
      newRow.innerHTML = "";
      
      var fields = [
        "machine", 
        "bolster_length", 
        "bolster_width",
        "slide_area_length", 
        "slide_area_width",
        "die_height", 
        "cushion_pad_length", 
        "cushion_pad_width", 
        "cushion_stroke"
      ];
      fields.forEach(function(field) {
        var td = document.createElement("td");
        var input = document.createElement("input");
        input.type = "text";
        input.name = field + "[]"; 
        input.value = (data.machine_data && data.machine_data[field]) ? data.machine_data[field] : "";
        input.className = "form-control";
         input.readOnly = true; 
        td.appendChild(input);
        newRow.appendChild(td);
      });

      var capacityInput = basicRow.querySelector('input[name="capacity[]"]');
      if (capacityInput) {
        capacityInput.value = capacityValue;
      }
      var cushionInput = basicRow.querySelector('input[name="cushion[]"]');
      if (cushionInput) {
        cushionInput.value = cushionValue;
      }
    }
  })
  .catch(error => {
    Swal.fire({
        icon: 'error',  // Menampilkan ikon error
        title: 'Terjadi Kesalahan!',
        text: 'Terjadi kesalahan: ' + error, // Menampilkan pesan error
        confirmButtonText: 'OK'
    });

  });
}
function loadDcpImages2(containerId, hiddenInputId, previewId) {
  fetch("<?= base_url('Pps/listPpsImages') ?>")// Buat route ini untuk ambil list
    .then(res => res.json())
    .then(images => {
      images.forEach(imgPath => {
        const img = document.createElement('img');
        img.src = imgPath;
        img.style.width = '100px';
        img.style.cursor = 'pointer';
        img.style.border = '2px solid transparent';

        img.addEventListener('click', () => {
          document.getElementById(hiddenInputId).value = imgPath;
          document.getElementById(previewId).src = imgPath;
          document.getElementById(previewId).style.display = 'block';

          // Reset border semua
          containerId.querySelectorAll('img').forEach(i => {
            i.style.border = '2px solid transparent';
          });
          img.style.border = '2px solid green';
        });

        containerId.appendChild(img);
      });
    });
}

// Call function after DOM ready
document.addEventListener('DOMContentLoaded', () => {
  loadDcpImages2(document.getElementById('blankList'), 'blankSelected', 'blankPreview');
  loadDcpImages2(document.getElementById('processList'), 'processSelected', 'processPreview');

  // Reset hidden input jika file diupload ulang
  document.getElementById('blankUpload').addEventListener('change', () => {
    document.getElementById('blankSelected').value = '';
    document.getElementById('blankPreview').src = URL.createObjectURL(event.target.files[0]);
    document.getElementById('blankPreview').style.display = 'block';
  });

  document.getElementById('processUpload').addEventListener('change', () => {
    document.getElementById('processSelected').value = '';
    document.getElementById('processPreview').src = URL.createObjectURL(event.target.files[0]);
    document.getElementById('processPreview').style.display = 'block';
  });
});

function loadDcpImages(container, hiddenInput) {
  fetch("<?= base_url('Pps/listPpsImages') ?>")
    .then(res => res.json())
    .then(images => {
      container.innerHTML = '';

      images.forEach(url => {
        const img = document.createElement('img');
        img.src = url;
        img.style.width = '80px';
        img.style.height = '80px';
        img.style.cursor = 'pointer';
        img.style.border = '2px solid transparent';

        img.addEventListener('click', function () {
          // Unselect semua dulu
          container.querySelectorAll('img').forEach(i => i.style.border = '2px solid transparent');
          img.style.border = '2px solid blue';

          // Set value hidden input
          hiddenInput.value = url;
        });

        container.appendChild(img);
      });
    });
}

</script>

<?= $this->endSection() ?><?= $this->endSection() ?><?= $this->endSection() ?>