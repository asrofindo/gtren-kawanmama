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
<body>
        <main class="main single-page">
                <?= $this->include('commerce/templates/header') ?>

                <?php $this->renderSection('content') ?>
                <?= $this->include('commerce/templates/footer') ?>

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
</body>

</html>