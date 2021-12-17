<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Invoice Pembayaran</title>
		<link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>/uploads/banner/<?= profile() == null ? '' : profile()->favicon; ?>">
		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="<?php base_url() ?>/uploads/banner/<?= profile()->photo; ?>" style="width: 50%; max-width: 50px" />
								</td>

								<td>
		
									Invoice #: <?= $invoice['id']; ?><br />
									Tanggal: <?= $transaksi->created_at; ?><br />
									Berakhir: 
									<?php
										$datetime = new DateTime($transaksi->created_at);
										$datetime->modify('+1 day');
										echo $datetime->format('Y-m-d H:i:s');
									 ?>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									<h3><?= profile()->title; ?><br/></h3>
								</td>

							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<!-- jika Bukan virtual account -->
					<?php if ($details_order[0]->payment_type != 'VIRTUAL_ACCOUNT'): ?>
						<td>Metode Pembayaran</td>
						<td>Kode Pembayaran</td>
					<?php endif ?>
					<!-- end virtual account -->

					<!-- jika Virtual Account  -->
					<?php if ($details_order[0]->payment_type == 'VIRTUAL_ACCOUNT'): ?>
						<td>Virtual Akun</td>
						<td>Nomor VA</td>
					<?php endif ?>
					<!-- end virtual Account -->
				</tr>

				<tr class="details">
					
					<?php if ($details_order[0]->payment_type == 'EWALLET'): ?>
						<td><?= $invoice['channel_code']; ?></td>

						<td><a class="btn btn-primary" target="_blank" href="<?= $invoice['actions']['mobile_deeplink_checkout_url'] == null ? $invoice['actions']['mobile_web_checkout_url'] : $invoice['actions']['mobile_deeplink_checkout_url']   ?>">Bayar Sekarang</a>
						</td>
					<?php endif ?>
					<?php if ($details_order[0]->payment_type == 'RETAIL_OUTLET'): ?>
						<td><?= $invoice['name']; ?></td>
						<td><?= $invoice['payment_code']; ?></td>
					<?php endif ?>

					<?php if ($details_order[0]->payment_type == 'VIRTUAL_ACCOUNT'): ?>
						<td><?= $invoice['bank_code'] ?></td>						
						<td><?= $invoice['account_number'] ?></td>						
					<?php endif ?>
					<?php if ($details_order[0]->payment_type == 'QRIS'): ?>
						<td>QR CODE</td>						
						<td><?= $invoice['qr_string'] ?></td>		
					<?php endif ?>

				</tr>

				<tr class="heading">
					<td>Status Pembayaran</td>
					<td></td>
				</tr>

				<tr class="details">
					<td><?= $details_order[0]->status_pembayaran ?></td>
				</tr>

				<tr class="heading">
					<td>Item</td>

					<td>Harga</td>
				</tr>
				<?php foreach ($details_order as $key => $value): ?>
					<tr class="item">
						<td><?= $value->name; ?></td>

						<td><?= rupiah($value->sell_price); ?></td>
					</tr>
				<?php endforeach ?>
				<hr>


				<tr class="heading">
					<td>Kurir</td>

					<td>Ongkos Kirim</td>
				</tr>
				<tr>
					<td><?= $details_order[0]->kurir?></td>
					<td><?= rupiah($details_order[0]->ongkir) ?></td>
				</tr>
				<hr>
				<tr class="heading">
					<td>Kode Unik</td>

					<td>Total</td>
				</tr>
				
				<tr>
					<td><?= $details_order[0]->kode_unik  ?></td>
					<?php if ($details_order[0]->payment_type == 'EWALLET'): ?>
						<td><?= rupiah($invoice['charge_amount']); ?></td>
					<?php elseif ($details_order[0]->payment_type == 'QRIS'): ?>
						<td><?= rupiah($invoice['amount']) ?></td>
					<?php else: ?>
						<td><?= rupiah($invoice['expected_amount']) ?></td>
					<?php endif ?>
				</tr>
			</table>
		</div>
	</body>
</html>