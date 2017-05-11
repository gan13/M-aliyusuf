<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link  href=" <?php base_url(); ?> boots/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url(); ?>boots/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo base_url(); ?>boots/font-awesome/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- jvectormap -->
  <link  href=" <?php base_url(); ?> boots/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">
  <!-- Theme style -->
  <link  href=" <?php base_url(); ?> boots/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href=" <?php base_url(); ?> boots/dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/alertify/alertify.core.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/datepicker.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/alertify/alertify.default.css" id="toggleCSS" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/Typeahead-BS3-css.css" id="toggleCSS" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>boots/dist/css/bootstrap-timepicker.min.css" />
		<!-- Progress bar -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-combined.min.css" id="toggleCSS" />
    <link href="<?php echo base_url(); ?>boots/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
		<style>
		#firstz
		{
				position:absolute;
				bottom:0;
				left:0;
				right:0;
				top:0;  
				opacity:0.5;
				background-color:#000;
				color:#fff;
				z-index:9999;
		}
		#pesan_loading{
			position: fixed;
			top: 50%;
			left: 50%;
			margin-top: -50px;
			margin-left: -100px;
		}
		</style>
		<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
</head>
<!-- ADD THE CLASS sidedar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(); ?>beranda" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
						<?php
						if( $this->session->userdata('user_id') ){
							echo 
							'
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Akun <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="'.base_url().'ganti_password">Ganti Password</a></li>
										<li><a href="'.base_url().'login/logout">Log Out</a></li>
									</ul>
								</li>
							</ul>
							';
							}
						else{
							echo 
							'
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Akun <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="'.base_url().'login">Login</a></li>
									</ul>
								</li>
							</ul>
							';
							}
						?>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a ></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>boots/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
        <li class="treeview">
          <a href="<?php echo base_url();?>beranda">
            <i class="fa fa-laptop"></i>
            <span>Beranda</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo base_url();?>diagnosa">
            <i class="fa fa-edit"></i> <span>Diagnosa</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo base_url();?>gejala">
            <i class="fa fa-edit"></i> <span>Gejala</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo base_url();?>relasi">
            <i class="fa fa-edit"></i> <span>Relasi</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo base_url();?>konsultasi">
            <i class="fa fa-edit"></i> <span>Konsultasi</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo base_url();?>password">
            <i class="fa fa-edit"></i> <span>Password</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
<?php $this->load->view($main_view); ?>
      </div>
    </section>
  </div>

  
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.3
    </div>
    <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src=" <?php base_url(); ?> boots/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src=" <?php base_url(); ?> boots/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src=" <?php base_url(); ?> boots/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src=" <?php base_url(); ?> boots/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src=" <?php base_url(); ?> boots/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src=" <?php base_url(); ?> boots/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src=" <?php base_url(); ?> boots/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src=" <?php base_url(); ?> boots/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src=" <?php base_url(); ?> boots/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src=" <?php base_url(); ?> boots/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src=" <?php base_url(); ?> boots/dist/js/demo.js"></script>
		<script src="<?php echo base_url(); ?>js/alertify.min.js"></script>
		<!--- -->
		<script src="<?php echo base_url(); ?>js/colorbox/jquery.colorbox.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-typeahead.js"></script>
    <script src="<?php echo base_url(); ?>js/hogan-2.0.0.js"></script>
		<!-- daterangepicker -->
    <script src="<?php echo base_url(); ?>boots/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>js/bootstrap-datepicker.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>boots/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>js/jquery.form.js"></script>
		<!-- Start editor-->
		<script src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.js"></script>
		<!-- End editor-->

</body>
</html>
