

<!DOCTYPE html>
<html>


<!-- Mirrored from my.beon.co.id/clientarea.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Nov 2016 06:09:55 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta http-equiv="content-type" content="text/html;utf-8" />
    <meta charset="utf-8" />
            <title>Simdiklat | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
            <base  />
        <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/logo_bappenas.png" />

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="<?php echo base_url();?>assets/plugins/pace/themes/pace-theme-flash.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/plugins/jquery-scrollbar/css/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/plugins/ion.rangeSlider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/plugins/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/plugins/nouislider/css/nouislider.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/plugins/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/plugins/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/css/pages-icons.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/css/simdiklat.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/css/added.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>assets/js/jquery.min.js" type="text/javascript"></script>
</head>

<body class="fixed-header menu-pin">

                


<!-- START PAGE-CONTAINER -->
<div class="login-wrapper ">
  <!-- START Login Background Pic Wrapper-->
  <div class="bg-pic">
    <!-- START Background Pic-->
	<img src="<?php echo base_url();?>assets/banner/Banner-Login-Beon.jpg" data-src="<?php echo base_url();?>assets/banner/Banner-Login-Beon.jpg" data-src-retina="<?php echo base_url();?>assets/Banner-Login-Beon.jpg" alt="" class="lazy" style="cursor:pointer;">
    <!-- END Background Pic-->
    <!-- START Background Caption
    <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
      <h2 class="semi-bold text-white">
			Pages make it easy to enjoy what matters the most in the life</h2>
      <p class="small">
        images Displayed are solely for representation purposes only, All work copyright of respective owner, otherwise © 2013-2014 REVOX.
      </p>
    </div>
     END Background Caption-->
  </div>
  <!-- END Login Background Pic Wrapper-->
  <!-- START Login Right Container-->
  <div class="login-container bg-white">
	
    <?php echo form_open("", 'class="form-stacked"');?>
      <div class="p-l-20 p-r-20 p-t-50 sm-p-l-15 sm-p-r-15">
        <div class="text-center"><img src="<?php echo base_url();?>assets/img/simdiklat-login-logo.png" width="100%">
        </div>
        <p class="p-t-35">Masukan alamat email anda untuk mendapat katasandi baru.</p>
        <!-- START Login Form -->
          <!-- START Form Control-->
		  <?php echo $msg?>
          <div class="form-group form-group-default">
            <label>Alamat Email</label>
            <div class="controls">
              <input type="text" name="email" placeholder="Alamat Email" class="form-control" required>
            </div>
          </div>
          <!-- END Form Control-->
          <div class="row">
            <div class="col-md-6 col-xs-6">
              <button class="btn btn-success" type="submit">Submit</button>
            </div>
            <div class="col-md-6  col-xs-6 text-right" style="margin-top:9px">
              <?php echo anchor('auth/login','<i class="fa fa-left-arrow"></i> Kembali','class="text-info small"')?>
            </div>
          </div>
      </div>
    </form>
  </div>
  <!-- END Login Right Container-->
</div>
	<script src="<?php echo base_url();?>assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/js/modernizr.custom.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-scrollbar/js/jquery.scrollbar.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/js/classie.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/plugins/ion.rangeSlider/js/ion.rangeSlider.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/plugins/nouislider/js/nouislider.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.liblink.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-toggles/toggles.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/js/pages.js" type="text/javascript"></script>
</body>
</html>
