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
                <li>Pasang Link Berikut <a href="" id="url"></a></li>
            </ul>
        </div>
        <br>

</div> <!-- card end// -->


<script>
   $('#url').text(window.location.protocol + '//' + window.location.host + '/cron')
</script>

<?php $this->endSection() ?>