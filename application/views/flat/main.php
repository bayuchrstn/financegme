<!DOCTYPE html>
<html>

<head>
    <noscript>
        <meta http-equiv="refresh" content="0; url=<?php echo base_url(); ?>nojs" />
    </noscript>
    <title><?php echo $browser_title; ?></title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css"> -->
    <link href="<?php echo base_url(); ?>assets/css/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/components.css?x=3" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/password_indicator.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/chosen.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/pace.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/break.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/select2/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/js/datatables/extensions/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/invoice/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css" rel="stylesheet">

    <?php echo $css_include; ?>
</head>

<body id="body_loader" class="">

    <?php echo $navbar; ?>




    <div class="page-container">
        <div class="page-content">

            <?php echo $sidebar; ?>


            <div class="content-wrapper">
                <?php echo $main_content; ?>

            </div>
        </div>
    </div>

    <?php echo $this->load->view('flat/html_bottom', '', TRUE); ?>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/blockui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.pwstrength.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chosen.jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/autoNumeric.min.js"></script>
    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/navbar.js"></script> -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/app.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/switch.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pushjs/push.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pushjs/serviceWorker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/func.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pace.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/masonry.pkgd.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/invoice/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
    <?php echo $js_include; ?>

    <?php echo $js_page; ?>

    <?php echo $js_inject; ?>
</body>

</html>