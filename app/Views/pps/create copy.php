<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<style>
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
</style>
<div class="pd-ltr-20 xs-pd-20-10">
  <div class="min-height-200px">
    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="title">
            <h4>Input Data untuk Excel</h4>
          </div>
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= site_url('pps'); ?>">Excel Data</a></li>
              <li class="breadcrumb-item active" aria-current="page">Form Input Excel</li>
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

      <form action="<?= site_url('pps/submit') ?>" method="post" enctype="multipart/form-data">

    <!-- Upload File -->
    <div class="card p-3 mb-3">
        <div class="row">
            <div class="col-md-6">
                <label>Upload Excel File <span class="text-danger">*</span></label>
                <input type="file" name="excel_file" class="form-control" accept=".xls,.xlsx" required>
            </div>
        </div>
    </div>

    <!-- Header -->
    <div class="card p-3 mb-3">
        <h5>Header Information</h5>
        <div class="row">
            <div class="col-md-6">
                <label>Customer <span class="text-danger">*</span></label>
                <input type="text" id="cust" name="cust" class="form-control" required>

                <!-- Container untuk suggestion cust -->
                <div id="cust-suggestions" class="suggestions-dropdown" style="display: none;"></div>
            </div>
            <div class="col-md-6">
                <label>Model <span class="text-danger">*</span></label>
                <input type="text" id="model" name="model" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Receive</label>
                <input type="date" id="receive" name="receive" class="form-control">
            </div>
        </div>
    </div>

    <!-- Part Information -->
    <div class="card p-3 mb-3">
        <h5>Part Information</h5>
        <div class="row">
            <div class="col-md-6">
                <label>Part No</label>
                <input type="text" id="part_no" name="part_no" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Part Name</label>
                <input type="text" id="part_name" name="part_name" class="form-control">
            </div>
        </div>
    </div>

    <!-- Material Details -->
    <div class="card p-3 mb-3">
        <h5>Material Details</h5>
        <div class="row">
            <div class="col-md-4">
                <label>CF</label>
                <input type="text" id="cf" name="cf" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Material</label>
                <input type="text" id="material" name="material" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Tonasi</label>
                <input type="text" id="tonasi" name="tonasi" class="form-control">
            </div>
        </div>
    </div>

    <!-- Measurement -->
    <div class="card p-3 mb-3">
        <h5>Blank Size</h5>
        <div class="row">
            <div class="col-md-4">
                <label>Length</label>
                <input type="text" id="length" name="length" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Width</label>
                <input type="text" id="width" name="width" class="form-control">
            </div>
            <div class="col-md-4">
                <label>BOQ</label>
                <input type="text" id="boq" name="boq" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>Blank (Kg)</label>
                <input type="text" id="blank" name="blank" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Panel (Kg)</label>
                <input type="text" id="panel" name="panel" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Scrap (Kg)</label>
                <input type="text" id="scrap" name="scrap" class="form-control">
            </div>
        </div>
    </div>
  
    <!-- Dies Details -->
    <div class="card p-3 mb-3">
        <h5>Dies Configuration</h5>
        <div class="row">
            <div class="col-md-6">
                <label>Total Dies (max 6) <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="number" id="total_dies" name="total_dies" class="form-control" max="6" min="1" required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-info" onclick="generateRows()">Generate</button>
                        <button type="button" class="btn btn-primary" onclick="fetchMachineData()">Fetch Data</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tables -->
    <div class="card p-3 mb-3">
        <h5>Basic Table</h5>
       <table class="table table-bordered">
          <thead id="dynamicTableHead">
              <tr>
                  <th>Process</th>
                  <th>Process Join</th>
                  <th>Proses</th>
                  <th>Length MP</th>
                  <th>Main Pressure</th>
                  <th>Machine</th>
                  <th>Capacity</th>
                  <th>Cushion</th>
                  <th>Die Length</th>
                  <th>Die Width</th>
                  <th>Die Height</th>
                  <th>Casting/Plate</th>
                  <th>Die Weight</th>
              </tr>
          </thead>
          <tbody id="basicTableBody"></tbody>
      </table>
    </div>
    <div class="card p-3 mb-3">
        <h5>Additional Information</h5>
        <div class="form-group row">
            <div class="col-md-4">
                <label for="total_mp" class="col-form-label">Total MP</label>
                <input type="text" id="total_mp" name="total_mp" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="doc_level" class="col-form-label">Doc Level</label>
                <input type="text" id="doc_level" name="doc_level" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="total_stroke" class="col-form-label">Total Stroke</label>
                <input type="text" id="total_stroke" name="total_stroke" class="form-control">
            </div>
        </div>
    </div>

    <div class="card p-3 mb-3">
        <h5>New Master Table</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Machine</th>
                    <th>Bolster Area L</th>
                    <th>Bolster Area W</th>
                    <th>Slide Area L</th>
                    <th>Slide Area W</th>
                </tr>
            </thead>
            <tbody id="newTableBody"></tbody>
        </table>
    </div>
   
    <div class="card p-3 mb-3">
      <h5>Die Construction</h5>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Process</th>
            <th>Machine</th>
            <th>Upper</th>
            <th>Lower</th>
            <th>Pad</th>
            <th>Pad Lifter</th>
            <th>Sliding</th>
            <th>Guide</th>
            <th>Insert</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="dieConstructionTableBody">
          <!-- Baris die_construction akan di-generate oleh fungsi generateDieConstructionTable() -->
        </tbody>
      </table>
    </div>
    <div class="card p-3 mb-3">
      <h5>Upload Gambar C-Layout dan Dis Construction</h5>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Process</th>
            <th>C-Layout</th>
            <th>Die Constuction</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="dieImage">
          <!-- Baris  akan di-generate oleh fungsi  -->
        </tbody>
      </table>
    </div>
    <div class="card p-3 mb-3">
        <div class="row">
            <div class="col-md-6">
                <label>Gambar Blank Layout <span class="text-danger">*</span></label>
                <input type="file" name="blank_layout_img" class="form-control" accept=".xls,.xlsx" required>
            </div>
        </div>
    </div>
    <!-- Submission -->
    <div class="form-group text-center">
        <button type="submit" class="btn btn-success">Submit</button>
        <a href="<?= site_url('dashboard'); ?>" class="btn btn-secondary">Back</a>
    </div>
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

    let tes =l * w * t * 7.85/ 1000000;
    let result = (l * w * t * 7.85 / 1000000) / b;
    blank.value = result
     
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
    alert('Total Dies harus antara 1 dan 6.');
    return;
  }
  var basicTableBody = document.getElementById('basicTableBody');
  var newTableBody = document.getElementById('newTableBody');
  var dieImageBody   = document.getElementById('dieImage');
  basicTableBody.innerHTML = '';
  newTableBody.innerHTML = '';
  dieImageBody.innerHTML   = '';
  var processOptions = [];
  for (var j = 1; j <= 8; j++) {
    processOptions.push("OP" + (j * 10));
  }
  var prosesOptions = ["DRAW", "FORM", "FORM-BEND", "FORM-FL", "TRIM", "TRIM-PI", "BLANK", "BLANK-PI", "BEND", "BEND-REST", "BEND-FL", "BEND1-BEND2", "SEP", "SEP-PIERCE", "SEP-TRIM", "REST", "FLANGE", "TR", "CUT"];
  var machineOptions = [];
  var letters = ['A','B','C','D','E','F','G','H'];
  letters.forEach(function(letter) {
    for (var i = 1; i <= 4; i++){
      machineOptions.push(letter + i);
    }
  });
  machineOptions = machineOptions.concat(['mp','SP1','SP2','SP3']);

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
    select1.addEventListener('change', function() {
      calculateTotalMP();
      generateDieConstructionTable();
       var basicRow = this.closest('tr');
  var basicRows = Array.from(document.getElementById('basicTableBody').children);
  var rowIndex = basicRows.indexOf(basicRow);
  var dieImageBody = document.getElementById('dieImage');
  var dieImageRow = dieImageBody.children[rowIndex];
  if (dieImageRow) {
    var processInput = dieImageRow.querySelector('input[name="die_image_process[]"]');
    if (processInput) {
      processInput.value = this.value;
    }
  }
    });
    cell1.appendChild(select1);
    basicRow.appendChild(cell1);

    // Process Join
    var cell2 = document.createElement('td');
    var input2 = document.createElement('input');
    input2.type = 'text';
    input2.name = 'process_join[]';
    input2.placeholder = 'Process Join';
    input2.className = 'form-control';
    cell2.appendChild(input2);
    basicRow.appendChild(cell2);

    // Proses
    var cell3 = document.createElement('td');
    var select2 = document.createElement('select');
    select2.name = 'proses[]';
    select2.className = 'custom-select2 form-control';
    select2.setAttribute("onchange", "calculateMainPressure(this); calculateDieWeight(this); calculateTotalMP();");
    prosesOptions.forEach(function(opt) {
      var option = document.createElement('option');
      option.value = opt;
      option.textContent = opt;
      select2.appendChild(option);
    });
    cell3.appendChild(select2);
    basicRow.appendChild(cell3);

    // Length MP
    var cell4 = document.createElement('td');
    var input4 = document.createElement('input');
    input4.type = 'text';
    input4.name = 'length_mp[]';
    input4.placeholder = 'Length MP';
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
    cell5.appendChild(input5);
    basicRow.appendChild(cell5);

    // Machine (basic) – misalnya untuk hasil fetch dari master_table
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
    var inputCushion = document.createElement('input');
    inputCushion.type = 'text';
    inputCushion.name = 'cushion[]';
    inputCushion.placeholder = 'Cushion';
    inputCushion.className = 'form-control';
    inputCushion.readOnly = true;
    cellCushion.appendChild(inputCushion);
    basicRow.appendChild(cellCushion);

    // Die Length
    var cellDieLength = document.createElement('td');
    var inputDieLength = document.createElement('input');
    inputDieLength.type = 'text';
    inputDieLength.name = 'die_length[]';
    inputDieLength.placeholder = 'Die Length';
    inputDieLength.className = 'form-control';
    inputDieLength.setAttribute("oninput", "calculateDieWeight(this)");
    cellDieLength.appendChild(inputDieLength);
    basicRow.appendChild(cellDieLength);

    // Die Width
    var cellDieWidth = document.createElement('td');
    var inputDieWidth = document.createElement('input');
    inputDieWidth.type = 'text';
    inputDieWidth.name = 'die_width[]';
    inputDieWidth.placeholder = 'Die Width';
    inputDieWidth.className = 'form-control';
    inputDieWidth.setAttribute("oninput", "calculateDieWeight(this)");
    cellDieWidth.appendChild(inputDieWidth);
    basicRow.appendChild(cellDieWidth);

    // Die Height
    var cellDieHeight = document.createElement('td');
    var inputDieHeight = document.createElement('input');
    inputDieHeight.type = 'text';
    inputDieHeight.name = 'die_height[]';
    inputDieHeight.placeholder = 'Die Height';
    inputDieHeight.className = 'form-control';
    inputDieHeight.setAttribute("oninput", "calculateDieWeight(this)");
    cellDieHeight.appendChild(inputDieHeight);
    basicRow.appendChild(cellDieHeight);

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
    basicRow.appendChild(cellCastingPlate);

    // Die Weight
    var cellDieWeight = document.createElement('td');
    var inputDieWeight = document.createElement('input');
    inputDieWeight.type = 'text';
    inputDieWeight.name = 'die_weight[]';
    inputDieWeight.placeholder = 'Die Weight';
    inputDieWeight.className = 'form-control';
    inputDieWeight.readOnly = true;
    cellDieWeight.appendChild(inputDieWeight);
    basicRow.appendChild(cellDieWeight);

    basicTableBody.appendChild(basicRow);

    // --- Tabel Extra (Kolom tambahan) ---
    var extraRow = document.createElement('tr');

    // Bolster Area L
    var cellBolsterAreaL = document.createElement('td');
    var inputBolsterAreaL = document.createElement('input');
    inputBolsterAreaL.type = 'text';
    inputBolsterAreaL.name = 'bolster_area_l[]';
    inputBolsterAreaL.placeholder = 'Bolster Area L';
    inputBolsterAreaL.className = 'form-control';
    cellBolsterAreaL.appendChild(inputBolsterAreaL);
    extraRow.appendChild(cellBolsterAreaL);

    // Bolster Area W
    var cellBolsterAreaW = document.createElement('td');
    var inputBolsterAreaW = document.createElement('input');
    inputBolsterAreaW.type = 'text';
    inputBolsterAreaW.name = 'bolster_area_w[]';
    inputBolsterAreaW.placeholder = 'Bolster Area W';
    inputBolsterAreaW.className = 'form-control';
    cellBolsterAreaW.appendChild(inputBolsterAreaW);
    extraRow.appendChild(cellBolsterAreaW);

    // Slide Area L
    var cellSlideAreaL = document.createElement('td');
    var inputSlideAreaL = document.createElement('input');
    inputSlideAreaL.type = 'text';
    inputSlideAreaL.name = 'slide_area_l[]';
    inputSlideAreaL.placeholder = 'Slide Area L';
    inputSlideAreaL.className = 'form-control';
    cellSlideAreaL.appendChild(inputSlideAreaL);
    extraRow.appendChild(cellSlideAreaL);

    // Slide Area W
    var cellSlideAreaW = document.createElement('td');
    var inputSlideAreaW = document.createElement('input');
    inputSlideAreaW.type = 'text';
    inputSlideAreaW.name = 'slide_area_w[]';
    inputSlideAreaW.placeholder = 'Slide Area W';
    inputSlideAreaW.className = 'form-control';
    cellSlideAreaW.appendChild(inputSlideAreaW);
    extraRow.appendChild(cellSlideAreaW);

    // Die Height Max 1
    var cellDieHeightMax1 = document.createElement('td');
    var inputDieHeightMax1 = document.createElement('input');
    inputDieHeightMax1.type = 'text';
    inputDieHeightMax1.name = 'die_height_max1[]';
    inputDieHeightMax1.placeholder = 'Die Height Max 1';
    inputDieHeightMax1.className = 'form-control';
    cellDieHeightMax1.appendChild(inputDieHeightMax1);
    extraRow.appendChild(cellDieHeightMax1);

    // Die Height Max 2
    var cellDieHeightMax2 = document.createElement('td');
    var inputDieHeightMax2 = document.createElement('input');
    inputDieHeightMax2.type = 'text';
    inputDieHeightMax2.name = 'die_height_max2[]';
    inputDieHeightMax2.placeholder = 'Die Height Max 2';
    inputDieHeightMax2.className = 'form-control';
    cellDieHeightMax2.appendChild(inputDieHeightMax2);
    extraRow.appendChild(cellDieHeightMax2);

    // Die Cushion Pad L
    var cellDieCushionPadL = document.createElement('td');
    var inputDieCushionPadL = document.createElement('input');
    inputDieCushionPadL.type = 'text';
    inputDieCushionPadL.name = 'die_cushion_pad_l[]';
    inputDieCushionPadL.placeholder = 'Die Cushion Pad L';
    inputDieCushionPadL.className = 'form-control';
    cellDieCushionPadL.appendChild(inputDieCushionPadL);
    extraRow.appendChild(cellDieCushionPadL);

    // Die Cushion Pad W
    var cellDieCushionPadW = document.createElement('td');
    var inputDieCushionPadW = document.createElement('input');
    inputDieCushionPadW.type = 'text';
    inputDieCushionPadW.name = 'die_cushion_pad_w[]';
    inputDieCushionPadW.placeholder = 'Die Cushion Pad W';
    inputDieCushionPadW.className = 'form-control';
    cellDieCushionPadW.appendChild(inputDieCushionPadW);
    extraRow.appendChild(cellDieCushionPadW);

    // Cushion Stroke
    var cellCushionStroke = document.createElement('td');
    var inputCushionStroke = document.createElement('input');
    inputCushionStroke.type = 'text';
    inputCushionStroke.name = 'cushion_stroke[]';
    inputCushionStroke.placeholder = 'Cushion Stroke';
    inputCushionStroke.className = 'form-control';
    cellCushionStroke.appendChild(inputCushionStroke);
    extraRow.appendChild(cellCushionStroke);

    newTableBody.appendChild(extraRow);
    var dieImageRow = document.createElement('tr');
    
    // Kolom Process: input text dengan nilai yang sama seperti dropdown process basic
    var dieProcessCell = document.createElement('td');
    var dieProcessInput = document.createElement('input');
    dieProcessInput.type = 'text';
    dieProcessInput.name = 'die_image_process[]';
    dieProcessInput.value = select1.value; // ambil nilai dari process basic
    dieProcessInput.className = 'form-control';
    dieProcessInput.readOnly = true;
    dieProcessCell.appendChild(dieProcessInput);
    dieImageRow.appendChild(dieProcessCell);
    
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
  var processSelects = document.getElementsByName('process[]');
  var machineSelects = document.getElementsByName('machine[]');
  var dieConstructionBody = document.getElementById('dieConstructionTableBody');
  dieConstructionBody.innerHTML = ""; // Kosongkan tabel

  // Ambil nilai material dan tonasi dari input form
  var material = parseFloat(document.getElementById('material').value) || 0;
  var tonasi = parseFloat(document.getElementById('tonasi').value) || 0;
  var insertValue = (material > 590 && tonasi > 1.6) ? "SKD11" : "";

  // Loop sebanyak jumlah baris di Tabel Basic
  for (var i = 0; i < processSelects.length; i++) {
    var processValue = processSelects[i].value;
    var machineValue = machineSelects[i].value;
    
    // Logika pengisian kolom Upper dan Lower
    var upperValue = (machineValue.indexOf("SP") !== -1) ? "SS41" : "FC300";
    var lowerValue = upperValue; // sama dengan upper
    // Kolom Pad
    var padValue = (machineValue.indexOf("SP") !== -1) ? "S45C" : "";
    // Kolom Pad Lifter
    var padLifterValue = (machineValue.indexOf("SP") !== -1) ? "Coil Spring" : "Gas Spring";
    // Kolom Sliding selalu diisi "Wear Plate"
    var slidingValue = "Wear Plate";
    // Kolom Guide
    var guideValue = (machineValue.indexOf("SP") !== -1) ? "Guide Post" : "Guide Hell";
    
    // Buat baris baru untuk Die Construction
    var tr = document.createElement("tr");

    // Fungsi bantu untuk membuat cell dengan input readonly
    function createTdInput(name, value) {
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
    tr.appendChild(createTdInput("process2[]", processValue));    // Process
    tr.appendChild(createTdInput("machine2[]", machineValue));      // Machine
    tr.appendChild(createTdInput("upper[]", upperValue));            // Upper
    tr.appendChild(createTdInput("lower[]", lowerValue));            // Lower
    tr.appendChild(createTdInput("pad[]", padValue));                // Pad
    tr.appendChild(createTdInput("pad_lifter[]", padLifterValue));   // Pad Lifter
    tr.appendChild(createTdInput("sliding[]", slidingValue));        // Sliding
    tr.appendChild(createTdInput("guide[]", guideValue));            // Guide
    tr.appendChild(createTdInput("insert[]", insertValue));
    // Kolom Upload Gambar
    var tdImageUpload = document.createElement("td");

    var imgPreview = document.createElement("img");
    imgPreview.style.width = "50px"; // Thumbnail kecil
    imgPreview.style.height = "50px";
    imgPreview.style.display = "none"; // Sembunyikan awalnya
    imgPreview.style.marginRight = "10px";

    var inputFile = document.createElement("input");
    inputFile.type = "file";
    inputFile.accept = "image/*";
    inputFile.className = "form-control-file";
    inputFile.addEventListener("change", function(event) {
      var file = event.target.files[0];
      if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
          imgPreview.src = e.target.result;
          imgPreview.style.display = "inline";
        };
        reader.readAsDataURL(file);
      }
    });

    tdImageUpload.appendChild(imgPreview);
    tdImageUpload.appendChild(inputFile);
    tr.appendChild(tdImageUpload);

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
    tensile_material = 100; // Nilai default
  }

   var tonasi = parseFloat(document.getElementById('tonasi').value) || 0;
  var proses = row.querySelector('select[name="proses[]"]').value;
  var mainPressureInput = row.querySelector('input[name="main_pressure[]"]');
  var specialProcesses = ["BLANK", "BLANK-PI", "TRIM", "TRIM-PI", "SEP", "SEP-PIERCE", "SEP-TRIM", "TR", "CUT"];
  var multiplier = specialProcesses.includes(proses) ? 1 : 2.5;
  var mainPressure = (length_mp * tonasi * 0.8 * tensile_material * 1.2 * multiplier)/1000;
  console.log( tensile_material);
  if(mainPressureInput) { mainPressureInput.value = mainPressure.toFixed(2); }
}

