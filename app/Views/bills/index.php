<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Bills</title>
  </head>
  <body>

    <div class="container mt-5">
    	<h1>List Bills</h1>

    	<?php if(!empty(session()->getFlashdata('success'))){ ?>

    	    <div class="alert alert-success bg-success text-white">
    	        <?php echo session()->getFlashdata('success');?>
    	    </div>

    	<?php } ?>


    	<?php if (isset($bill)): ?>
    		<form method="POST" action="<?= base_url('bill/update/'.$bill->id) ?>" class="my-3">
    			<div class="form-group">
    				<label>Nama Bank</label>
    				<?php if(isset(session('errors')['bank_name'])): ?>

	    				<input type="text" name="bank_name" value="<?= old('bank_name') ?? $bill->bank_name ?>" class="form-control is-invalid">
	    				<div class="invalid-feedback">
	    					<?= session('errors')['bank_name'] ?>
	    				</div>
	    			<?php else: ?>
	    				<input type="text" name="bank_name" value="<?= old('bank_name') ?? $bill->bank_name ?>" class="form-control">
    				<?php endif ?>
    			</div>
    			<div class="form-group">
    				<label>Nomor Rekening</label>
    				<?php if(isset(session('errors')['bank_number'])): ?>
	    				<input type="text" name="bank_number" value="<?= old('bank_number') ?? $bill->bank_number ?>" class="form-control is-invalid">
	    				<div class="invalid-feedback"><?= session('errors')['bank_number'] ?></div>
	    			<?php else: ?>
	    				<input type="text" name="bank_number" value="<?= old('bank_number') ?? $bill->bank_number ?>" class="form-control">
    				<?php endif ?>
    			</div>
    			<div class="form-group">
    				<label>Nama Pemilik Rekening</label>
    				<?php if(isset(session('errors')['owner'])): ?>
	    				<input type="text" name="owner" value="<?= old('owner') ?? $bill->owner ?>" class="form-control is-invalid">
	    				<div class="invalid-feedback"><?= session('errors')['owner'] ?></div>
	    			<?php else: ?>
	    				<input type="text" name="owner" value="<?= old('owner') ?? $bill->owner ?>" class="form-control">
    				<?php endif ?>
    			</div>
    			<div class="form-group">
    				<button type="submit" class="btn btn-primary mt-3">Update</button>
    			</div>
    		</form>
		<?php else: ?>
			<form method="POST" class="my-3">
				<div class="form-group">
					<label>Nama Bank</label>
  				<?php if(isset(session('errors')['bank_name'])): ?>
    				<input type="text" name="bank_name" value="<?= old('bank_name') ?>" class="form-control is-invalid">
    				<div class="invalid-feedback"><?= session('errors')['bank_name'] ?></div>
    			<?php else: ?>
    				<input type="text" name="bank_name" value="<?= old('bank_name') ?>" class="form-control">
  				<?php endif ?>
				</div>
				<div class="form-group">
					<label>Nomor Rekening</label>
					<?php if(isset(session('errors')['bank_number'])): ?>
	  				<input type="number" name="bank_number" value="<?= old('bank_number') ?>" class="form-control is-invalid">
	  				<div class="invalid-feedback"><?= session('errors')['bank_number'] ?></div>
	  			<?php else: ?>
	  				<input type="number" name="bank_number" value="<?= old('bank_number') ?>" class="form-control">
					<?php endif ?>
				</div>
				<div class="form-group">
					<label>Nama Pemilik Rekening</label>
					<?php if(isset(session('errors')['owner'])): ?>
    				<input type="text" name="owner" value="<?= old('owner') ?>" class="form-control is-invalid">
    				<div class="invalid-feedback"><?= session('errors')['owner'] ?></div>
    			<?php else: ?>
    				<input type="text" name="owner" value="<?= old('owner') ?>" class="form-control">
  				<?php endif ?>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary mt-3">Save</button>
				</div>
			</form>
    	<?php endif ?>

    	<table class="table table-hover table-bordered table-stripped">

    		<thead>
    			<tr>
    				<th>No</th>
    				<th>Nama Bank</th>
    				<th>Nomor Rekening</th>
    				<th>Nama Pemilik</th>
    				<th>Aksi</th>
    			</tr>
    		</thead>

    		<tbody>
    			<?php if (isset($bill)): ?>

    				<?php $no = 1; ?>
    					<tr>
    						<td><?= $no++ ?></td>
    						<td><?= $bill->bank_name ?></td>
    						<td><?= $bill->bank_number ?></td>
    						<td><?= $bill->owner ?></td>
    						<td><a href="<?= base_url('bill/edit/'.$bill->id) ?>">Edit</a> | <a href="<?= base_url('bill/delete/'.$bill->id) ?>">Hapus</a></td>
    					</tr>
    			
    			<?php else: ?>
    				<?php $no = 1; foreach($bills as $bill):  ?>
    					<tr>
    						<td><?= $no++ ?></td>
    						<td><?= $bill->bank_name ?></td>
    						<td><?= $bill->bank_number ?></td>
    						<td><?= $bill->owner ?></td>
    						<td><a href="<?= base_url('bill/edit/'.$bill->id) ?>">Edit</a> | <a href="<?= base_url('bill/delete/'.$bill->id) ?>">Hapus</a></td>
    					</tr>
    				<?php endforeach;  ?>
    			<?php endif ?>
    		</tbody>
    		
    	</table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  </body>
</html>