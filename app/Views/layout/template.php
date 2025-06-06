<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daily Report</title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/vendors/images/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/vendors/images/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png"  href="<?= base_url('assets/images/logo2.png') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/styles/core.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/styles/icon-font.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/datatables/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/datatables/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/styles/style.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css">

    <!-- jQuery (diperlukan untuk AJAX) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- FullCalendar JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/locales-all.min.js"></script>

    <?= $this->renderSection('styles') ?>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-119386393-1');

    const defaultHeader = 'white';
    const defaultSidebar = 'dark';
    const defaultMenuDropdown = 'icon-style-1';
    const defaultMenuList = 'icon-list-style-1';

    function saveLayoutSettings() {
        const headerBackground = document.querySelector('.header-white').classList.contains('active') ? 'white' : 'dark';
        const sidebarBackground = document.querySelector('.sidebar-dark').classList.contains('active') ? 'dark' : 'white';
        localStorage.setItem('headerBackground', headerBackground);
        localStorage.setItem('sidebarBackground', sidebarBackground);
        const menuDropdownIcon = document.querySelector('input[name="menu-dropdown-icon"]:checked').value;
        const menuListIcon = document.querySelector('input[name="menu-list-icon"]:checked').value;
        localStorage.setItem('menuDropdownIcon', menuDropdownIcon);
        localStorage.setItem('menuListIcon', menuListIcon);
        alert("Layout saved, love.");
    }
    function applyLayoutSettings() {
        const headerBackground = localStorage.getItem('headerBackground') || defaultHeader;
        const sidebarBackground = localStorage.getItem('sidebarBackground') || defaultSidebar;
        const menuDropdownIcon = localStorage.getItem('menuDropdownIcon') || defaultMenuDropdown;
        const menuListIcon = localStorage.getItem('menuListIcon') || defaultMenuList;
        // Remove active classes from header options
        document.querySelector('.header-white').classList.remove('active');
        document.querySelector('.header-dark').classList.remove('active');
        // Add the proper header active class
        if(headerBackground === 'white'){
            document.querySelector('.header-white').classList.add('active');
        } else {
            document.querySelector('.header-dark').classList.add('active');
        }
        // Remove active classes from sidebar options
        document.querySelector('.sidebar-light').classList.remove('active');
        document.querySelector('.sidebar-dark').classList.remove('active');
        // Add the proper sidebar active class
        if(sidebarBackground === 'white'){
            document.querySelector('.sidebar-light').classList.add('active');
        } else {
            document.querySelector('.sidebar-dark').classList.add('active');
        }
        // Set radio inputs for menu icons
        document.querySelector(`input[name="menu-dropdown-icon"][value="${menuDropdownIcon}"]`).checked = true;
        document.querySelector(`input[name="menu-list-icon"][value="${menuListIcon}"]`).checked = true;
    }
    document.addEventListener('DOMContentLoaded', function() {
        applyLayoutSettings();
        document.getElementById('save-layout')?.addEventListener('click', saveLayoutSettings);
        document.getElementById('reset-settings')?.addEventListener('click', function() {
            localStorage.setItem('headerBackground', defaultHeader);
            localStorage.setItem('sidebarBackground', defaultSidebar);
            localStorage.setItem('menuDropdownIcon', defaultMenuDropdown);
            localStorage.setItem('menuListIcon', defaultMenuList);
            location.reload();
        });
    });
    </script>
    <style>
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            border-radius: .25rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
        }
        .select2-selection__rendered {
            line-height: 1.5 !important;
            padding: 0 !important;
        }
        .select2-selection__arrow {
            height: calc(1.5em + .75rem + 2px) !important;
        }
        img {
            image-rendering: auto;
        }
        .wrap-text {
            word-wrap: break-word; /* Allows breaking long words if needed */
        }

        .text-wrap  {
            white-space: nowrap;    /* Mencegah teks pindah ke baris baru */
            overflow: hidden;       /* Menyembunyikan teks yang melebihi batas */
        
            width: 100%;           
        }


    </style>
    
