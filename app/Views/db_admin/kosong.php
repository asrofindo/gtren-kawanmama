<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Hancurkan Data</h2>
    </div>
</div>
<div class="card mb-4 p-3">
        <div class="row m-4">
            <h5> Peringatan!!</h5>
            <p> Data akan di hancurkan secara permanen ,dimohon setelah menghancurkan data untuk mengisi lagi data-data yang penting</p>

        </div>
        <br>
        <div class="w-100 ">
            <a href="<?php base_url() ?>/empty" class="btn btn-danger w-100"  onclick="return confirm('Kamu Yakin ?')">
               Klik Hancurkan Transaksi
            </a>
        </div>

</div> <!-- card end// -->

<?php $this->endSection() ?>