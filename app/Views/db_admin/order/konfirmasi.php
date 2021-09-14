<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Konfirmasi Pembayaran </h2>
    </div>
</div>
<div class="card mb-4">
    <header class="card-header">
        <div class="row gx-3">
            <div class="col-lg-4 col-md-12 me-auto">
                <form method="post" action="<?php base_url() ?>/order/search">                    
                    <input type="text" placeholder="Cari Nama" name="keyword" class="form-control">
                    <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                </form>
            </div>
            <div class="col-lg-2 col-6 col-md-3">
                <form  method="post" action="<?php base_url() ?>/order/search">
                    <select name="status" class="form-select">
                        <option disabled>Status</option>
                        <option value="paid">Sudah Bayar</option>
                        <option value="pending" >Belum Bayar</option>
                    </select>
                    <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                </form>
            </div>
        </div>
    </header> <!-- card-header end// -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status Pembayaran</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Batas Pesanan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col" class="text-end"> Aksi </th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td><?= $transaksi->id; ?></td>
                            <td><b><?php echo $transaksi->created_at; ?></b></td>
                            <td><?php echo $transaksi->total ?></td>
      
                   
                            <td class="text-end">
                                <!-- dropdown //end -->
                            </td>
                        </tr>
                </tbody>
            </table>
        </div> <!-- table-responsive //end -->
    </div> <!-- card-body end// -->
</div> <!-- card end// -->

<?php $this->endSection() ?>