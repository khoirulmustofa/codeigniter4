<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title><?= $title ?></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">
    <!-- <link rel="apple-touch-icon" href="/docs/5.3/base_urls/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.3/base_urls/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.3/base_urls/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.3/base_urls/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.3/base_urls/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.3/base_urls/img/favicons/favicon.ico"> -->
    <meta name="theme-color" content="#712cf9">
    <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">

    <script>
        var app_name = '<?= APP_NAME ?>';

        function get_scrf() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }

        function set_csrf(token) {
            document.querySelector('meta[name="csrf-token"]').setAttribute('content', token);
        }
    </script>

    <link href="<?= base_url('vendors/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('vendors/fontawesome/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/sweetalert2/sweetalert2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/pace/flash.css') ?>">
    <style>
        .table-hover tbody tr:hover td,
        .table-hover tbody tr:hover th {
            background-color: #8080ff;
            color: #fff;
        }
    </style>

    <?= $this->renderSection('style_1') ?>

</head>

<body class="small">


    <header class="py-1 border-bottom fixed-top bg-light">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none text-nowrap">
                    <img src="<?= base_url('assets/img/logo_school.png') ?>" class="img-fluid" style="max-height: 50px;" alt="logo"> <?= APP_NAME ?>
                </a>
                <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                        <button onclick="btn_menu()" class="btn btn-primary btn-sm me-2"><i class="fa-solid fa-bars"></i> Menu</button>
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?= base_url('assets/img/user.png') ?>" alt="" width="35" height="35" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                <div class="message-body">
                                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item mb-1">
                                        <i class="fa-regular fa-circle-user"></i>
                                        <p class="mb-0"><?= auth()->user()?->name ?></p>
                                    </a>
                                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item mb-1">
                                        <i class="fa-solid fa-user-ninja"></i>
                                        <p class="mb-0">Back to user</p>
                                    </a>
                                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item mb-1">
                                        <i class="fa-regular fa-calendar-days"></i>
                                        <p class="mb-0">Academic Year</p>
                                    </a>
                                    <a href="<?= base_url('logout') ?>" class="btn btn-danger btn-sm mx-3 mt-2 d-block"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>


            </div>
        </div>
    </header>

    <main class="container-fluid">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="container-fluid d-flex bg-secondary-subtle flex-wrap justify-content-between align-items-center py-1 border-top">
        <div class="d-flex align-items-center">
            <a href="#" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                <i class="fa-solid fa-globe"></i>
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary">&copy; <?= date('Y') ?> <?= config('app.name') ?></span>
        </div>

        <ul class="nav justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-body-secondary" href="#"><i class="fa-brands fa-instagram"></i></a></li>
        </ul>
    </footer>

    <div class="modal fade" id="modal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        </div>
    </div>

    <div class="modal fade" id="modal_2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        </div>
    </div>


    <script src="<?= base_url('vendors/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('vendors/jquery/jquery-3.7.1.min.js') ?>"></script>
    <script src="<?= base_url('vendors/fontawesome/js/all.min.js') ?>"></script>
    <script src="<?= base_url('vendors/sweetalert2/sweetalert2.all.min.js') ?>"></script>
    <script src="<?= base_url('vendors/pace/pace.min.js') ?>"></script>
    <script src="<?= base_url('base_urls/js/alert.js') ?>"></script>
    <script src="<?= base_url('base_urls/js/main.js') ?>"></script>
    <?= $this->renderSection('script_1') ?>

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const headerHeight = document.querySelector('header').offsetHeight;
            document.body.style.paddingTop = headerHeight + 'px';
        });

        function btn_menu() {
            show_modal("modal_1", "modal-xl");
        }
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
</body>

</html>