</head>
<body>
    <div class="header">
        <div class="header-left">
            <div class="menu-icon dw dw-menu"></div>
        </div>
        <div class="header-right">
            <!-- <div class="dashboard-setting user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                        <i class="dw dw-settings2"></i>
                    </a>
                </div>
            </div> -->
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon" style="width: 50px; height: 50px; margin: 0 20px;">
                        <img src="<?= (session()->get('foto')) ? base_url('uploads/users/' .  session()->get('foto') ) : base_url('assets/images/person.jpg'); ?>" alt="" style="width: 45px; height: 45px;">
                    </span>

                        <span class="user-name"><?= session()->get('user_name') ?? 'User' ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="#" id="logout-btn">
                            <i class="dw dw-logout"></i> Log Out
                        </a>
                        <a class="dropdown-item" href="<?= site_url('auth/reset/'.session()->get('nik') ); ?>" id="reset-btn">
                            <i class="dw dw-settings2"></i> Reset Password
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="right-sidebar">
        <div class="sidebar-title">
            <h3 class="weight-600 font-16 text-blue">
                Layout Settings
                <span class="btn-block font-weight-400 font-12">User Interface Settings</span>
            </h3>
            <div class="close-sidebar" data-toggle="right-sidebar-close">
                <i class="icon-copy ion-close-round"></i>
            </div>
        </div>
        <div class="right-sidebar-body customscroll">
            <div class="right-sidebar-body-content">
                <h4 class="weight-600 font-18 pb-10">Header Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary header-white">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
                </div>
                <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark">Dark</a>
                </div>
                <h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
                <div class="sidebar-radio-group pb-10 mb-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked>
                        <label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
                        <label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
                        <label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
                    </div>
                </div>
                <h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
                <div class="sidebar-radio-group pb-30 mb-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked>
                        <label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
                        <label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
                        <label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4">
                        <label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
                        <label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
                        <label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
                    </div>
                </div>
                <div class="reset-options pt-30 text-center">
                    <button class="btn btn-primary mb-3" id="save-layout">Save Layout</button>
                    <button class="btn btn-danger" id="reset-settings">Reset Settings</button>
                </div>
            </div>
        </div>
    </div>
    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="<?= base_url('dashboard') ?>">
                <img src="<?= base_url('assets/images/logo2.png') ?>" alt="" class="dark-logo">
                <img src="<?= base_url('assets/images/logo2.png') ?>" alt="" class="light-logo">
            </a>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
            <ul id="accordion-menu">
        <?php if (has_permission(23)): ?>
        <li>
            <a href="<?= base_url('dashboard') ?>" class="dropdown-toggle no-arrow">
                <span class="micon dw dw-house-1"></span>
                <span class="mtext">Dashboard</span>
            </a>
        </li>
        <?php endif; ?>

        <!-- <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle">
                <span class="micon dw dw-paint-brush"></span><span class="mtext">Icons</span>
            </a>
            <ul class="submenu">
                <li><a href="font-awesome.html">FontAwesome Icons</a></li>
                <li><a href="foundation.html">Foundation Icons</a></li>
                <li><a href="ionicons.html">Ionicons Icons</a></li>
                <li><a href="themify.html">Themify Icons</a></li>
                <li><a href="custom-icon.html">Custom Icons</a></li>
            </ul>
        </li> -->

        <?php if (has_permission(5)): ?>
        <li>
            <a href="<?= base_url('project') ?>" class="dropdown-toggle no-arrow">
                <span class="micon dw dw-briefcase"></span>
                <span class="mtext">Master Project</span>
            </a>
        </li>
        <?php endif; ?>

        <?php if (has_permission(13)): ?>
        <li>
            <a href="<?= base_url('activity') ?>" class="dropdown-toggle no-arrow">
                <span class="micon dw dw-library"></span>
                <span class="mtext">Master Activity</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if (has_permission(28)): ?>
        <li>
            <a href="<?= base_url('holiday') ?>" class="dropdown-toggle no-arrow">
                <span class="micon dw dw-calendar1"></span>
                <span class="mtext">Master Holiday</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if (has_permission(1)): ?>
        <li>
            <a href="<?= base_url('user') ?>" class="dropdown-toggle no-arrow">
                <span class="micon dw dw-user-1"></span>
                <span class="mtext">Master Pengguna</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if (has_permission(9)): ?>
        <li>
            <a href="<?= base_url('role') ?>" class="dropdown-toggle no-arrow">
                <!-- Icon grup atau setting dapat mencerminkan Role -->
                <span class="micon dw dw-group"></span>
                <span class="mtext">Master Role</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if (has_permission(19)): ?>
        <li>
            <a href="<?= base_url('actual-activity/personal') ?>" class="dropdown-toggle no-arrow">
                <span class="micon dw dw-edit2"></span>
                <span class="mtext">Daily Report (LKH)</span>
            </a>
        </li>
        <?php endif; ?>

        <?php if (has_permission(17)): ?>
        <li>
            <a href="<?= base_url('actual-activity') ?>" class="dropdown-toggle no-arrow">
                <!-- Menggunakan icon list agar berbeda dengan icon pengguna -->
                <span class="micon dw dw-list"></span>
                <span class="mtext">List All LKH</span>
            </a>
        </li>
        <?php endif; ?>

        <?php if (has_permission(24)): ?>
        <!-- <li>
            <a href="<?= base_url('history') ?>" class="dropdown-toggle no-arrow">
                <span class="micon dw dw-calendar"></span>
                <span class="mtext">Status Pengisian LKH</span>
            </a>
        </li> -->
             <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon dw dw-calendar"></span><span class="mtext">Status Pengisian LKH</span>
                </a>
                <ul class="submenu">
                    <li><a href="<?= base_url('history') ?>">Mingguan</a></li>
                    <li><a href="<?= base_url('history-monthly') ?>">Bulanan</a></li>
                </ul>
            </li>
        <?php endif; ?>
   
        <?php if (has_permission(31)): ?>
        <li>
            <a href="<?= base_url('izin') ?>" class="dropdown-toggle no-arrow">
                <!-- Icon user biasanya digunakan untuk profile -->
                <span class="micon dw dw-logout1"></span>
                <span class="mtext">Perizinan</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if (has_permission(47)): ?>
        <li>
            <a href="<?= base_url('calendar') ?>" class="dropdown-toggle no-arrow">
         
                <span class="micon dw dw-calendar"></span>
                <span class="mtext">Kalender</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if (has_permission(25)): ?>
        <li>
            <a href="<?= base_url('profile') ?>" class="dropdown-toggle no-arrow">
                <!-- Icon user biasanya digunakan untuk profile -->
                <span class="micon dw dw-user"></span>
                <span class="mtext">Profile</span>
            </a>
        </li>
        <?php endif; ?>
        <!-- <li>
            <a href="<?= base_url('outdoor-activity') ?>" class="dropdown-toggle no-arrow">
                <span class="micon dw dw-rocket"></span>
                <span class="mtext">Outdoor Activity</span>
            </a>
        </li> -->
        <?php if (has_permission(48)): ?>
        <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle">
                <span class="micon dw dw-rocket"></span><span class="mtext">Outdoor Activity</span>
            </a>
            <ul class="submenu">
                <li><a href="<?= base_url('outdoor-activity') ?>">Menu Utama</a></li>
                <li><a href="<?= base_url('outdoor-activity/display') ?>">Display</a></li>
            </ul>
        </li>
        <?php endif; ?>
        <?php if (has_permission(36)): ?>
        <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle">
                <span class="micon icon-copy fa fa-tasks"></span><span class="mtext">Master DCP PPS</span>
            </a>
            <ul class="submenu">
                <li><a href="<?= base_url('cuttingtools') ?>">Cutting Tools (DCP)</a></li>
                <li><a href="<?= base_url('finishing') ?>">Finishing (DCP)</a></li>
                <li><a href="<?= base_url('leadtime') ?>">Lead Time (DCP)</a></li>
                <li><a href="<?= base_url('master-pps') ?>">PPS</a></li>
                <li><a href="<?= base_url('material') ?>">Material</a></li>
                <li><a href="<?= base_url('die-cons') ?>">List Img Die Cons</a></li>
            </ul>
        </li>
        <?php endif; ?>
            <!-- <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon dw dw-book-1"></span><span class="mtext">PPS</span>
                </a>
                <ul class="submenu">
                    <li><a href="<?= base_url('master-pps') ?>">Master Data</a></li>
                    <li><a href="<?= base_url('pps') ?>">PPS</a></li>
                </ul>
            </li> -->
            <?php if (has_permission(37)): ?>
                <li>
                    <a href="<?= base_url('pps') ?>" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-book-1"></span>
                        <span class="mtext">Form PPS</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (has_permission(36)): ?>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon icon-copy dw  dw-folder"></span><span class="mtext">Master CCF JCP</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?= base_url('leadTimeCcf') ?>">Lead Time</a></li>
                    </ul>
                    <ul class="submenu">
                        <li><a href="<?= base_url('ccf-master-main-material') ?>">Main Material</a></li>
                    </ul>
                    <ul class="submenu">
                        <li><a href="<?= base_url('ccf-master-standard-part') ?>">Standard Part</a></li>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (has_permission(37)): ?>
                <li>
                    <a href="<?= base_url('ccf') ?>" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-copy"></span>
                        <span class="mtext">Form CCF</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (has_permission(37)): ?>
                <li>
                    <a href="<?= base_url('jcp') ?>" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-invoice"></span>
                        <span class="mtext">Form JCP</span>
                    </a>
                </li>
            <?php endif; ?>
            
                <li>
                    <a href="<?= base_url('wps') ?>" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-invoice"></span>
                        <span class="mtext">Form WPS</span>
                    </a>
                </li>
           
            </div>
        </div>
    </div>
    <div class="mobile-menu-overlay"></div>
    <div class="main-container">
        <?= $this->renderSection('content') ?>
    </div>
    <script src="<?= base_url('assets/vendors/scripts/core.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/scripts/script.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/scripts/process.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/scripts/layout-settings.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/js/responsive.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/js/buttons.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/js/buttons.print.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/js/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/js/buttons.flash.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/js/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/js/vfs_fonts.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/scripts/datatable-setting.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/scripts/advanced-components.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('logout-btn').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin ingin melakukan log out?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, log out!',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('logout') ?>";
                }
            });
        });
    </script>
</body>
</html>
