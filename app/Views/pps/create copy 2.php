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
                <input type="text" id="part_no" name="part_no" class="form-control">
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
    <!-- Bagian Hint: Tombol Hint untuk Material Spec -->
      

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
              <input type="text" id="tonasi" name="tonasi" class="form-control">
            </div>
          </div>
        <!-- </div> -->

        <!-- Measurement -->
        <!-- <div class="card p-3 mb-3">
          <h5>Material</h5> -->
          <div class="row">
            <div class="col-md-4 mb-3">
              <label>Length</label>
              <input type="text" id="length" name="length" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
              <label>Width</label>
              <input type="text" id="width" name="width" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
              <label>BOQ</label>
              <input type="text" id="boq" name="boq" class="form-control">
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 mb-3">
              <label>Blank (Kg)</label>
              <input type="text" id="blank" name="blank" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
              <label>Panel (Kg)</label>
              <input type="text" id="panel" name="panel" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
              <label>Scrap (Kg)</label>
              <input type="text" id="scrap" name="scrap" class="form-control">
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
              <h5 class="modal-title" id="materialHintModalLabel">Material Hint</h5>
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
              <p><strong>Perhitungan Scrap:</strong> Panel - Blank</p>
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
                <h5 class="modal-title" id="diesHintModalLabel">Panduan Dies Configuration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Body Modal -->
            <div class="modal-body">
                <h6><strong>1. Dies Configuration</strong></h6>
                <img src="<?= base_url('assets/images/DiesConfiguration.png') ?>" alt="Dies Configuration" class="img-fluid mb-3">
                <p>Dies Configuration digunakan untuk mengisi PRESS M/C SPEC dan PROCESS DETAIL																																																					
                 yang akan ditempelkan pada bagian Excel seperti gamabr diatas</p>

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
                    <li>DR/DO: <code>(Keliling * thickness * 0.8 * konversi * 1.2 * 1) / 1000</code></li>
                </ul>

                <hr>

                <h6><strong>4. Spesifikasi Mesin</strong></h6>
                <!-- <p>Spesifikasi mesin dapat dilihat pada gambar berikut:</p>
                <img src="<?= base_url('assets/images/specMesin.png') ?>" alt="Spesifikasi Mesin" class="img-fluid mb-3"> -->
                <p>Untuk melihat data lengkap, kunjungi: <a href="<?= base_url('master-pps/master-spec-mc') ?>"  target="_blank" >Master Data Spec Mesin</a></p>

                <hr>

                <h6><strong>5. Perhitungan Die Weight</strong></h6>
                <img src="<?= base_url('assets/images/konversiDieWeight.png') ?>" alt="Konversi Die Weight" class="img-fluid mb-3">
                <p>Rumus perhitungan berat Die:</p>
                <pre>(dieLength * dieWidth * dieHeight * factor * 7.85) / 1000000</pre>

                <p>Untuk melihat master data Die Sizing Process, kunjungi: <a href="pps/master-die-sizing"  target="_blank" >Master Die Sizing</a></p>
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
                    <!-- <button type="button" class="btn btn-primary" onclick="fetchMachineData()">Fetch Data</button> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
       
          <!-- Tabel Basic -->
         
          <!-- <h5>Master Data </h5>
            
          <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
            <table class="table table-bordered">
              <thead id="dynamicTableHead">
                <tr>
                  <th>Machine</th>
                  <th>Capacity</th>
                  <th>Cushion</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($masterTableData) && is_array($masterTableData)) : ?>
                    <?php foreach ($masterTableData as $row) : ?>
                        <tr>
                            <td><?= esc($row['machine']); ?></td>
                            <td><?= esc($row['capacity']); ?></td>
                            <td><?= esc($row['cushion']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3">Data tidak tersedia.</td>
                    </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div> -->


           <!-- Tabel Basic: hanya memuat kolom non-die -->
           <div class="card p-3 mb-3">
            <h5>Process</h5>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead id="dynamicTableHead">
                    <tr>
                      <th>Process</th>
                      <th>Process Gang</th>
                      <th>Nama Proses</th>
                      <th>Luas</th>
                      <th>Main Pressure</th>
                      <th>Machine</th>

                      <th class="hidden-column" id="capacityColumn">Capacity</th>
                      <th class="hidden-column" id="cushionColumn">Cushion</th>
                      <!-- Kolom Die dipindahkan ke tabel baru -->
                    </tr>
                  </thead>
                  <tbody id="basicTableBody"></tbody>
                </table>
              </div>
              </div>
              <div class="input-group-append mb-3 ">
            <button type="button" class="btn btn-primary" onclick="fetchMachineData()">Fetch Data</button>
          </div>

              <div id="dieTable" style="display: none;">
              <h5>Die Sizing Process</h5>
              <p>Silahkan memilih Proses Standard Die untuk menentukan ukuran sesuai dengan master data Standard Die</p>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead id="dieTableHead">
                      <tr>
                        <th>Process</th>
                        <th>Proses Standard Die</th>
                        <th>Die Length</th>
                        <th>Die Width</th>
                        <th>Die Height</th>
                        <th>Casting/Plate</th>
                        <th>Die Weight</th>
                      </tr>
                    </thead>
                    <tbody id="dieTableBody"></tbody>
                  </table>
              </div>
           
       
          
          <!-- New Master Table -->
    
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
              
          <div class="nav-buttons text-right">
            <button type="button" class="btn btn-secondary prev-step" data-prev="2">Sebelumnya</button>
            <button type="button" class="btn btn-primary next-step" data-next="4">Selanjutnya</button>
          </div>
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
                          <h5 class="modal-title" id="dieConstructionHintModalLabel">Panduan Die Construction</h5>
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
                              <li>Bagian <b>Upper & Lower Die</b> menggunakan material <b>SS41</b> jika mesin adalah <b>SP</b> atau <b>MP</b>, sedangkan mesin lainnya menggunakan <b>FC300</b>.</li>
                              <li>Bagian <b>Pad</b> menggunakan material <b>S45C</b> untuk mesin <b>SP & MP</b>, dan <b>FCD55</b> untuk mesin lainnya.</li>
                              <li>Bagian <b>Pad Lifter</b> menggunakan <b>Coil Spring</b> jika prosesnya melibatkan <b>FL, DR, BE, RE, atau FO</b>, sedangkan proses lainnya menggunakan <b>Gas Spring</b>.</li>
                              <li>Bagian <b>Sliding</b> selalu menggunakan <b>Wear Plate</b>.</li>
                              <li>Bagian <b>Guide</b> menggunakan <b>Guide Post</b> jika mesin adalah <b>SP & MP</b>, serta jika proses melibatkan <b>BL, CUT, atau TR</b>. Jika tidak, maka menggunakan <b>Guide Hell</b>.</li>
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
                    <th>Aksi</th>
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
                    <th>Aksi</th>
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
                <input type="file" name="blank_layout_img" class="form-control" accept=".png,.jpg,.jpeg">
              </div>
            </div>
          </div>
          <div class="card p-3 mb-3">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label>Gambar Proses Layout <span class="text-danger">*</span></label>
                <input type="file" name="process_layout_img" class="form-control" accept=".png,.jpg,.jpeg">
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
document.addEventListener("DOMContentLoaded", function () {
    let partNoInput = document.getElementById("part_no");
    let cfInput = document.getElementById("cf");

    partNoInput.addEventListener("input", function () {
        if (partNoInput.value.includes("/")) {
            cfInput.value = "1/1";
        } else {
            cfInput.value = "1";
        }
    });
});
</script>

<script>
  // Array suggestion untuk tiap kolom
  var InsertSuggestions = ["SKD11", "SXACE", "S45C"];
  var HeatTreatmentSuggestions = ["FULLHARD", "FULLHARD + COATING", "FLAMEHARD"];
  var PadLifterSuggestions = ["Coil Spring", "Gas Spring"];
  var GuideSuggestions = ["Guide Post", "Guide Hell"];
  var PadSuggestions = ["S45C", "FCD55"];

  // Variabel global untuk menyimpan input yang aktif
  var currentSuggestionInput = null;

  // Update currentSuggestionInput saat input dengan field yang diinginkan mendapatkan fokus
  $(document).on('focus', 'input[name="insert[]"], input[name="heat_treatment[]"], input[name="pad_lifter[]"], input[name="guide[]"], input[name="pad[]"]', function(){
    currentSuggestionInput = $(this);
  });

  // Fungsi untuk memasang event suggestion pada input (digunakan delegated event agar input dinamis ikut ter-handle)
  function setupSuggestion(selector, suggestionArray, containerId) {
    $(document).on('input', selector, function(){
      var inputVal = $(this).val().toLowerCase();
      var suggestionBox = $(containerId);
      suggestionBox.empty();
      
      // Filter suggestion yang mengandung inputVal
      var matches = suggestionArray.filter(function(item){
        return item.toLowerCase().indexOf(inputVal) !== -1;
      });
      
      // Posisi suggestion box di bawah input yang aktif
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
    
    // Saat suggestion diklik, isi input dengan nilai yang dipilih
    $(document).on('click', containerId + ' .suggestion-item', function(){
      if (currentSuggestionInput) {
        currentSuggestionInput.val($(this).text());
      }
      $(containerId).hide();
    });
    
    // Sembunyikan dropdown jika klik di luar area input dan suggestion
    $(document).on('click', function(event){
      if(!$(event.target).closest(selector + ', ' + containerId).length){
        $(containerId).hide();
      }
    });
  }

  // Pasang suggestion untuk tiap input sesuai nama field
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
      // Sembunyikan semua step
    // xyz
      step.style.display = 'none';
      step.classList.remove('active');
    });
    // Tampilkan step yang aktif
    const activeStep = document.querySelector(`.step[data-step="${stepNumber}"]`);
    if (activeStep) {
      activeStep.style.display = 'block';
      activeStep.classList.add('active');
    }
    
    // Update progress wizard
    stepProgress.forEach((item, index) => {
      if (index < stepNumber) {
        item.classList.add('active');
      } else {
        item.classList.remove('active');
      }
    });
  }

  // Pindah ke step berikutnya
  document.querySelectorAll('.next-step').forEach(button => {
    button.addEventListener('click', function() {
      const nextStep = parseInt(this.dataset.next);
      if (validateStep(currentStep)) {
        currentStep = nextStep;
        showStep(currentStep);
      }
    });
  });

  // Pindah ke step sebelumnya
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
      alert('Silakan lengkapi semua field yang wajib diisi.');
    }
    return isValid;
  }

  // Tampilkan step awal
  showStep(currentStep);
});
</script>
<script>
    // Konversi data cust suggestions dari PHP ke JavaScript
    // Menggunakan array unik berdasarkan kolom 'cust'
    var custSuggestions = ["MMKI", "ADM", "TMMIN", "GMR", "HMMI", "HPM"];

    $(document).ready(function(){
        // Saat pengguna mengetik di input cust
        $('#cust').on('input', function(){
            var inputVal = $(this).val().toLowerCase();
            var suggestionBox = $('#cust-suggestions');
            suggestionBox.empty();
            
            // Filter suggestion yang mengandung inputVal
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

        // Ketika item suggestion diklik, isi input cust dengan nilai tersebut
        $('#cust-suggestions').on('click', '.suggestion-item', function(){
            $('#cust').val($(this).text());
            $('#cust-suggestions').hide();
        });

        // Sembunyikan dropdown suggestion ketika klik di luar area cust
        $(document).on('click', function(event){
            if(!$(event.target).closest('#cust, #cust-suggestions').length){
                $('#cust-suggestions').hide();
            }
        });
    });
</script>
<script>
    // Konversi data cust suggestions dari PHP ke JavaScript
    // Menggunakan array unik berdasarkan kolom 'cust'
    var DocSuggestions = ["RFQ"];

    $(document).ready(function(){
        // Saat pengguna mengetik di input cust
        $('#doc_level').on('input', function(){
            var inputVal = $(this).val().toLowerCase();
            var suggestionBox = $('#docsuggestions');
            suggestionBox.empty();
            
            // Filter suggestion yang mengandung inputVal
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

        // Ketika item suggestion diklik, isi input cust dengan nilai tersebut
        $('#docsuggestions').on('click', '.suggestion-item', function(){
            $('#doc_level').val($(this).text());
            $('#docsuggestions').hide();
        });

        // Sembunyikan dropdown suggestion ketika klik di luar area cust
        $(document).on('click', function(event){
            if(!$(event.target).closest('#cust, #cust-suggestions').length){
                $('#cust-suggestions').hide();
            }
        });
    });
</script>
<script>
    // Konversi data cust suggestions dari PHP ke JavaScript
    // Menggunakan array unik berdasarkan kolom 'cust'
    var custSuggestions = ["MMKI", "ADM", "TMMIN", "GMR", "HMMI"];

    $(document).ready(function(){
        // Saat pengguna mengetik di input cust
        $('#cust').on('input', function(){
            var inputVal = $(this).val().toLowerCase();
            var suggestionBox = $('#cust-suggestions');
            suggestionBox.empty();
            
            // Filter suggestion yang mengandung inputVal
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

        // Ketika item suggestion diklik, isi input cust dengan nilai tersebut
        $('#cust-suggestions').on('click', '.suggestion-item', function(){
            $('#cust').val($(this).text());
            $('#cust-suggestions').hide();
        });

        // Sembunyikan dropdown suggestion ketika klik di luar area cust
        $(document).on('click', function(event){
            if(!$(event.target).closest('#cust, #cust-suggestions').length){
                $('#cust-suggestions').hide();
            }
        });
    });
</script>
<script>
// Perhitungan Blank dan Scrap
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
    }
    [length, width, tonasi, boq].forEach(input => {
      input.addEventListener('input', calculateBlank);
    });
    panel.addEventListener('input', calculateScrap);
  });
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
    // Opsi untuk dropdown "proses" di kolom Proses
    var prosesOptions = ["DRAW", "FORM", "FORM-BEND", "FORM-FL", "TRIM", "TRIM-PIE", "BLANK", "BLANK-PIE", "BEND", "BEND-REST", "BEND-FL", "BEND1-BEND2", "SEP", "SEP-PIERCE", "SEP-TRIM", "REST", "FLANGE", "TR", "CUT"];
    
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

  console.log(machineOptions); // C3 dan C4 sudah tidak ada

  // Fungsi helper untuk mengupdate nilai proses_standard_die pada baris tertentu
  function updateProcessStandardDieForRow(rowIndex) {
    // Ambil nilai main_pressure dan proses dari baris Basic
    var basicRow = basicTableBody.children[rowIndex];
    var mainPressureInput = basicRow.querySelector('input[name="main_pressure[]"]');
    var processSelect = basicRow.querySelector('select[name="proses[]"]');
    var mainPressure = parseFloat(mainPressureInput.value) || 0;
    var process = processSelect.value;
    var valueToSet = "";
    if (mainPressure > 3914) {
      if (["DRAW", "FORM", "FORM-BEND", "BEND1-BEND2", "BEND", "BEND-REST", "BEND-FL", "FORM-FL"].includes(process)) {
        valueToSet = "BIG DIE|SINGLE|DRAW";
      } else if (process === "FLANGE") {
        valueToSet = "BIG DIE|SINGLE|FFLANGE";
      } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-TRIM", "REST", "TR", "CUT"].includes(process)) {
        valueToSet = "BIG DIE|SINGLE|TRIM";
      } else {
        valueToSet = "";
      }
    } else if (mainPressure >= 848 && mainPressure <= 3914) {
      if (["DRAW", "FORM", "FORM-BEND", "FORM-FL", "BEND", "BEND-REST", "BEND-FL", "BEND1-BEND2"].includes(process)) {
        valueToSet = "MEDIUM DIE|SINGLE|DRAW";
      } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-PIERCE", "SEP-TRIM", "REST"].includes(process)) {
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
    // Update nilai di Die Table
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
    // --- Tabel Basic ---
    var basicRow = document.createElement('tr');

    // Process
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
    // Update nilai pada Die Table saat dropdown process (Basic) berubah
    select1.addEventListener('change', function() {
      calculateTotalMP();
      generateDieConstructionTable();
      var basicRow = this.closest('tr');
      var basicRows = Array.from(basicTableBody.children);
      var rowIndex = basicRows.indexOf(basicRow);
      // Update field process di Die Table
     
      // Panggil fungsi update untuk proses_standard_die pada baris ini
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
    cell1.appendChild(select1);
    basicRow.appendChild(cell1);

    var celljoin = document.createElement('td');
    var selectjoin = document.createElement('select');
    selectjoin.name = 'process_join[]';
    selectjoin.className = 'custom-select2 form-control';
    processOptions.forEach(function(opt, index) {
      var option = document.createElement('option');
      option.value = opt;
      option.textContent = opt;
      if (i === index) { option.selected = true; }
      selectjoin.appendChild(option);
    });
    // Update nilai pada Die Table saat dropdown process (Basic) berubah
    selectjoin.addEventListener('change', function() {
      calculateTotalMP();
      generateDieConstructionTable();
      var basicRow = this.closest('tr');
      var basicRows = Array.from(basicTableBody.children);
      var rowIndex = basicRows.indexOf(basicRow);
      // Update field process di Die Table
     
      // Panggil fungsi update untuk proses_standard_die pada baris ini
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

    var cell3 = document.createElement('td');
    var select2 = document.createElement('select');
    select2.name = 'proses[]';
    select2.className = 'custom-select2 form-control';
    select2.setAttribute("onchange", "calculateMainPressure(this); calculateDieWeight(this); calculateTotalMP(); changeStandardDesign(this);");
    prosesOptions.forEach(function(opt) {
      var option = document.createElement('option');
      option.value = opt;
      option.textContent = opt;
      select2.appendChild(option);
    });
    // Agar jika dropdown proses di Basic berubah (manual) kita juga update nilai proses_standard_die
    select2.addEventListener('change', function() {
      var basicRow = this.closest('tr');
      var basicRows = Array.from(basicTableBody.children);
      var rowIndex = basicRows.indexOf(basicRow);
      updateProcessStandardDieForRow(rowIndex);
      var dieRow = dieTableBody.children[rowIndex];
      if (dieRow) {
        var processInput = dieRow.querySelector('input[name="die_proses[]"]');
        if (processInput) {
          processInput.value = this.value;
        }
      }
    });
    cell3.appendChild(select2);
    basicRow.appendChild(cell3);

    // xyz
    // Process Join (dropdown untuk proses_standard_die manual)

    // var cell2 = document.createElement('td');
    // var select = document.createElement('select');
    // select.name = 'proses_standard_die[]';
    // select.className = 'form-control';
    // var options = [
    //   { value: "BIG DIE|SINGLE|DRAW",           text: "BIG DIE, SINGLE, DRAW" },
    //   { value: "BIG DIE|SINGLE|DEEP DRAW",        text: "BIG DIE, SINGLE, DEEP DRAW" },
    //   { value: "BIG DIE|SINGLE|TRIM",             text: "BIG DIE, SINGLE, TRIM" },
    //   { value: "BIG DIE|SINGLE|FFLANGE",          text: "BIG DIE, SINGLE, FFLANGE" },
    //   { value: "BIG DIE|SINGLE|CAM FLANGE",       text: "BIG DIE, SINGLE, CAM FLANGE" },
    //   { value: "MEDIUM DIE|SINGLE|DRAW",          text: "MEDIUM DIE, SINGLE, DRAW" },
    //   { value: "MEDIUM DIE|SINGLE|TRIM",          text: "MEDIUM DIE, SINGLE, TRIM" },
    //   { value: "MEDIUM DIE|SINGLE|FLANGE",        text: "MEDIUM DIE, SINGLE, FLANGE" },
    //   { value: "MEDIUM DIE|SINGLE|CAM PIE",       text: "MEDIUM DIE, SINGLE, CAM PIE" },
    //   { value: "MEDIUM DIE|GANG|DRAW",            text: "MEDIUM DIE, GANG, DRAW" },
    //   { value: "MEDIUM DIE|GANG|TRIM",            text: "MEDIUM DIE, GANG, TRIM" },
    //   { value: "MEDIUM DIE|GANG|FLANGE-CAM PIE",  text: "MEDIUM DIE, GANG, FLANGE-CAM PIE" },
    //   { value: "SMALL DIE|SINGLE|BLANK",           text: "SMALL DIE, SINGLE, BLANK" },
    //   { value: "SMALL DIE|SINGLE|FORMING",         text: "SMALL DIE, SINGLE, FORMING" },
    //   { value: "SMALL DIE|SINGLE|CAM PIE",         text: "SMALL DIE, SINGLE, CAM PIE" },
    //   { value: "SMALL DIE|GANG|FORM-FLANGE",       text: "SMALL DIE, GANG, FORM-FLANGE" },
    //   { value: "SMALL DIE|GANG|BEND 1, BEND 2",     text: "SMALL DIE, GANG, BEND 1, BEND 2" },
    //   { value: "SMALL DIE|GANG|FORMING, PIE",       text: "SMALL DIE, GANG, FORMING, PIE" },
    //   { value: "SMALL DIE|PROGRESSIVE|BLANK-PIE",    text: "SMALL DIE, PROGRESSIVE, BLANK-PIE" }
    // ];
    // options.forEach(function(opt) {
    //   var option = document.createElement('option');
    //   option.value = opt.value;
    //   option.textContent = opt.text;
    //   select.appendChild(option);
    // });
    // // Update nilai pada Die Table jika dropdown ini diubah (manual)
    // select.addEventListener('change', function() {
    //   var basicRow = this.closest('tr');
    //   var basicRows = Array.from(basicTableBody.children);
    //   var rowIndex = basicRows.indexOf(basicRow);
    //   var dieRow = dieTableBody.children[rowIndex];
    //   if (dieRow) {
    //     var psdInput = dieRow.querySelector('input[name="die_proses_standard_die[]"]');
    //     if (psdInput) {
    //       psdInput.value = this.value;
    //     }
    //   }
    // });
    // cell2.appendChild(select);
    // basicRow.appendChild(cell2);


    // Length MP
    var cell4 = document.createElement('td');
    var input4 = document.createElement('input');
    input4.type = 'text';
    input4.name = 'length_mp[]';
    input4.placeholder = 'Luas ';
    input4.className = 'form-control';
    input4.setAttribute("oninput", "calculateMainPressure(this)");
    cell4.appendChild(input4);
    basicRow.appendChild(cell4);

    // Main Pressure (readonly)
    var cell5 = document.createElement('td');
    var input5 = document.createElement('input');
    input5.type = 'text';
    input5.name = 'main_pressure[]';
    input5.placeholder = 'Main Pressure';
    input5.className = 'form-control';
    input5.readOnly = true;
    // Tambahkan event listener untuk memanggil updateProcessStandardDie saat nilai berubah
    input5.addEventListener('change', updateProcessStandardDie);
    cell5.appendChild(input5);
    basicRow.appendChild(cell5);

    // Machine (basic)
    var cellMachine = document.createElement('td');
    var selectMachine = document.createElement('select');
    selectMachine.name = 'machine[]';
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
    });
    cellMachine.appendChild(selectMachine);
    basicRow.appendChild(cellMachine);

    // Capacity
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

    // Tidak membuat kolom Die Length, Die Width, Die Height, Casting/Plate, Die Weight di Basic Table
    basicTableBody.appendChild(basicRow);

    // --- Tabel Die (Baris baru untuk Die Table) ---
    var dieRow = document.createElement('tr');
    // Kolom Process (nilai mengikuti dropdown Process di Basic)
    var dieProcessCell = document.createElement('td');
    var dieProcessInput = document.createElement('input');
    dieProcessInput.type = 'text';
    dieProcessInput.name = 'die_proses[]';
    dieProcessInput.value = select2.value;
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
      { value: "BIG DIE|SINGLE|FFLANGE",          text: "BIG DIE, SINGLE, FFLANGE" },
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
  onStandardChange(this);
});

    dieProsesStdCell.appendChild(select);
    dieRow.appendChild(dieProsesStdCell);


    // Die Length
    var cellDieLength = document.createElement('td');
    var inputDieLength = document.createElement('input');
    inputDieLength.type = 'text';
    inputDieLength.name = 'die_length[]';
    inputDieLength.placeholder = 'Die Length';
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
    selectCastingPlate.appendChild(optionCasting);
    var optionPlate = document.createElement('option');
    optionPlate.value = 'plate';
    optionPlate.textContent = 'Plate';
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
    // Kolom Process: input text dengan nilai yang sama seperti dropdown process basic
    var dieImageCell = document.createElement('td');
    var dieImageProcessInput = document.createElement('input');
    dieImageProcessInput.type = 'text';
    dieImageProcessInput.name = 'die_image_process[]';
    dieImageProcessInput.value = select1.value;
    dieImageProcessInput.className = 'form-control';
    dieImageProcessInput.readOnly = true;
    dieImageCell.appendChild(dieImageProcessInput);
    dieImageRow.appendChild(dieImageCell);
    
    // Kolom C-Layout: input file untuk upload gambar C-Layout
    var clayoutCell = document.createElement('td');
    var clayoutInput = document.createElement('input');
    clayoutInput.type = 'file';
    clayoutInput.name = 'c_layout[]';
    clayoutInput.className = 'form-control';
    clayoutInput.accept = 'image/*';
    clayoutCell.appendChild(clayoutInput);
    dieImageRow.appendChild(clayoutCell);
    
    // Kolom Die Construction: input file untuk upload gambar Die Construction
    var dieConstrCell = document.createElement('td');
    var dieConstrInput = document.createElement('input');
    dieConstrInput.type = 'file';
    dieConstrInput.name = 'die_construction_img[]';
    dieConstrInput.className = 'form-control';
    dieConstrInput.accept = 'image/*';
    dieConstrCell.appendChild(dieConstrInput);
    dieImageRow.appendChild(dieConstrCell);
    
    // Kolom Aksi: tombol hapus
    var aksiCell = document.createElement('td');
    var deleteButton = document.createElement('button');
    deleteButton.type = 'button';
    deleteButton.className = 'btn btn-danger btn-sm';
    deleteButton.textContent = 'Hapus';
    deleteButton.addEventListener('click', function() {
      var row = this.closest('tr');
      row.parentNode.removeChild(row);
    });
    aksiCell.appendChild(deleteButton);
    dieImageRow.appendChild(aksiCell);
    
    dieImageBody.appendChild(dieImageRow);
  }
  calculateTotalMP(); // Update total MP setelah generateRows
  // Set Total Stroke sama dengan Total Dies
  document.getElementById('total_stroke').value = document.getElementById('total_dies').value;
  generateDieConstructionTable(); 
}
function changeStandardDesign(el) {
  // Cari baris (tr) terdekat dari elemen yang memicu event di Basic Table
  var basicRow = el.closest('tr');
  if (!basicRow) return;

  // Ambil nilai main_pressure dan proses dari Basic Table
  var mainPressureInput = basicRow.querySelector('input[name="main_pressure[]"]');
  var processSelect = basicRow.querySelector('select[name="proses[]"]');
  if (!mainPressureInput || !processSelect) return;
  
  var mainPressure = parseFloat(mainPressureInput.value) || 0;
  var processVal = processSelect.value;
  var valueToSet = "";
  
  if (machine > 3914) {
    if (["DRAW", "FORM", "FORM-BEND", "BEND1-BEND2", "BEND", "BEND-REST", "BEND-FL", "FORM-FL"].includes(processVal)) {
      valueToSet = "BIG DIE|SINGLE|DRAW";
    } else if (processVal === "FLANGE") {
      valueToSet = "BIG DIE|SINGLE|FFLANGE";
    } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-TRIM", "REST", "TR", "CUT"].includes(processVal)) {
      valueToSet = "BIG DIE|SINGLE|TRIM";
    } else {
      valueToSet = "";
    }
  } else if (machine >= 848 && machine <= 3914) {
    if (["DRAW", "FORM", "FORM-BEND", "FORM-FL", "BEND", "BEND-REST", "BEND-FL", "BEND1-BEND2"].includes(processVal)) {
      valueToSet = "MEDIUM DIE|SINGLE|DRAW";
    } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-PIERCE", "SEP-TRIM", "REST"].includes(processVal)) {
      valueToSet = "MEDIUM DIE|SINGLE|TRIM";
    } else if (processVal === "FLANGE") {
      valueToSet = "MEDIUM DIE|SINGLE|FLANGE";
    } else {
      valueToSet = "";
    }
  } else {
    if (["DRAW", "FORM", "FORM-BEND", "BEND1-BEND2", "BEND", "BEND-REST"].includes(processVal)) {
      valueToSet = "SMALL DIE|SINGLE|FORMING";
    } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-TRIM", "REST", "TR", "CUT"].includes(processVal)) {
      valueToSet = "SMALL DIE|SINGLE|BLANK";
    } else {
      valueToSet = "SMALL DIE";
    }
  }
  
  // Dapatkan row index dari Basic Table
  var basicTableBody = document.getElementById('basicTableBody');
  var basicRows = Array.from(basicTableBody.children);
  var rowIndex = basicRows.indexOf(basicRow);

  // Gunakan rowIndex untuk mendapatkan row yang sama di Die Table
  var dieTableBody = document.getElementById('dieTableBody');
  if (!dieTableBody || !dieTableBody.children[rowIndex]) return;
  var dieRow = dieTableBody.children[rowIndex];
  
  // Ambil select die_proses_standard_die pada row Die Table
  var dieStandardSelect = dieRow.querySelector('select[name="die_proses_standard_die[]"]');
  if (dieStandardSelect) {
    dieStandardSelect.value = valueToSet;
  }
}


