<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Simdiklat | <?php echo $title;?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <?php
			foreach($p_css as $css)
			{
				echo '<link href="'.base_url().'assets/'.$css.'" rel="stylesheet" type="text/css" />' .PHP_EOL;
			}
		?>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url();?>assets/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url();?>assets/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo base_url();?>assets/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/css/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url();?>assets/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->

		<script src="<?php echo base_url();?>assets/js/jquery.min.js" type="text/javascript"></script>

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-header-menu-fixed">
        <div class="page-header">
            <!-- BEGIN HEADER TOP -->
            <div class="page-header-top">
                <div class="container-fluid">
					<!-- BEGIN LOGO -->
                    <div class="page-logo">
						<a href="<?php echo base_url();?>">
                            <img src="<?php echo base_url();?>assets/img/logo-simdiklat.png" alt="logo" class="logo-default">
                            <img src="<?php echo base_url();?>assets/img/simdiklat-logo-m.png" alt="logo" class="logo-mobile">
                        </a>
                    </div>
                    <!-- END LOGO -->
					<!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
							<!-- BEGIN USER LOGIN DROPDOWN -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<span class="username username-hide-mobile hidden-xs strong"> Login Sebagai, <?php echo $this->session->userdata('username');?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
									<li>
                                        <?php echo anchor('diklat/change-password/ubah-password','<i class="icon-lock"></i>  Ubah Password');?>
                                    </li>
									<li>
                                        <?php echo anchor('auth/logout','<i class="icon-key"></i>  Log Out');?>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
							<!-- BEGIN RESPONSIVE MENU TOGGLER -->
							<a href="javascript:;" class="menu-toggler"></a>
							<!-- END RESPONSIVE MENU TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
            </div>
            <!-- END HEADER TOP -->
            <!-- BEGIN HEADER MENU -->
            <div class="page-header-menu">
                <div class="container-fluid">
                    <!-- BEGIN MEGA MENU -->
                    <div class="hor-menu  ">
                        <ul class="nav navbar-nav">
							<li class="<?php echo $active[0];?>"><?php echo anchor('home','Home')?></li>
							<li><?php echo anchor('auth/logout','Logout');?></li>
						</ul>
                    </div>
                    <!-- END MEGA MENU -->
                </div>
            </div>
            <!-- END HEADER MENU -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- BEGIN PAGE CONTENT INNER -->
                        <div class="page-content-inner">
							<?php $this->load->view($content);?>
						</div>
                        <!-- END PAGE CONTENT INNER -->
                    </div>
                </div>
                <!-- END PAGE CONTENT BODY -->
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN INNER FOOTER -->
        <div class="page-footer">
            <div class="container"> 2016 &copy;
				<a href="http://phrd4.org" title="PHRD IV" target="_blank">PHRD IV</a> |
				<a href="http://pusbindiklatren.bappenas.go.id" title="Pusbindiklatren" target="_blank">PUSBINDIKLATREN</a> |
				<a href="http://bappenas.go.id" title="BAPPENAS" target="_blank">BAPPENAS</a>
				<span class="pull-right hidden-xs">Page rendered in <strong>{elapsed_time}</strong> seconds.</span>
            </div>
			<?php //var_dump($this->session->userdata())?>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
        <!-- END INNER FOOTER -->
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
		<script src="<?php echo base_url();?>assets/global/plugins/respond.min.js"></script>
		<script src="<?php echo base_url();?>assets/global/plugins/excanvas.min.js"></script>
		<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/js/js.cookie.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>assets/js/app.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
		<?php
			foreach($p_js as $js)
			{
				echo '<script src="'.base_url().'assets/'.$js.'" type="text/javascript"></script>' .PHP_EOL;
			}
		?>
        <!-- BEGIN THEME GLOBAL SCRIPTS -->

        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url();?>assets/js/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/js/demo.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>
