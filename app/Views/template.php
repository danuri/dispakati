<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">
<head>

    <meta charset="utf-8" />
    <title>DISPAKATI | Kementerian Agama RI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Sistem PAK Integrasi Kementerian Agama RI" name="description" />
    <meta content="Danunih" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/images/favicon.ico">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <!-- Layout config Js -->
    <script src="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <?= $this->renderSection('style') ?>
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="<?= site_url() ?>" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="https://kemenag.go.id/assets/imgs/theme/logo.png" alt="" height="45"> <img src="https://dispakati.bkn.go.id/assets/images/BKN.png" class="img-fluid" style="height: 45px;" alt="">
                        </span>
                    </a>

                    <a href="<?= site_url() ?>" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="https://kemenag.go.id/assets/imgs/theme/logo.png" alt="" height="45">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->

            </div>

            <div class="d-flex align-items-center">

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <?php if(session('isLoggedIn')){ ?>
                <div class="dropdown ms-sm-3 header-item topbar-user">
                  <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-flex align-items-center">
                      <img class="rounded-circle header-profile-user" src="https://ropeg.kemenag.go.id/logo_kemenag.png" alt="Header Avatar">
                      <span class="text-start ms-xl-2">
                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?= session('nama')?></span>
                        <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text"><?= session('jabatan')?></span>
                      </span>
                    </span>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="<?= site_url('logout') ?>"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                  </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
</header>

        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="<?= site_url() ?>" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/images/logo-hrms.png" alt="" height="45">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="<?= site_url() ?>" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/images/logo-hrms.png" alt="" height="45">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>



            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <?= $this->renderSection('content') ?>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © DISPAKATI GATEWAY.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                by Biro Kepegawaian
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Theme Settings -->

    <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

    <!-- JAVASCRIPT -->
    <script src="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/libs/node-waves/waves.min.js"></script>
    <script src="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/libs/feather-icons/feather.min.js"></script>
    <script src="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/js/plugins.js"></script>

    <!-- App js -->
    <script src="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/js/app.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script src="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/js/pages/password-addon.init.js"></script>
    <script src="<?= base_url('assets/js/jquery.number.min.js')?>"></script>

    <script type="text/javascript">
    $('.datatable').dataTable();

    function alert($text) {
        Toastify({
        text: $text,
        duration: 5000,
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
        },
        onClick: function(){} // Callback after click
        }).showToast();
    }

    <?php
    if(session()->getFlashdata('message')){
        ?>
        alert("<?= session()->getFlashdata('message')?>");
        <?php
    }
    ?>
    </script>
    <?= $this->renderSection('script') ?>
</body>

</html>
