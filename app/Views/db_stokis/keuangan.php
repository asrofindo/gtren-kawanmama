<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Keuangan</h2>
    </div>
    <div>
        <input type="text" placeholder="Search pendapatan ID" class="form-control bg-white">
    </div>
</div>
<div class="row">
    <div class="card mb-4 col-md-6">
        <header class="card-header">
            <div class="row gx-3">
                <div class="col-lg-4 col-md-6 me-auto">
                    <h5>Distributor</h5>
                </div>
            </div>
        </header> <!-- card-header end// -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Masuk</th>
                            <th scope="col">Keluar</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pendapatan_seller as $seller): ?>
                            <tr>
                                <td><?php echo $seller->masuk ?></td>
                                <td><?php echo $seller->keluar ?></td>
                                <td><?php echo $seller->total; ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div> <!-- table-responsive //end -->
        </div> <!-- card-body end// -->
    </div> <!-- card end// -->

     <div class="card mb-4 col-md-6">
        <header class="card-header">
            <div class="row gx-3">
                <div class="col-lg-4 col-md-6 me-auto">
                    <h5>Affiliate</h5>
                </div>
            </div>
        </header> <!-- card-header end// -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Masuk</th>
                            <th scope="col">Keluar</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pendapatan_affiliate as $affiliate): ?> 
                            <tr>
                                <td><?php echo $affiliate->masuk ?></td>
                                <td><?php echo $affiliate->keluar ?></td>
                                <td><?php echo $affiliate->total; ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div> <!-- table-responsive //end -->
        </div> <!-- card-body end// -->
    </div>

    <div class="card mb-4 col-md-12">
        <header class="card-header">
            <div class="row gx-3">
                <div class="col-lg-4 col-md-6 me-auto">
                    <h5>Transaksi</h5>
                </div>
                <div class="col-lg-2 col-6 col-md-3">
                    <select class="form-select">
                        <option>Status</option>
                        <option>Active</option>
                        <option>Disabled</option>
                        <option>Show all</option>
                    </select>
                </div>
            </div>
        </header> <!-- card-header end// -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th scope="col">Harga Jual</th>
                            <th scope="col">Komisi Distributor</th>
                            <th scope="col">Komisi</th>
                            <th scope="col">Affiliate Komisi</th>
                            <th scope="col">Ongkir</th>
                            <th scope="col" class="text-end"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detailtransaksi as $detail): ?>
                            <tr>
                                    <td class="id"><?= $detail['id']; ?></td>
                                    <td><?= intval($detail['stockist_commission']) + intval($detail['admin_commission']) + intval($detail['affiliate_commission']) - intval($detail['ongkir_produk']); ?></td>
                                    <td><?php echo $detail['stockist_commission']; ?></td>
                                    <td><?php echo $detail['admin_commission']; ?></td>
                                    <td><?php echo $detail['affiliate_commission'] ? $detail['affiliate_commission']  : '0' ; ?></td>
                                    <td><?php echo $detail['ongkir_produk']; ?></td>
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item btn-acc">TF Dana</a>
                                            </div>
                                        </div> <!-- dropdown //end -->
                                    </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div> <!-- table-responsive //end -->
        </div> <!-- card-body end// -->
    </div>
</div>


<!-- modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tarik Dana</h4>
          </div>
          <div class="modal-body">
            <form action="<?php base_url()  ?>/transaksi/tarik_dana" method="post">
                <div class="mb-4">
                    <input type="hidden" id="pendapatan_id" name="pendapatan_id">
                    <input class="form-control" type="text" name="wd" placeholder="Masukan Jumlah Dana">
                    <button class="btn-sm btn-primary" type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    $(document).ready(function(){

        $('.btn-acc').on('click',function(data){

                let val = data.target.parentElement.parentElement.parentElement.parentElement.childNodes[1].innerHTML
                $('#pendapatan_id').val(val);

            $('#myModal').modal('show');
        });

         
    });

</script>
<?php $this->endSection() ?>