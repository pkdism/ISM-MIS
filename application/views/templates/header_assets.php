<!DOCTYPE html>
<html>
    <head>
        <title>
        <?php
            if(isset($title))	echo $title;
            else				echo 'MIS - Indian School of Mines';
        ?>
        </title>

        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
 	    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <link href="<?= base_url() ?>assets/core/bootstrap-3.3.2/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/core/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets/core/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/core/adminLTE/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/core/adminLTE/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    	<link href="<?= base_url() ?>assets/core/adminLTE/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets/core/img_upload/upload_image.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/core/adminLTE/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets/core/adminLTE/css/ionslider/ion.rangeSlider.css" rel="stylesheet" type="text/css">
		<link href="<?= base_url() ?>assets/core/adminLTE/css/ionslider/ion.rangeSlider.skinFlat.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets/core/adminLTE/css/ionslider/ion.rangeSlider.skinNice.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets/core/notification-layout.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets/core/mis-extension.css" rel="stylesheet" type="text/css">
<!--		<link href="<?= base_url() ?>assets/core/mis-layout.css" rel="stylesheet" type="text/css" /> -->
		<?php if(isset($css)) echo $css; ?>

        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?= base_url() ?>assets/core/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/core/jquery-ui.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/core/bootstrap-3.3.2/dist/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?= base_url() ?>assets/core/adminLTE/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/core/adminLTE/js/AdminLTE/app.js" type="text/javascript"></script>
		<script src="<?= base_url() ?>assets/core/adminLTE/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
		<script src="<?= base_url() ?>assets/core/adminLTE/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
   		<script src="<?= base_url() ?>assets/core/moment.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/core/adminLTE/js/plugins/ionslider/ion.rangeSlider.min.js" type="text/javascript"></script>
   		<script src="<?= base_url() ?>assets/core/mis-extension.js" type="text/javascript"></script>

<!--		<script src="<?= base_url() ?>assets/core/mis-layout.js" type="text/javascript"></script> -->
		<script type="text/javascript">
            function base_url()	{ return "<?= base_url()?>"; }
            function site_url(uri) { return base_url() + "index.php/" + uri; }
        </script>
	    <?php if(isset($javascript)) echo $javascript; ?>
    </head>