// Fungsi untuk menghitung Die Weight
function calculateDieWeight(element) {
  var row = element.closest('tr');
  var dieLength = parseFloat(row.querySelector('input[name="die_length[]"]').value) || 0;
  var dieWidth = parseFloat(row.querySelector('input[name="die_width[]"]').value) || 0;
  var dieHeight = parseFloat(row.querySelector('input[name="die_height[]"]').value) || 0;
  var prosesElem = row.querySelector('select[name="proses[]"]');
  var castingPlateElem = row.querySelector('select[name="casting_plate[]"]');
  if (!prosesElem || !castingPlateElem) {
    console.error("Element proses atau casting_plate tidak ditemukan.", row);
    return;
  }
  var prosesValue = prosesElem.value.toLowerCase();
  var castingPlateValue = castingPlateElem.value.toLowerCase();
  var factor = 1;
  if (castingPlateValue === "casting") {
    if (prosesValue === "bend") { factor = 0.44; }
    else if (prosesValue === "blank") { factor = 0.40; }
    else if (prosesValue === "draw") { factor = 0.37; }
    else if (prosesValue === "flange") { factor = 0.40; }
    else if (prosesValue === "form") { factor = 0.43; }
    else if (prosesValue === "pie") { factor = 0.39; }
    else if (prosesValue === "trim") { factor = 0.38; }
  } else if (castingPlateValue === "plate") {
    if (prosesValue === "bend") { factor = 0.50; }
    else if (prosesValue === "blank") { factor = 0.52; }
    else if (prosesValue === "draw") { factor = 0.45; }
    else if (prosesValue === "flange") { factor = 0.46; }
    else if (prosesValue === "form") { factor = 0.50; }
    else if (prosesValue === "pie") { factor = 0.46; }
    else if (prosesValue === "trim") { factor = 0.52; }
  }
  console.log(factor);
  var dieWeight = dieLength * dieWidth * dieHeight * factor * 7.85 / 1000000;
  var dieWeightElem = row.querySelector('input[name="die_weight[]"]');
  if(dieWeightElem) {
    dieWeightElem.value = dieWeight.toFixed(2);
  } else {
    console.error("Element input[name='die_weight[]'] tidak ditemukan.", row);
  }
}