function updateProcessStandardDie() {
  // Contoh fungsi update untuk elemen global (jika dibutuhkan)
  const mainPressureInput = document.getElementById("main_pressure");
  const processSelect = document.getElementById("process");
  const processStandardDie = document.getElementById("process_standard_die");

  let mainPressure = parseFloat(mainPressureInput.value) || 0;
  let process = processSelect.value;

  if (mainPressure > 3914) {
    if (["DRAW", "FORM", "FORM-BEND", "BEND1-BEND2", "BEND", "BEND-REST", "BEND-FL", "FORM-FL"].includes(process)) {
      processStandardDie.value = "BIG DIE|SINGLE|DRAW";
    } else if (process === "FLANGE") {
      processStandardDie.value = "BIG DIE|SINGLE|FFLANGE";
    } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-TRIM", "REST", "TR", "CUT"].includes(process)) {
      processStandardDie.value = "BIG DIE|SINGLE|TRIM";
    } else {
      processStandardDie.value = "";
    }
  } else if (mainPressure >= 848 && mainPressure <= 3914) {
    if (["DRAW", "FORM", "FORM-BEND", "FORM-FL", "BEND", "BEND-REST", "BEND-FL", "BEND1-BEND2"].includes(process)) {
      processStandardDie.value = "MEDIUM DIE|SINGLE|DRAW";
    } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-PIERCE", "SEP-TRIM", "REST"].includes(process)) {
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
      var machineSelects = document.getElementsByName('machine[]');
      var totalMP = 0;
      for (var i = 0; i < machineSelects.length; i++) {
          var machineVal = machineSelects[i].value;
          // Jika machine mengandung "E", maka set nilai 3
          if (machineVal.toUpperCase().indexOf("E") !== -1) {
              totalMP += 3;
          } else if(machineVal.toUpperCase().includes("SP")){
              totalMP += 1; // jika mengandung "SP", maka nilai 1
          } else {
              totalMP += 2;
          }
      }
      document.getElementById('total_mp').value = totalMP;
  }
 
