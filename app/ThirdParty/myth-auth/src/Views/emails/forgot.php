<p>Seseorang meminta RESET PASSWORD dengan email ini di website <a href="<?=base_url()?>"><?=base_url()?></a></p>
<p>Untuk melakukan RESET PASSWORD silakan gunakan KODE TOKEN ini:</p>

<p>Kode Token: <?= $hash ?></p>

<p>Klik <a href="<?= base_url('reset-password') . '?token=' . $hash ?>">Halaman Reset Password</a>.</p>

<br>

<p>Jika Anda tidak merasa meminta reset password, hiraukan email ini.</p>
