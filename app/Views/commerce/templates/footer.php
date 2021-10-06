<footer class="main d-none d-xl-block d-md-block d-lg-block">
    <section class="section-padding-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="widget-about font-md mb-md-5">
                        <!-- <div class="logo logo-width-1 wow fadeIn animated">
                            <a href="index.html" class="w-25"><img src="<?= base_url() ?>/frontend/imgs/theme/gtren.png" alt="logo"></a>
                        </div> -->
                        <h4 class="mb-10 mt-20 fw-600 text-grey-4 wow fadeIn animated">Sosial Media</h4>
                        <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                            <?php foreach ($sosial as $key => $value) {?>
                                <a class="<?php
                                    if ($value->name=='youtube') {
                                        echo 'instagram';
                                    }else{
                                       echo $value->name ;
                                    }
                                    ?>" href="<?= $value->link?>"><i class="fab fa-<?= $value->name?>"></i></a>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 d-none d-sm-block">
                    <h5 class="widget-title mb-30 wow fadeIn animated">Transaksi</h5>
                    <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                        <li><a href="<?= base_url()?>/orders">Pesanan</a></li>
                        <li><a href="<?= base_url()?>/tracking">Cek Pesanan</a></li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-3 d-none d-sm-block">
                    <h5 class="widget-title mb-30 wow fadeIn animated">Dashboard</h5>
                    <ul class="footer-list wow fadeIn animated">
                        <?php if (user()==null) {?>
                            <li><a href="<?php base_url() ?>/login">Login</a></li>
                            <li><a href="<?php base_url() ?>/register">Register</a></li>
                        <?php }else{ ?>
                            <li><a href="<?php base_url() ?>/account">Profile</a></li>
                            <?php if (in_groups(1)) {?>
                                <li><a href="<?php base_url() ?>/admin">Dashboard</a></li>
                            <?php }?>
                            <?php if (in_groups(3)) {?>
                                <li><a href="<?php base_url() ?>/seller">Toko Anda</a></li>
                            <?php }?>
                     
                        <?php } ?>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="widget-title mb-30 wow fadeIn animated">Unduh Aplikasi</h5>
                    <div class="row">
                        <div class="col-md-8 col-lg-12">
                            <a href="https://play.google.com/store/apps/details?id=com.gtrenid"><p class="wow fadeIn animated">From App Store or Google Play</p></a>
                            <!-- <div class="download-app wow fadeIn animated">
                                <a href="#" class="hover-up mb-sm-4"><img src="<?= base_url() ?>/frontend/imgs/theme/app-store.jpg" alt=""></a>
                                <a href="#" class="hover-up"><img src="<?= base_url() ?>/frontend/imgs/theme/google-play.jpg" alt=""></a>
                            </div> -->
                        </div>
                       <!--  <div class="col-md-4 col-lg-12">
                            <p class="mb-20 wow fadeIn animated mt-md-3">Secured Payment Gateways</p>
                            <img class="wow fadeIn animated" src="<?= base_url() ?>/frontend/imgs/theme/payment-method.png" alt="">
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container pb-20 wow fadeIn animated d-none d-sm-block">
        <div class="row">
            <div class="col-12 mb-20">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-lg-6">
                <p class="float-md-left font-sm text-muted mb-0">&copy; 2021, <strong class="text-brand"> KDN</strong> </p>
            </div>
            <div class="col-lg-6">
                <p class="text-lg-end text-start font-sm text-muted mb-0">
                    All rights reserved
                </p>
            </div>
        </div>
    </div>
</footer>