function generateDieConstructionTable() {
  // Ambil data dari Tabel Basic
  var processSelects = document.getElementsByName('proses[]');
  var machineSelects = document.getElementsByName('machine[]');
  var prosesSelects = document.getElementsByName('proses[]');
  var dieConstructionBody = document.getElementById('dieConstructionTableBody');
  dieConstructionBody.innerHTML = ""; // Kosongkan tabel

  // Ambil nilai material dan tonasi dari input form
  var angka = document.getElementById('material').value;
  var material = parseFloat(angka.replace(/\D/g, ''));
  var tonasi = parseFloat(document.getElementById('tonasi').value) || 0;

  // Loop sebanyak jumlah baris di Tabel Basic
  for (var i = 0; i < processSelects.length; i++) {
    var processValue = processSelects[i].value;
    var machineValue = machineSelects[i].value;
    var prosesValue = prosesSelects[i].value;

    var upperValue = (machineValue.includes("SP") || machineValue.includes("MP")) ? "SS41" : "FC300";
    var lowerValue = upperValue; // sama dengan upper

    // Kolom Pad
    var padValue = (machineValue.includes("SP") || machineValue.includes("MP")) ? "S45C" : "FCD55";

    // Kolom Pad Lifter dengan pengecekan prosesValue dan machineValue
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

    console.log(insertVal + " material: " + material + " tonasi: " + tonasi);
    // Kolom Sliding selalu diisi "Wear Plate"
    var slidingValue = "Wear Plate";

    // Kolom Guide dengan pengecekan tambahan pada proses
    var guideValue;
    if (machineValue.includes("SP") || machineValue.includes("MP")) {
      guideValue = "Guide Post";
    } else if (prosesValue.includes("BL") || prosesValue.includes("CUT") || prosesValue.includes("TR")) {
      guideValue = "Guide Post";
    } else {
      guideValue = "Guide Hell";
    }

    // Buat baris baru untuk Die Construction
    var tr = document.createElement("tr");

    // Fungsi bantu untuk membuat cell dengan input readonly
    function createTdInput(name, value) {
      var td = document.createElement("td");
      var input = document.createElement("input");
      input.type = "text";
      input.value = value;
      input.name = name;
      // input.readOnly = true;
      input.className = "form-control";
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
      input.className = "form-control";
      td.appendChild(input);
      return td;
    }

    // Isi sel sesuai kolom yang diminta
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

    // Tombol Hapus untuk menghapus baris
    var tdAction = document.createElement("td");
    var btnDelete = document.createElement("button");
    btnDelete.type = "button";
    btnDelete.className = "btn btn-danger btn-sm";
    btnDelete.textContent = "Hapus";
    btnDelete.addEventListener("click", function() {
      var row = this.closest("tr");
      row.parentNode.removeChild(row);
    });
    tdAction.appendChild(btnDelete);
    tr.appendChild(tdAction);

    dieConstructionBody.appendChild(tr);
  }
}
// Fungsi untuk menghitung Main Pressure
function calculateMainPressure(element) {
  var row = element.closest('tr');
  var length_mp = parseFloat(row.querySelector('input[name="length_mp[]"]').value) || 0;
  var materialText = document.getElementById('material').value;
 var materialMatch = materialText.match(/\d+/); // Ambil angka dari strin
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

   var thickness = parseFloat(document.getElementById('tonasi').value) || 0;
  var proses = row.querySelector('select[name="proses[]"]').value;
  var mainPressureInput = row.querySelector('input[name="main_pressure[]"]');
  var specialProcesses = ["BLANK", "BLANK-PI", "TRIM", "TRIM-PI", "SEP", "SEP-PIERCE", "SEP-TRIM", "TR", "CUT"];
  var multiplier = specialProcesses.includes(proses) ? 1 : 2.5;
  var mainPressure = (length_mp * thickness * 0.8 * tensile_material * 1.2 * multiplier)/1000;
  console.log("Length MP:", length_mp, "Thickness:", thickness, "Tensile Material:", tensile_material, "Multiplier:", multiplier);

  if(mainPressureInput) { mainPressureInput.value = mainPressure.toFixed(2); }
}

