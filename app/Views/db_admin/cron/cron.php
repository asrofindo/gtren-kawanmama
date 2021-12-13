<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title"> Konfigurasi Cron Job</h2>
    </div>
</div>
<div class="card mb-4 p-3">
        <div class="row m-4">
            <ul>
                <li>Anda Harus Registrasi Terlebih Dahulu ke Link Berikut <a href="https://console.cron-job.org/login">Cron Job</a></li>
            </ul>

            <p>Terdapat dua Jenis Cron job</p>
            <ul>
                <li><a href="" id="url"></a>, digunakan ketika ada transaksi yang belum selesai di karenakan pembeli belum menyatakan menerima barang setelah 10 hari sejak barang dikirim, cron tersebut akan merubah status dari transaksi delivered tersebut menjadi sedang di pantau oleh admin</li>

                <li><a href="" id="urls"></a>, digunakan ketika ada transaksi yang belum diterima oleh seller sejak pesanan disetujui oleh admin, cron tersebut akan merubah status yang sebelumnya pending menjadi ditolak</li>
            </ul>
        </div>
        <br>

</div> <!-- card end// -->


<script>
   $('#url').text(window.location.protocol + '//' + window.location.host + '/cron')
   $('#urls').text(window.location.protocol + '//' + window.location.host + '/wacron')
</script>

<?php $this->endSection() ?>