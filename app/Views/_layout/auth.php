<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.118.2" />
    <title><?php echo $title ?? "Title" ?></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/" />
    <?= csrf_meta() ?>

    <link href="<?php echo base_url('vendors/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url('vendors/fontawesome/css/all.min.css') ?>" />
    <link rel="stylesheet" href="<?php echo base_url('vendors/sweetalert2/sweetalert2.min.css') ?>">

    <?= $this->renderSection('style_1') ?>
</head>

<body>
    <main>
        <?= $this->renderSection('content') ?>

    </main>
    <script src="<?php echo base_url('vendors/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?php echo base_url('vendors/jquery/jquery-3.7.1.min.js') ?>"></script>
    <script src="<?php echo base_url('vendors/fontawesome/js/all.min.js') ?>"></script>
    <script src="<?php echo base_url('vendors/sweetalert2/sweetalert2.all.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/js/alert.js') ?>"></script>
    <script src="<?php echo base_url('/assets/js/main.js') ?>"></script>

    <?= $this->renderSection('script_1') ?>
</body>

</html>