// Fungsi untuk menghitung Die Weight
function calculateDieWeight(element) {
  var row = element.closest('tr');
  var prosesElem = row.querySelector('input[name="die_proses[]"]');
  var dieLength = parseFloat(row.querySelector('input[name="die_length[]"]').value) || 0;
  var dieWidth = parseFloat(row.querySelector('input[name="die_width[]"]').value) || 0;
  var dieHeight = parseFloat(row.querySelector('input[name="die_height[]"]').value) || 0;
  var dieProsesStandardDieElem = row.querySelector('select[name="die_proses_standard_die[]"]');
  var castplateElem = row.querySelector('select[name="casting_plate[]"]'); // Ambil elemen select

  if (!prosesElem || !dieProsesStandardDieElem || !castplateElem) {
    console.error("Element proses, die_proses_standard_die, atau casting_plate tidak ditemukan.", row);
    return;
  }

  var prosesValue = prosesElem.value.toLowerCase();
  var dieProsesStandardDie = dieProsesStandardDieElem.value.toLowerCase();
  var castplateValue = castplateElem.value.toLowerCase(); // Ambil nilai dari select
  var factor = 1;

  // Cek apakah termasuk BIG DIE atau MEDIUM DIE
  if (castplateValue === "casting") {
    if (prosesValue.includes("bend")) { factor = 0.44; }
    else if (prosesValue.includes("form")) { factor = 0.43; }
    else if (prosesValue.includes("blank")) { factor = 0.40; }
    else if (prosesValue.includes("fl")) { factor = 0.40; }
    else if (prosesValue.includes("pie")) { factor = 0.39; }
    else if (prosesValue.includes("trim")) { factor = 0.38; }
    else if (prosesValue.includes("draw")) { factor = 0.37; }
  } 
  // Cek apakah termasuk SMALL DIE
  else if (dieProsesStandardDie.includes("plate")) {
    if (prosesValue.includes("blank")) { factor = 0.52; }
    else if (prosesValue.includes("trim")) { factor = 0.52; }
    else if (prosesValue.includes("bend")) { factor = 0.50; }
    else if (prosesValue.includes("form")) { factor = 0.50; }
    else if (prosesValue.includes("pie")) { factor = 0.46; }
    else if (prosesValue.includes("fl")) { factor = 0.46; }
    else if (prosesValue.includes("draw")) { factor = 0.45; }
  }

  console.log("Factor:", factor);

  // Menghitung berat die
  var dieWeight = (dieLength * dieWidth * dieHeight * factor * 7.85) / 1000000;
  var dieWeightElem = row.querySelector('input[name="die_weight[]"]');

  if (dieWeightElem) {
    dieWeightElem.value = dieWeight.toFixed(2);
  } else {
    console.error("Element input[name='die_weight[]'] tidak ditemukan.", row);
  }
}

