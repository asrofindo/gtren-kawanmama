<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title><?php if(isset($title)){echo $title;}else{echo 'Gtren';}?></title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url()  ?>/frontend/imgs/theme/favico.svg">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url()  ?>/frontend/css/main.css">

    <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>
    
    <link
      href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css"
      rel="stylesheet"
    />
    <!-- Geocoder plugin -->
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
    
    <link
      rel="stylesheet"
      href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css"
      type="text/css"
    />
    <!-- Turf.js plugin -->
    <script src="https://npmcdn.com/@turf/turf/turf.min.js"></script>
    
</head>
<body id="body">

  <style>
 @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

fieldset, label { margin: 0; padding: 0; }
h1 { font-size: 1.5em; margin: 10px; }

/****** Style Star Rating Widget *****/

.rating { 
  border: none;
  float: left;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 5px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
  color: #ddd; 
 float: right; 
}
.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 
  </style>
        <main class="main single-page">
                <?php if (isset($category)) {
                  echo $this->include('commerce/templates/header');
                } ?>

                <?php $this->renderSection('content') ?>

                <?php if (isset($category)) {
                  echo $this->include('commerce/templates/footer');
                 } ?>

    </main>

    <script src="<?= base_url()  ?>/frontend/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/plugins/slick.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/plugins/jquery.syotimer.min.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/plugins/jquery.elevatezoom.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/plugins/jquery.theia.sticky.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/plugins/wow.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/plugins/jquery-ui.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/plugins/perfect-scrollbar.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/plugins/magnific-popup.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/plugins/select2.min.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/plugins/waypoints.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/plugins/counterup.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/plugins/jquery.countdown.min.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/plugins/images-loaded.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/plugins/isotope.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/plugins/scrollup.js"></script>
    <script src="<?= base_url()  ?>/frontend/js/plugins/jquery.vticker-min.js"></script>
    <!-- Template  JS -->
    <script src="<?= base_url()  ?>/./frontend/js/main.js"></script>
    <script src="<?= base_url()  ?>/./frontend/js/shop.js"></script>
    <script type="text/javascript">
        const locate = document.getElementById('location');

        function getLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
          alert("The Browser Does not Support Geolocation");
        }
      }

      function showPosition(position) {
        $.get(`https://api.mapbox.com/geocoding/v5/mapbox.places/${position.coords.longitude},${position.coords.latitude}.json?access_token=pk.eyJ1IjoiaW1yb25wdWppIiwiYSI6ImNrcWllYWptcjBnNGkycG81NnZ6ZjJ4aGEifQ.rtzqR7kNhMsubMbsnLoJcA`, function(data) {
            for(let i = 0; i < data.features.length; i++){
                if(data.features[i]['place_type'][0] == 'locality'){

                    locate.innerHTML = `${data.features[i]['place_name']}`
                }
            }
        })
      }
      function showError(error) {
        if(error.PERMISSION_DENIED){
            console.log("The User have denied the request for Geolocation.");
        }
      }
      getLocation();
    </script>


    <!-- Modal -->
    <?php if(user() != null): ?>
    <?php if(user()->status_message == null && user()->phone != null): ?>
    <form action="<?php base_url() ?>/verifyotp" method="post">
      <div class="attention">
      </div>
      <div style="" class="modal fade" id="modalKita" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Verifikasi WA <?= user()->phone; ?></h5>

              <h5><a href="<?php base_url() ?>/verifyotp/<?=  user()->id ?>">ganti Nomer WA Disini ?</a></h5>
            </div>
            <div class="modal-body">
            <?php if(!empty(session()->getFlashdata('success-otp'))){ ?>

                <div class="alert alert-success bg-success text-white">
                    <?php echo session()->getFlashdata('success-otp');?>
                </div>

            <?php } ?>

            <?php if(!empty(session()->getFlashdata('danger-otp'))){ ?>

                <div class="alert alert-danger bg-danger text-white">
                    <?php echo session()->getFlashdata('danger-otp');?>
                </div>

            <?php } ?>
              <div class="d-flex flex-row mt-5"><input maxlength="1" name="valOne"  style="margin:8px" type="text" class="form-control input-class" autofocus=""><input maxlength="1" name="valTwo"  style="margin:8px" type="text" class="form-control input-class"><input maxlength="1" name="valTree"  style="margin:8px" type="text" class="form-control input-class"><input maxlength="1" name="valFour"  style="margin:8px" type="text" class="form-control input-class"><input maxlength="1" name="valFive"  style="margin:8px" type="text" class="form-control input-class"></div>
            </div>
            <div class="modal-footer">
              <a href="<?php base_url() ?>/verifywa/<?= user()->id ?>">Klik Di sini Untuk Minta Kode OTP Baru</a>
              <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  <?php endif; ?>
<?php endif; ?>
    <script type="text/javascript">
      $(document).ready(function() {
       $('#modalKita').modal({backdrop:'static'})  
       $('#modalKita').modal('show')  

       $(".input-class").keyup(function(event){

          if ($(this).next('.input-class').length > 0){
             $(this).next('.input-class')[0].focus();
          }
          else{
             if ($(this).parent().next().find('.input-class').length > 0){
                $(this).parent().next().find('.input-class')[0].focus();
             }
             // else {
             //   alert('no more text input found !');
             // }
          }

        });


      });
      
    </script>
    </body>

</html>