<html lang="en">
<head>
  <title>Data Iklan : initekno.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
 
<div class="container">
  <br>
  <div class="panel panel-danger">
    <div class="panel-heading">
        <table border="1" style="width:100%; border-collapse: collapse; ">
          <tr>
            <th>Penerima</th>
            <th>Pengirim</th>
            <th>Info</th>
          </tr>
          <tr style="text-align:center;">
            <?php foreach($detail_orders as $order): ?>
              <td>
                <p class="mb-1">
                   <?= $order['fullname'] ?> <br> <?= $order['email'] ?> <br> <?= $order['phone'] ?>
                </p>
                <p class="mb-1">
                      <?php $alamat = explode(',', $order['alamat']); ?>
                      <?php echo $alamat[4]; ?> <br>
                      <?php echo $alamat[2]; ?> <br>
                      <?php echo $alamat[1]; ?> <br>
                      <?php echo $alamat[0]; ?> <br>
                  </p>
              </td>
              <td>
                <p class="mb-1">
                  <?php echo user()->fullname ?> <br>
                  <?php echo user()->email ?> <br>
                  <?php echo user()->phone ?> <br>
                </p>
                <p class="mb-1">
                  <?php echo $address->detail_alamat; ?> <br>
                  <?php echo $address->kecamatan; ?> <br>
                  <?php echo $address->kabupaten; ?> <br>
                  <?php echo $address->provinsi; ?> <br>
                </p>
              </td>
              <td>
                 <p class="mb-1">
                     No. <?= $order['id'] ?><?=  $order['kode_unik'] ?> <br> <?= $order['kurir'] ?> <br>
                  </p>
              </td>
            
            <?php endforeach; ?>
          </tr>
        </table>
        <table class="table" border="1" style="width:100%; border-collapse: collapse; margin-top: 20px">
          <thead>
              <tr>
                  <th width="20%">Nama Barang</th>
                  <th width="20%" class="text-end">Jumlah</th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($detail_orders as $order):?>
                  <?php foreach ($order['products'] as $product): ?>
                      <tr style="text-align: center;">
                        <td>
                            <div><?= $product->name;  ?></div>
                        </td>
                        <td> <?= $product->amount; ?> </td>
                      </tr>
                  <?php endforeach; ?>
              <?php endforeach; ?>
          </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>