function calculateDieWeight2(element) {
  // element di sini sudah merupakan elemen <tr>
  var row = element;
  var prosesElem = row.querySelector('input[name="die_proses[]"]');
  var dieLength = parseFloat(row.querySelector('input[name="die_length[]"]').value) || 0;
  var dieWidth = parseFloat(row.querySelector('input[name="die_width[]"]').value) || 0;
  var dieHeight = parseFloat(row.querySelector('input[name="die_height[]"]').value) || 0;
  var dieProsesStandardDieElem = row.querySelector('select[name="die_proses_standard_die[]"]');
  var castplateElem = row.querySelector('select[name="casting_plate[]"]'); // Ambil elemen select

  if (!prosesElem || !dieProsesStandardDieElem || !castplateElem) {
    console.error("Element die_proses, die_proses_standard_die, atau casting_plate tidak ditemukan.", row);
    return;
  }

  var prosesValue = prosesElem.value.toLowerCase();
  var dieProsesStandardDie = dieProsesStandardDieElem.value.toLowerCase();
  var castplateValue = castplateElem.value.toLowerCase(); // Ambil nilai dari select
  var factor = 1;

  // Cek apakah termasuk BIG DIE atau MEDIUM DIE
  if (castplateValue === "casting") {
    if (prosesValue.includes("bend")) { factor = 0.44; }
    else if (prosesValue.includes("form")) { factor = 0.43; }
    else if (prosesValue.includes("blank")) { factor = 0.40; }
    else if (prosesValue.includes("fl")) { factor = 0.40; }
    else if (prosesValue.includes("pie")) { factor = 0.39; }
    else if (prosesValue.includes("trim")) { factor = 0.38; }
    else if (prosesValue.includes("draw")) { factor = 0.37; }
  } 
  // Cek apakah termasuk SMALL DIE (dengan standar "plate")
  else if (dieProsesStandardDie.includes("plate")) {
    if (prosesValue.includes("blank")) { factor = 0.52; }
    else if (prosesValue.includes("trim")) { factor = 0.52; }
    else if (prosesValue.includes("bend")) { factor = 0.50; }
    else if (prosesValue.includes("form")) { factor = 0.50; }
    else if (prosesValue.includes("pie")) { factor = 0.46; }
    else if (prosesValue.includes("fl")) { factor = 0.46; }
    else if (prosesValue.includes("draw")) { factor = 0.45; }
  }

  console.log("Factor:", factor);

  // Menghitung berat die
  var dieWeight = (dieLength * dieWidth * dieHeight * factor * 7.85) / 1000000;
  var dieWeightElem = row.querySelector('input[name="die_weight[]"]');

  if (dieWeightElem) {
    dieWeightElem.value = dieWeight.toFixed(2);
  } else {
    console.error("Element input[name='die_weight[]'] tidak ditemukan.", row);
  }
}
function fetchMachineData() {
  document.getElementById('errorMessage').innerHTML = '';
  var processes = document.getElementsByName('process[]');
  var prosess   = document.getElementsByName('proses[]');
  var length_mps = document.getElementsByName('length_mp[]');
  var main_pressures = document.getElementsByName('main_pressure[]');
  // Elemen ini adalah dropdown (select) untuk die_proses_standard_die
  var die_proses_standard_die = document.getElementsByName('die_proses_standard_die[]');
  
  var totalRows = processes.length;
  // Validasi input untuk setiap baris
  for (var i = 0; i < totalRows; i++) {
    if (
      processes[i].value === '' ||
      prosess[i].value === '' ||
      length_mps[i].value === '' ||
      main_pressures[i].value === ''
    ) {
      var errorMsg = 'Pastikan kolom Process, Proses, Length MP, dan Main Pressure tidak kosong pada baris ke-' + (i + 1);
      document.getElementById('errorMessage').innerHTML = errorMsg;
      alert(errorMsg);
      return;
    }
  }

  var formData = new FormData();
  for (var i = 0; i < totalRows; i++) {
    // Append data dari Basic Table
    formData.append('process[]', processes[i].value);
    formData.append('proses[]', prosess[i].value);
    formData.append('length_mp[]', length_mps[i].value);
    formData.append('main_pressure[]', main_pressures[i].value);
    
    let mainPressure = parseFloat(main_pressures[i].value) || 0;
    let prosesVal = prosess[i].value;
    let computedValue = "";
    // Hitung nilai berdasarkan kondisi mainPressure dan process
    if (mainPressure > 3914) {
      if (["DRAW", "FORM", "FORM-BEND", "BEND1-BEND2", "BEND", "BEND-REST", "BEND-FL", "FORM-FL"].includes(prosesVal)) {
        computedValue = "BIG DIE|SINGLE|DRAW";
      } else if (prosesVal === "FLANGE") {
        computedValue = "BIG DIE|SINGLE|FFLANGE";
      } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-TRIM", "REST", "TR", "CUT"].includes(prosesVal)) {
        computedValue = "BIG DIE|SINGLE|TRIM";
      }
    } else if (mainPressure >= 848 && mainPressure <= 3914) {
      if (["DRAW", "FORM", "FORM-BEND", "FORM-FL", "BEND", "BEND-REST", "BEND-FL", "BEND1-BEND2"].includes(prosesVal)) {
        computedValue = "MEDIUM DIE|SINGLE|DRAW";
      } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-PIERCE", "SEP-TRIM", "REST"].includes(prosesVal)) {
        computedValue = "MEDIUM DIE|SINGLE|TRIM";
      } else if (prosesVal === "FLANGE") {
        computedValue = "MEDIUM DIE|SINGLE|FLANGE";
      }
    } else {
      if (["DRAW", "FORM", "FORM-BEND", "BEND1-BEND2", "BEND", "BEND-REST"].includes(prosesVal)) {
        computedValue = "SMALL DIE|SINGLE|FORMING";
      } else if (["TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "SEP", "SEP-TRIM", "REST", "TR", "CUT"].includes(prosesVal)) {
        computedValue = "SMALL DIE|SINGLE|BLANK";
      } else {
        computedValue = "SMALL DIE";
      }
    }
    // Set nilai computedValue ke dropdown. Cara ini akan memilih opsi yang memiliki value sama.
    die_proses_standard_die[i].value = computedValue;
    // Append nilai dropdown ke formData
    formData.append('die_proses_standard_die[]', computedValue);
    console.log(computedValue + "dwe" );
  }
  
  console.log(formData.getAll('die_proses_standard_die[]'));

  var dieTable = document.getElementById("dieTable"); // Pastikan ID sesuai
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
      alert(data.error);
    } else if (data.success) {
      // Update kolom mesin, capacity, dan cushion dari data master_table
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
      }
      if (data.machine_data) {
        populateNewMasterTable(data.machine_data, data.die_width_standard, data.die_length_standard, data.die_height_standard);
     
      }
      document.getElementById("capacityColumn").style.display = "table-cell";
    document.getElementById("cushionColumn").style.display = "table-cell";
    
    // Menampilkan sel-sel Capacity dan Cushion pada setiap baris <tbody>
    var capacityCells = document.querySelectorAll('td input[name="capacity[]"]');
    capacityCells.forEach(function(input) {
        input.parentElement.style.display = "table-cell";
    });
    
    var cushionCells = document.querySelectorAll('td input[name="cushion[]"]');
    cushionCells.forEach(function(input) {
        input.parentElement.style.display = "table-cell";
    });
      // alert('Data mesin berhasil di-fetch.');
    }
  })
  .catch(error => {
    var errorMsg = 'Terjadi kesalahan: ' + error;
    document.getElementById('errorMessage').innerHTML = errorMsg;
    console.error(errorMsg);
    alert(errorMsg);
  });
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
   
    // Kolom dari machine_data
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
    // Pastikan elemen dengan indeks index tersedia
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
// XYZ
function onStandardChange(selectElem) {  
  // Dapatkan nilai yang dipilih pada dropdown standard
  var selectedStandard = selectElem.value; 

  // Ambil row Basic yang mengandung dropdown standard
  var basicRow = selectElem.closest('tr');
  // Ambil semua baris dari tbody dieTableBody
  var dieTableBody = document.getElementById('dieTableBody');
  var dieRows = Array.from(dieTableBody.children);
  // Asumsikan indeks baris Basic sama dengan indeks baris di Die Table
  var rowIndex = dieRows.indexOf(basicRow);
  
  // Siapkan data untuk dikirim ke server
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
      alert(data.error);
    } else if (data.success) {
      // Ambil nilai die_length dan die_height dari response
      var dieLengthValue = data.data['die_length'];
      var dieWidthValue = data.data['die_width'];
      
      // Update cell ke-3 dan ke-4 pada baris yang sama di tbody dieTableBody
      // Indeks cell 2 = kolom ke-3; indeks cell 3 = kolom ke-4
    // Update input pada cell ke-3 dan ke-4 pada baris yang sama di tbody dieTableBody
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
    alert("Terjadi kesalahan: " + error);
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
      alert(data.error);
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
        input.name = field + "[]"; // nama input disesuaikan, misal: bolster_length[]
        input.value = (data.machine_data && data.machine_data[field]) ? data.machine_data[field] : "";
        input.className = "form-control";
        // input.readOnly = true; 
        td.appendChild(input);
        newRow.appendChild(td);
      });

      // PERUBAHAN: Update nilai Capacity dan Cushion di baris Basic
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
    alert("Terjadi kesalahan: " + error);
    console.error(error);
  });
}
</script>

<?= $this->endSection() ?>