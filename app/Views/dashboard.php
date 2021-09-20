<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <?php if(in_groups(1)) {?>
        <title>Gtren dashboard Admin</title>
    <?php }elseif(in_groups(3)) {?>
        <title>Gtren dashboard Seller</title>
    <?php }elseif(in_groups(4)) {?>
        <title>Gtren dashboard Affiliate</title>
    <?php }?>

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>/backend/imgs/theme/favico.svg">

    <link href="<?= base_url() ?>/backend/css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="screen-overlay"></div>
    <aside class="navbar-aside" id="offcanvas_aside">
        <div class="aside-top">
            <a href="<?= base_url() ?>/dashboard" class="brand-wrap">
            <a href="<?= base_url() ?>"><img class="w-25" src="<?= base_url() ?>/frontend/imgs/theme/gtren-t.png" alt="logo"></a>
            </a>
            <div>
                <button class="btn btn-icon btn-aside-minimize"> <i class="text-muted material-icons md-menu_open"></i> </button>
            </div>
        </div>
        <nav>
           <ul class="menu-aside">
    <?php if(in_groups(1)) {?>
        <li class="menu-item">
            <a class="menu-link" href="<?= base_url() ?>/admin"> <i class="icon material-icons md-home"></i>
                <span class="text">Dashboard Admin</span>
            </a>
        </li>
        <li class="menu-item has-submenu" >
            <a class="menu-link" href="page-products-list.html"> <i class="icon material-icons md-shopping_bag"></i>
                <span class="text">Produk</span>
            </a>
            <div class="submenu">
                <a href="<?= base_url()?>/products">Daftar Produk</a>
                <a href="<?= base_url()?>/category">Kategori</a>
            </div>
        </li>
        <li class="menu-item has-submenu">
            <a class="menu-link" href="page-orders-1.html"> <i class="icon material-icons md-shopping_cart"></i>
                <span class="text">Pesanan</span>
            </a>
            <div class="submenu">
                <a href="<?= base_url() ?>/order">Data Pesanan</a>
                <a class="" href="<?php base_url() ?>/upgrades">Upgrade Akun</span></a>
            </div>
        </li>
        <li class="menu-item has-submenu">
            <a class="menu-link" href="page-orders-1.html"> <i class="icon material-icons md-monetization_on"></i>
                <span class="text">Keuangan</span>

            </a>
            <div class="submenu">
                    <a href="<?php base_url() ?>/bills"><span class="text">Rekening Admin</span></a> 
                    <a href="<?php base_url() ?>/riwayat/wd"><span class="text">Riwayat Withdraw</span></a>
                    <a href="<?php base_url() ?>/hutang/affiliate"><span class="text">Dana Affiliate</span></a> 
                    <a href="<?php base_url() ?>/hutang/stockist"><span class="text">Dana Distributor</span></a> 
                    <a href="<?php base_url() ?>/admin/konfirmasi"><span class="text">Konfirmasi Pembayaran</span></a> 
            </div>
        </li>
        <li class="menu-item has-submenu">
            <a class="menu-link" href="page-orders-1.html"> <i class="icon material-icons md-people"></i>
                <span class="text">Data Member</span>
            </a>
            <div class="submenu">
                    <a href="<?php base_url() ?>/members"><span class="text">Semua Pengguna</span></a> 
                    <a href="<?php base_url() ?>/distributor/list"><span class="text">Distributor</span></a>
                    <a href="<?php base_url() ?>/affiliate/list"><span class="text">Affiliate</span></a>
            </div>
        </li>
    <?php }elseif(in_groups(3)) {?>
        <li class="menu-item">
            <a class="menu-link" href="<?= base_url() ?>/seller"> <i class="icon material-icons md-home"></i>
                <span class="text">Dashboard Seller</span>
            </a>
        </li>  
        <li class="menu-item">
            <a class="menu-link" href="<?= base_url() ?>/order/stockist"> <i class="icon material-icons md-shopping_cart"></i>
                <span class="text">Pesanan</span>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="<?= base_url() ?>/affiliate"> <i class="icon material-icons md-home"></i>
                <span class="text">Dashboard Affiliate</span>
            </a>
        </li>  
        <li class="menu-item">
            <a class="menu-link" href="<?= base_url() ?>/market/affiliate"> <i class="icon material-icons md-assignment"></i>
                <span class="text">Market Affiliate</span>
            </a>
        </li>
        <li class="menu-item has-submenu" >
            <a class="menu-link" href="page-products-list.html"> <i class="icon material-icons md-shopping_bag"></i>
                <span class="text">Stok</span>
            </a>
            <div class="submenu">
                <a href="<?= base_url() ?>/products/stockist">Produk Anda</a>
                <a href="<?= base_url() ?>/products">Produk</a>
            </div>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="<?= base_url() ?>/jaringan"> <i class="icon material-icons md-public"></i>
                <span class="text">Jaringan Anda</span>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="<?= base_url() ?>/market/affiliate"> <i class="icon material-icons md-assignment"></i>
                <span class="text">Affiliate Tools</span>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="<?php base_url() ?>/keuangan"> <i class="icon material-icons md-monetization_on"></i>
                <span class="text">Keuangan</span>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="<?php base_url() ?>/request/wd"> <i class="icon material-icons md-account_balance_wallet"></i>
                <span class="text">Penarikan Dana</span>
            </a>
        </li>
        <li class="menu-item" >
            <a class="menu-link" href="<?php base_url() ?>/distributor"> <i class="icon material-icons md-store"></i>
                <span class="text">Setting Distributor</span>
            </a>
        </li>
    <?php }elseif(in_groups(4)) {?>
        <li class="menu-item">
            <a class="menu-link" href="<?= base_url() ?>/affiliate"> <i class="icon material-icons md-home"></i>
                <span class="text">Dashboard Affiliate</span>
            </a>
        </li>
        
        <li class="menu-item">
            <a class="menu-link" href="<?= base_url() ?>/market/affiliate"> <i class="icon material-icons md-assignment"></i>
                <span class="text">Market Affiliate</span>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="<?= base_url() ?>/jaringan"> <i class="icon material-icons md-public"></i>
                <span class="text">Jaringan Anda</span>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="<?= base_url() ?>/market/affiliate"> <i class="icon material-icons md-assignment"></i>
                <span class="text">Affiliate Tools</span>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="<?php base_url() ?>/keuangan"> <i class="icon material-icons md-monetization_on"></i>
                <span class="text">Keuangan</span>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="<?php base_url() ?>/request/wd"> <i class="icon material-icons md-account_balance_wallet"></i>
                <span class="text">Penarikan Dana</span>
            </a>
        </li>
    <?php }?>





  










