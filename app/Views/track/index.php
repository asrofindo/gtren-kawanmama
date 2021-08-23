<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS --><!-- 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->

    <title>Track</title>
  </head>
  <body>
    
    <div class="container">
    	<div class="card">
    		<div class="card-body">
    			<h2>Detail of ur track</h2>
    			<p>No Resi : <?= $track['data']['summary']['awb'] ?></p>
    			<p>Kurir : <?= $track['data']['summary']['courier'] ?></p>
    			<p>Status : <?= $track['data']['summary']['status'] ?></p>
    			<ul class="list-group">
    				<?php for($i = 0; $i < count($track['data']['history']); $i++):?>
    					<?php if ($i == 0): ?>
    			  			<li class="list-group-item active" aria-current="true">
    			  				<?= $track['data']['history'][$i]['date'] ?> | <?= $track['data']['history'][$i]['desc'] ?>
    			  			</li>
    			  		<?php else: ?>
	    			  		<li class="list-group-item">
	    			  			<?= $track['data']['history'][$i]['date'] ?> | <?= $track['data']['history'][$i]['desc'] ?>
	    			  		</li>
    					<?php endif ?>
    				<?php endfor?>
    			</ul>
    		</div>
    	</div>
    </div>


    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script> -->

  </body>
</html>