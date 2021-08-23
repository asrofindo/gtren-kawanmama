  <!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Wowy Dashboard</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php base_url() ?>/backend/imgs/theme/favico.svg">
    <!-- Template CSS -->
    <link href="<?php base_url() ?>/backend/css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
    
    <?php $this->renderSection('content') ?>
    <?php $this->renderSection('footer') ?>
    <script src="<?php base_url() ?>/backend/js/vendors/jquery-3.5.1.min.js"></script>
    <script src="<?php base_url() ?>/backend/js/vendors/bootstrap.bundle.min.js"></script>
    <script src="<?php base_url() ?>/backend/js/vendors/jquery.fullscreen.min.js"></script>
    <!-- Main Script -->
    <script src="<?php base_url() ?>/backend/js/main.js" type="text/javascript"></script>
</body>

</html>