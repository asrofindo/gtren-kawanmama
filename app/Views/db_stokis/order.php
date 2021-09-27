<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Pesanan Masuk</h2>
    </div>
    <div>
        <form action="<?= base_url()?>/order/stockist" method="post">
        <input type="text" placeholder="cari nomor transaksi" class="form-control" name="id">
        <button hidden type="submit">cari</button>
        </form>
    </div>
</div>
<div class="attention">
    <?php if(!empty(session()->getFlashdata('success'))){ ?>

        <div class="alert alert-success bg-success text-white">
            <?php echo session()->getFlashdata('success');?>
        </div>

    <?php } ?>

    <?php if(!empty(session()->getFlashdata('danger'))){ ?>

        <div class="alert alert-danger bg-danger text-white">
            <?php echo session()->getFlashdata('danger');?>
        </div>

    <?php } ?>
</div>
<div class="card mb-4">
    <header class="card-header">
    </header> <!-- card-header end// -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Pembeli</th>
                        <th scope="col">Status Pembayaran</th>
                        <th scope="col">Total</th>
                        <th scope="col">Resi</th>
                        <th scope="col">Status Barang</th>
                        <th scope="col">Batas Terima Pesanan</th>          
                        <th scope="col">Tanggal</th>          
                        <th scope="col" class="text-end"> Aksi </th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach ($orders as $order): ?>
                        
                        <tr>             
                            <td class="id"><?php echo $order->id; ?></td>
                            <td><b><?php echo $order->fullname; ?></b></td>
                            <td>
                                <?php if($order->status_pembayaran == 'pending'): ?>
                                    <span class="badge rounded-pill alert-warning">Menunggu Pembayaran</span>
                                <?php elseif($order->status_pembayaran == 'paid'): ?>
                                    <span class="badge rounded-pill alert-success">Sudah Dibayar</span>
                                 <?php elseif($order->status_pembayaran == 'cancel'): ?>
                                    <span class="badge rounded-pill alert-danger">di gagalkan</span>
                                <?php endif; ?>
                            </td>

                            <td><?php echo rupiah($order->stockist_commission ); ?></td>
                            <td><?php echo $order->resi; ?></td>
                            
                            <?php $status_barang = explode(',', $order->status_barang); ?>
                            <td>
                                <?php $i = 0;  foreach ($status_barang as $s): ?>
                                    <?php if($s == 'ditolak'): ?>
                                        <span class="badge  rounded-pill alert-warning"><?php echo "tolak"; ?></span>
                                    <?php endif; ?>
                                    <?php if($s == 'refund'): ?>
                                        <span class="badge  rounded-pill alert-warning"><?php echo "refund"; ?></span>
                                    <?php endif; ?>
                                    <?php if($s == 'diterima_seller'): ?>
                                        <span class="badge  rounded-pill alert-primary"><?php echo "dikonfirmasi"; ?></span>
                                    <?php endif; ?>
                                    <?php if($s == 'diterima_pembeli'): ?>
                                        <span class="badge  rounded-pill alert-success"><?php echo "selesai"; ?></span>
                                    <?php endif; ?>
                                    <?php if($s == 'dipantau'): ?>
                                        <span class="badge  rounded-pill alert-warning"><?php echo "dipantau"; ?></span>
                                    <?php endif; ?>
                                <?php endforeach ?>
                            </td>
                            <td><?php echo $order->batas_pesanan; ?></td>
                            <td><?php echo $order->created_at; ?></td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?= base_url() ?>/order/detail/stockist/<?= $order->id; ?>">Detail</a>
                                        <?php if($order->status_barang == 'diterima_seller'): ?>
                                            <a class="dropdown-item btn-acc">Kirim Barang</a>
                                        <?php endif; ?>

                                    </div>
                                </div> <!-- dropdown //end -->
                            </td>                
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div> <!-- table-responsive //end -->
    </div> <!-- card-body end// -->
</div> <!-- card end// -->
<div class="pagination-area mt-30 mb-50">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-start">
            <?= $pager->links('orders', 'product_pagination'); ?>
        </ul>
    </nav>
</div>
<!-- modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Masukan Nomor Resi</h4>
          </div>
          <div class="modal-body">
            <form action="<?php base_url()  ?>/stockist/save/resi" method="post">
                <div class="mb-4">
                    <input type="hidden" id="order_id" name="order_id">
                    <input class="form-control" type="text" name="resi" placeholder="Masukan Nomor Resi">
                    <button class="btn-sm btn-primary" type="submit">Simpan</button>
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
                
            $('#order_id').val(val);

            $('#myModal').modal('show');
        });

         $('.close').on('click',function(data){

            $('#myModal').modal('hide');
        });

         
    });

</script>
<?php $this->endSection() ?>