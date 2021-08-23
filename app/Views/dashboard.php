<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Gtren DasboardWowy Dashboard</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>/backend/imgs/theme/favico.svg">
    <!-- Template CSS -->
    <link href="<?= base_url() ?>/backend/css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="screen-overlay"></div>
    <aside class="navbar-aside" id="offcanvas_aside">
        <div class="aside-top">
            <a href="index.html" class="brand-wrap">
                <img src="<?= base_url() ?>/backend/imgs/theme/logo2.png" class="logo" alt="Wowy Dashboard">
            </a>
            <div>
                <button class="btn btn-icon btn-aside-minimize"> <i class="text-muted material-icons md-menu_open"></i> </button>
            </div>
        </div>
        <nav>
            <?php if(in_groups(1)): ?>    
                <?= $this->include('db_admin/sidebar_admin') ?>
            <?php elseif(in_groups(3)): ?>    
                <?= $this->include('db_admin/sidebar_stokis') ?>

            <?php endif; ?>
        </nav>
    </aside>
    <main class="main-wrap">
        <!-- header -->
        <?= $this->include('db_components/header') ?>
        <!-- header -->
        <section class="content-main">
            <?= $this->renderSection('content') ?>
            <?php if(isset($segments)): ?>
                <?php echo 'this dashboard' ?>
            <?php endif ?>
        </section> <!-- content-main end// -->
        <?= $this->include('db_components/footer') ?>
    </main>
    <script src="<?= base_url() ?>/backend/js/vendors/jquery-3.5.1.min.js"></script>
    <script src="<?= base_url() ?>/backend/js/vendors/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/backend/js/vendors/select2.min.js"></script>
    <script src="<?= base_url() ?>/backend/js/vendors/perfect-scrollbar.js"></script>
    <script src="<?= base_url() ?>/backend/js/vendors/jquery.fullscreen.min.js"></script>
    <script src="<?= base_url() ?>/backend/js/vendors/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Main Script -->
    <script src="<?= base_url() ?>/backend/js/main.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>/backend/js/custom-chart.js" type="text/javascript"></script>
</body>

</html>