<?= $this->extend('commerce/templates/index') ?>
<?= $this->section('content') ?>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow">Home</a>
            <span></span> Pages
            <span></span> Login / Register
        </div>
    </div>
</div>
<section class="pt-40 pb-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="row">
                    <div class="col-lg-5">
                    </div>
                    <div class="col-lg-1"></div>
                    
                    <div class="col-lg-6">
                        <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                            <div class="padding_eight_all bg-white">
                                <?= view('Myth\Auth\Views\_message_block') ?>
                                <div class="heading_s1">
                                    <h3 class="mb-30">Daftar Pengguna Baru</h3>
                                </div>
                               <!--  <p class="mb-50 font-sm">
                                    Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy
                                </p> -->

                                <!-- register -->
                                <form action="<?= route_to('register') ?>" method="post">
                                    <?= csrf_field() ?>

                                    <div class="form-group">
                                        <label for="email"><?=lang('Auth.email')?></label>
                                        <input type="email" class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                                               name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
<!--                                         <small id="emailHelp" class="form-text text-muted"><?=lang('Auth.weNeverShare')?></small>
 -->                                    </div>

                                    <div class="form-group">
                                        <label for="username"><?=lang('Auth.username')?></label>
                                        <input type="text" class="form-control <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?=lang('Auth.username')?>" value="<?= old('username') ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="password"><?=lang('Auth.password')?></label>
                                        <input type="password" name="password" class="form-control <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label for="pass_confirm"><?=lang('Auth.repeatPassword')?></label>
                                        <input type="password" name="pass_confirm" class="form-control <?php if(session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off">
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block"><?=lang('Auth.register')?></button>
                                </form>

                                <hr>

                                <p><?=lang('Auth.alreadyRegistered')?> <a href="<?= route_to('login') ?>"><?=lang('Auth.signIn')?></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>