<?php $this->extend('dashboard') ?>

<?php $this->section('content') ?>
<div class="tab-pane fade active show" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
    <div class="row" style="padding:20px">        
        <div class="card col-lg-6 ">
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
            <div class="card-header">
                <h5>Tambah Alamat Distributor</h5>
            </div>
            <div class="card-body">
                <?php $id = user()->id; ?>
                <?php if(count($address) == 0): ?>
                    <form method="post" action="/distributor">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Provinsi<span class="required">*</span></label>
                                <select required="" class="form-control square" name="provinsi" id="provinsi">
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Kabupaten<span class="required">*</span></label>
                                 <select required="" class="form-control square" name="kabupaten" id="kabupaten">
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Kecamatan<span class="required">*</span></label>
                                 <select required="" class="form-control square" name="kecamatan" id="kecamatan">
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <input id="kode_pos" required="" class="form-control square" name="kode_pos" type="hidden">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Detail Alamat<span class="required">*</span></label>
                                <input required="" class="form-control square" name="detail_alamat" type="text">
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-fill-out submit" name="submit" value="Submit">Save</button>
                            </div>
                        </div>
                    </form>
                <?php else: ?>
                    <form method="post" action="/distributor/<?= $address[0]->id ?>">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Provinsi<span class="required">*</span></label>
                                <select required="" class="form-control square" name="provinsi" id="provinsi">
                                    <option selected value="<?php $address[0]->provinsi ?>" disabled=""><?= $address[0]->provinsi ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Kabupaten<span class="required">*</span></label>
                                <select required="" class="form-control square" name="kabupaten" id="kabupaten">
                                    <option selected value="<?= $address[0]->kabupaten  ?>" disabled=""><?= $address[0]->kabupaten ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Kecamatan<span class="required">*</span></label>
                                <select required="" class="form-control square" name="kecamatan" id="kecamatan">
                                    <option selected value="<?= $address[0]->kecamatan  ?>" disabled=""><?= $address[0]->kecamatan ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <input id="kode_pos" value="<?= $address[0]->kode_pos ?>" required="" class="form-control square" name="kode_pos" type="hidden">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Detail Alamat<span class="required">*</span></label>
                                <input value="<?= $address[0]->detail_alamat ?>" required="" class="form-control square" name="detail_alamat" type="text">
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-fill-out submit" name="submit" value="Submit">Ubah</button>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>    
            </div>
        </div>
        <div class="card col-lg-6">
            <div class="card-header">
                <h5>Tambah Detail TOko</h5>
            </div>
            <div class="card-body">
                 <form method="post" action="<?= base_url() ?>/distributor/detail">
                    <div class="row">
                         <div class="form-group col-md-12">
                            <label>Nama Toko<span class="required">*</span></label>
                            <input id="Nama Toko" value="<?= $toko['locate']  ?>" required="" class="form-control square" name="name" type="text">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-fill-out submit" name="submit" value="Submit">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>       
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">

</script>
<script type="text/javascript">
    $.get( "/province",
        function( data ) {


        $.each(data, function (i, item) {
            $('#provinsi').append($('<option>', { 
                value: [item.provinsi_id, item.provinsi],
                text : item.provinsi
            }));
        });
    });


    $('#provinsi').change(function(data) {
        const val = data.target.value;
        const arr = val.split(',');
        $.get( `/city/${arr[0]}`, function( data ) {

            $('#kabupaten')
            .find('option')
            .remove()
            .end()

            $('#kecamatan')
            .find('option')
            .remove()
            .end()
           
            $.each(data, function (i, item) {
                console.log(item)
                $('#kabupaten')
                .append($('<option>', { 
                    value: [item.id_kota, item.kota, item.kode_pos],
                    text : item.kota,
                }));
            });
        });
    });

    $('#kabupaten').change(function(data) {

        const val = data.target.value;
        const arr = val.split(',');

        $.get( `/subdistrict/${arr[0]}`, function( data ) {
            
            $('#kecamatan')
            .find('option')
            .remove()
            .end()
           
           $('#kode_pos').val(arr[2]);
            $.each(data, function (i, item) {
                console.log(item)
                $('#kecamatan').append($('<option>', { 
                    value: [item.subsdistrict_id, item.subsdistrict_name],
                    text : item.subsdistrict_name 
                }));
            });
        });
    });
</script>

<?php $this->endSection(); ?>