// Fungsi Fetch Data Machine
function fetchMachineData() {
  document.getElementById('errorMessage').innerHTML = '';
  var processes = document.getElementsByName('process[]');
  var prosess   = document.getElementsByName('proses[]');
  var length_mps = document.getElementsByName('length_mp[]');
  var main_pressures = document.getElementsByName('main_pressure[]');
  var totalRows = processes.length;

  for (var i = 0; i < totalRows; i++) {
    if (processes[i].value === '' || prosess[i].value === '' || length_mps[i].value === '' || main_pressures[i].value === '') {
      var errorMsg = 'Pastikan kolom Process, Proses, Length MP, dan Main Pressure tidak kosong pada baris ke-' + (i + 1);
      document.getElementById('errorMessage').innerHTML = errorMsg;
      alert(errorMsg);
      return;
    }
  }

  var formData = new FormData();
  for (var i = 0; i < totalRows; i++) {
    formData.append('process[]', processes[i].value);
    formData.append('proses[]', prosess[i].value);
    formData.append('length_mp[]', length_mps[i].value);
    formData.append('main_pressure[]', main_pressures[i].value);
  }
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
      // Update data untuk kolom dari master_table
      var machineSelects = document.getElementsByName('machine[]');
      var capacityInputs = document.getElementsByName('capacity[]');
      var cushionInputs = document.getElementsByName('cushion[]');

      for (var i = 0; i < machineSelects.length; i++) {
        var machineValue = data.data['machine' + (i + 1)];
        var capacityValue = data.data['capacity' + (i + 1)];
        var cushionValue = data.data['cushion' + (i + 1)];
        if (machineValue) { machineSelects[i].value = machineValue; }
        if (capacityValue && capacityInputs[i]) { capacityInputs[i].value = capacityValue; }
        if (cushionValue && cushionInputs[i]) { cushionInputs[i].value = cushionValue; }
      }
      if (data.machine_data) {
        populateNewMasterTable(data.machine_data);
      }
      alert('Data mesin berhasil di-fetch.');
    }
  })
  .catch(error => {
    var errorMsg = 'Terjadi kesalahan: ' + error;
    document.getElementById('errorMessage').innerHTML = errorMsg;
    console.error(errorMsg);
    alert(errorMsg);
  });
}

