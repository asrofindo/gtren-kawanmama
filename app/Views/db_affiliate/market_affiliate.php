<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
    <div class="row">
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-qr_code"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Link Affiliate</h6> 
                        <span><?= user()->affiliate_link ;?></span>

                    </div>
                </article>
            </div>
        </div>
    </div>
<?php $this->endSection() ?>