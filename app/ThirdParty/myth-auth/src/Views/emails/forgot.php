<p>Someone requested a password reset at this email address for <?= site_url() ?>.</p>

<p>Seseorang meminta RESET PASSWORD dengan email ini di website,</p>
<p>Untuk melakukan RESET PASSWORD silakan gunakan KOKDE TOKEN ini:</p>

<p>Kode Token: <?= $hash ?></p>

<p>Klik <a href="<?= base_url('reset-password') . '?token=' . $hash ?>">Halaman Reset Password</a>.</p>

<br>

<p>Jika Anda tidak merasa meminta reset password, hiraukan email ini.</p>