// Fungsi untuk mengisi tabel baru dengan data dari new_master_table
function populateNewMasterTable(machineDataArray) {
  var tableBody = document.getElementById('newTableBody');
  tableBody.innerHTML = "";
  if (machineDataArray.length === 0) {
    tableBody.innerHTML = "<tr><td colspan='9'>No data found.</td></tr>";
    return;
  }
  machineDataArray.forEach(function(item) {
    var tr = document.createElement("tr");

    var cellMachine = document.createElement("td");
    cellMachine.textContent = item.machine;
    tr.appendChild(cellMachine);

    var cellBolsterL = document.createElement("td");
    cellBolsterL.textContent = item.bolster_length;
    tr.appendChild(cellBolsterL);

    var cellBolsterW = document.createElement("td");
    cellBolsterW.textContent = item.bolster_width;
    tr.appendChild(cellBolsterW);

    var cellSlideL = document.createElement("td");
    cellSlideL.textContent = item.slide_area_length;
    tr.appendChild(cellSlideL);

    var cellSlideW = document.createElement("td");
    cellSlideW.textContent = item.slide_area_width;
    tr.appendChild(cellSlideW);

    var cellDieHeight = document.createElement("td");
    cellDieHeight.textContent = item.die_height;
    tr.appendChild(cellDieHeight);

    var cellCushionPadL = document.createElement("td");
    cellCushionPadL.textContent = item.cushion_pad_length;
    tr.appendChild(cellCushionPadL);

    var cellCushionPadW = document.createElement("td");
    cellCushionPadW.textContent = item.cushion_pad_width;
    tr.appendChild(cellCushionPadW);

    var cellCushionStroke = document.createElement("td");
    cellCushionStroke.textContent = item.cushion_stroke;
    tr.appendChild(cellCushionStroke);

    tableBody.appendChild(tr);
  });
}
function onMachineChange(selectElem) { 
  var selectedMachine = selectElem.value; 
  var basicRow = selectElem.closest('tr');
  var basicTbody = document.getElementById('basicTableBody');
  var basicRows = Array.from(basicTbody.children);
  var rowIndex = basicRows.indexOf(basicRow); 

  // Siapkan data untuk dikirim ke server
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

      // Perbarui data pada tabel tambahan (newTableBody)
      var newTbody = document.getElementById('newTableBody');
      // Pastikan newTbody memiliki jumlah baris minimal sampai rowIndex
      while (newTbody.children.length <= rowIndex) {
        var tempRow = document.createElement("tr");
        // Buat 9 kolom kosong sesuai kebutuhan
        for (var j = 0; j < 9; j++) {
          var td = document.createElement("td");
          td.textContent = "";
          tempRow.appendChild(td);
        }
        newTbody.appendChild(tempRow);
      }

      // Hapus isi baris lama dan siapkan untuk data baru
      var newRow = newTbody.children[rowIndex];
      newRow.innerHTML = "";
      // Daftar field yang akan diisi pada row baru
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
        td.textContent = (data.machine_data && data.machine_data[field]) ? data.machine_data[field] : "";
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