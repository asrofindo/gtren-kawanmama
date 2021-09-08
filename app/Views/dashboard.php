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
            <a href="<?= base_url() ?>/dashboard" class="brand-wrap">
                <img src="<?= base_url() ?>/backend/imgs/theme/logo2.png" class="logo" alt="Wowy Dashboard">
            </a>
            <div>
                <button class="btn btn-icon btn-aside-minimize"> <i class="text-muted material-icons md-menu_open"></i> </button>
            </div>
        </div>
        <nav>
           <ul class="menu-aside">
    <li class="menu-item active">
        <a class="menu-link" href="<?= base_url() ?>/dashboard"> <i class="icon material-icons md-home"></i>
            <span class="text">Dashboard</span>
        </a>
    </li>

    <?php if(in_groups(1)): ?>
    <li class="menu-item has-submenu" >
        <a class="menu-link" href="page-products-list.html"> <i class="icon material-icons md-shopping_bag"></i>
            <span class="text">Produk</span>
        </a>
        <div class="submenu">
            <a href="<?= base_url() ?>/products">Daftar Produk</a>
            <a href="<?= base_url() ?>/category">Kategori</a>
        </div>
    </li>
    <?php endif ?>

    <?php if(in_groups(1)):?>
    <li class="menu-item has-submenu">
        <a class="menu-link" href="page-orders-1.html"> <i class="icon material-icons md-shopping_cart"></i>
            <span class="text">Pesanan</span>
        </a>
        <div class="submenu">
            <a href="<?= base_url() ?>/order">Data Pesanan</a>
        </div>
    </li>
    <?php endif; ?>

    <?php if( in_groups(3)): ?>
    <li class="menu-item has-submenu">
        <a class="menu-link" href="page-orders-1.html"> <i class="icon material-icons md-shopping_cart"></i>
            <span class="text">Orders</span>
        </a>
        <div class="submenu">
            <a href="<?= base_url() ?>/order/stockist">Order Stockist</a>
        </div>
    </li>
    <?php endif; ?>

    <?php if(in_groups(1)): ?>
    <li class="menu-item">
        <a class="menu-link" href="<?php base_url() ?>/members"> <i class="icon material-icons md-store"></i>
            <span class="text">Data Pengguna</span>
        </a>
    </li>
    <?php endif; ?>
    
    <?php if(in_groups(1)): ?>
    <li class="menu-item">
        <a class="menu-link" href="<?php base_url() ?>/upgrades"> <i class="icon material-icons md-people"></i>
            <span class="text">Upgrade Akun</span>
        </a>
    </li>
    <?php endif; ?>

    <?php if(in_groups(1)): ?>
    <li class="menu-item">
        <a class="menu-link" href="<?php base_url() ?>/bills"> <i class="icon material-icons md-monetization_on"></i>
            <span class="text">Rekening Admin</span>
        </a>
    </li>
    <?php endif; ?>

    <?php if(in_groups(3) && !in_groups(1)): ?>
    <li class="menu-item has-submenu" >
        <a class="menu-link" href="page-products-list.html"> <i class="icon material-icons md-shopping_bag"></i>
            <span class="text">Stok</span>
        </a>
        <div class="submenu">
            <a href="<?= base_url() ?>/products/stockist">Produk Anda</a>
            <a href="<?= base_url() ?>/products">Produk</a>
        </div>
    </li>
    <li class="menu-item" >
        <a class="menu-link" href="<?php base_url() ?>/distributor"> <i class="icon material-icons md-store"></i>
            <span class="text">Setting Toko</span>
        </a>
    </li>
    <?php endif ?>

</ul>
<hr>
<?php if(in_groups(1)): ?>
<ul class="menu-aside">
    <li class="menu-item has-submenu">
        <a class="menu-link" href="page-products-list.html"> <i class="icon material-icons md-settings"></i>
            <span class="text">Setting</span>
        </a>
        <div class="submenu">
            <a href="<?= base_url() ?>/offer">offer</a>
            <a href="<?= base_url() ?>/banner">banner</a>
            <a href="<?= base_url() ?>/office">contact</a>
        </div>
    </li>
</ul>
<?php endif; ?>
<br>
<br>
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