</ul>
<hr>

<ul class="menu-aside">
    <?php if(in_groups(1)){?>
    <li class="menu-item has-submenu">
        <a class="menu-link" href="page-products-list.html"> <i class="icon material-icons md-settings"></i>
            <span class="text">Setting</span>
        </a>
        <div class="submenu">
            <a href="<?= base_url() ?>/notifikasi">notifikasi</a> 
            <a href="<?= base_url() ?>/setting/api/get">Setting Api</a> 
            <a href="<?= base_url() ?>/sosial">sosial media</a>  
            <a href="<?php base_url() ?>/empty"  onclick="return confirm('Kamu Yakin ?')">
                <span class="text">Hancurkan Transaksi</span>
            </a>
    
        </div>
    </li>
    <?php }if(in_groups(3)){ ?>
    <li class="menu-item" >
            <a class="menu-link" href="<?php base_url() ?>/distributor"> <i class="icon material-icons md-settings"></i>
                <span class="text">Setting Distributor</span>
            </a>
    </li>
    <?php } ?>

</ul>
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

            <?php if(isset($segments) && $segments[0] == 'admin'): ?>
            <div class="row">
                <?php if(in_groups(1)): ?>
                    <div class="col-lg-3">
                        <div class="card card-body mb-4">
                            <article class="icontext">
                                <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-primary material-icons md-monetization_on"></i></span>
                                <div class="text">
                                    <h6 class="mb-1 card-title">Dana User</h6>
                                    <span><?= rupiah($user[0]->user_total); ;?></span>
                                   <!--  <span class="text-sm">
                                        Shipping fees are not included
                                    </span> -->
                                </div>
                            </article>
                        </div>
                    </div>
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-success material-icons md-local_shipping"></i></span>
                            <div class="text">
                                <h6 class="mb-1 card-title">Dana Seller</h6> 
                                <span><?= rupiah($stockist[0]->stockist_total) ;?></span>
                                <!-- <span class="text-sm">
                                    Excluding orders in transit
                                </span> -->
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-qr_code"></i></span>
                            <div class="text">
                                <h6 class="mb-1 card-title">Dana Affiliate</h6> 
                                <span><?= rupiah($affiliate[0]->affiliate_total) ;?></span>
                            <!--     <span class="text-sm">
                                    In 19 Categories
                                </span> -->
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-shopping_basket"></i></span>
                            <div class="text">
                                <h6 class="mb-1 card-title">Dana Admin</h6>
                                <span><?= rupiah($admin[0]['admin_total']) ;?></span>
                               <!--  <span class="text-sm">
                                    Based in your local time.
                                </span> -->
                            </div>
                        </article>
                    </div>
                </div>
                <!-- Table -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-stripped">
                                            <thead>
                                                <tr>
                                                    <th>Nama Bank</th>
                                                    <th>Nomor Rekening</th>
                                                    <th>Nama Pemilik</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($bills as $bill):  ?>
                                                    <tr>
                                                        <td><?= $bill->bank_name ?></td>
                                                        <td><?= $bill->bank_number ?></td>
                                                        <td><?= $bill->owner ?></td>
                                                        <td><?= rupiah($bill->total)   ?></td>
                                                    </tr>
                                                <?php endforeach;  ?>
                                            </tbody>  
                                        </table>
                                    </div>
                                </div> <!-- .col// -->
                            </div> <!-- .row // -->
                        </div> <!-- card body .// -->
                        <div class="pagination-area mt-30 mb-50">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                    <?= $pager->links('bills', 'product_pagination'); ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif ?>

            <?php if(isset($segments) && $segments[0] == 'seller'): ?>
            <div class="row">
                <?php if(in_groups(1)): ?>
                    <div class="col-lg-3">
                        <div class="card card-body mb-4">
                            <article class="icontext">
                                <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-primary material-icons md-monetization_on"></i></span>
                                <div class="text">
                                    <h6 class="mb-1 card-title">Dana User</h6>
                                    <span><?= rupiah($user[0]->user_total);?></span>
                                   <!--  <span class="text-sm">
                                        Shipping fees are not included
                                    </span> -->
                                </div>
                            </article>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-success material-icons md-local_shipping"></i></span>
                            <div class="text">
                                <h6 class="mb-1 card-title">Dana Pending</h6> 
                            <span><?= rupiah($pending_stockist[0]->pending_stockist_total) ;?></span>
                                <!-- <span class="text-sm">
                                    Excluding orders in transit
                                </span> -->
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-success material-icons md-local_shipping"></i></span>
                            <div class="text">
                                <h6 class="mb-1 card-title">Dana Seller</h6> 
                                <span><?= rupiah($stockist[0]->stockist_total) ;?></span>
                                <!-- <span class="text-sm">
                                    Excluding orders in transit
                                </span> -->
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-qr_code"></i></span>
                            <div class="text">
                                <h6 class="mb-1 card-title">Dana Affiliate</h6> 
                                <span><?= rupiah($affiliate[0]->affiliate_total) ;?></span>
                            <!--     <span class="text-sm">
                                    In 19 Categories
                                </span> -->
                            </div>
                        </article>
                    </div>
                </div>
                <?php if(in_groups(1)): ?>
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-shopping_basket"></i></span>
                            <div class="text">
                                <h6 class="mb-1 card-title">Dana Admin</h6>
                                <span><?= rupiah($admin[0]['admin_total']) ;?></span>
                               <!--  <span class="text-sm">
                                    Based in your local time.
                                </span> -->
                            </div>
                        </article>
                    </div>
                </div>
                <?php endif; ?>
                <!-- Table -->
                <?php if(in_groups(1)): ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-stripped">
                                            <thead>
                                                <tr>
                                                    <th>Nama Bank</th>
                                                    <th>Nomor Rekening</th>
                                                    <th>Nama Pemilik</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($bills as $bill):  ?>
                                                    <tr>
                                                        <td><?= $bill->bank_name ?></td>
                                                        <td><?= $bill->bank_number ?></td>
                                                        <td><?= $bill->owner ?></td>
                                                        <td><?= rupiah($bill->total); ?></td>
                                                    </tr>
                                                <?php endforeach;  ?>
                                            </tbody>  
                                        </table>
                                    </div>
                                </div> <!-- .col// -->
                            </div> <!-- .row // -->
                        </div> <!-- card body .// -->
                        <div class="pagination-area mt-30 mb-50">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                    <?= $pager->links('bills', 'product_pagination'); ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif ?>

              <?php if(isset($segments) && $segments[0] == 'affiliate'): ?>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-qr_code"></i></span>
                            <div class="text">
                                <h6 class="mb-1 card-title">Dana Pending</h6> 
                                <span><?= rupiah($pending_affiliate[0]->pending_affiliate_total) ;?></span>
                            <!--     <span class="text-sm">
                                    In 19 Categories
                                </span> -->
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-qr_code"></i></span>
                            <div class="text">
                                <h6 class="mb-1 card-title">Dana Affiliate</h6> 
                                <span><?= rupiah($affiliate[0]->affiliate_total) ;?></span>
                            <!--     <span class="text-sm">
                                    In 19 Categories
                                </span> -->
                            </div>
                        </article>
                    </div>
                </div>
            </div>
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