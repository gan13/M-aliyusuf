<div class="login-box">		
	<div class="alert alert-danger alert-dismissable" id="tunggu_redirect" style="display:none;">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-ban"></i> Mohon tunggu !</h4>
		<div id="error2"></div>Anda akan dihubungkan ke dashboard
	</div>
	<div class="login-logo">
		<a href="<?php echo base_url(); ?>"><b>Login</b></a>
	</div><!-- /.login-logo -->
	<div class="login-box-body" id="box_login">
		<p class="login-box-msg">Login Dengan Username Anda</p>
		<form action="#" method="post">
			<div class="alert alert-warning alert-dismissable" id="loading_login" style="display:none;">
				<h4><i class="fa fa-refresh fa-spin"></i> Mohon tunggu....</h4>
			</div>
			<div class="alert alert-danger alert-dismissable" id="login_error" style="display:none;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-ban"></i> Error !</h4>
				<div id="pesan_error"></div>
			</div>
			<div class="form-group has-feedback">
				<input type="text" class="form-control" id="user_name" placeholder="User Name"/>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" id="password" placeholder="Password"/>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>									
			<div class="row">
				<div class="col-xs-4">
					<button type="submit" class="btn btn-primary btn-block btn-flat" id="login_submit">Sign In</button>
				</div><!-- /.col -->
			</div>
		</form>
	</div><!-- /.login-box-body -->
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#login_submit").on("click", function(e) {
      e.preventDefault();
      $('#login_error').hide();
      $('#loading_login').show();
      var user_name = $("#user_name").val();
      var password = $("#password").val();
      $.ajax({
        type: "POST",
        async: true,
        data: {
          user_name: user_name,
          password: password
        },
        dataType: "json",
        url: '<?php echo base_url(); ?>login/proses_login',
        success: function(json) {
          var trHTML = '';
          for (var i = 0; i < json.length; i++) {
            if (json[i].errors == 'form_kosong') {
              $('#loading_login').fadeOut("slow");
              $('#login_error').show();
              $('#pesan_error').html('' + json[i].errors + ', Mohon isis data secara lengkap');
              if (json[i].user_name == '') {
                $('#user_name').css('background-color', '#DFB5B4');
              } else {
                $('#user_name').removeAttr('style');
              }
              if (json[i].password == '') {
                $('#password').css('background-color', '#DFB5B4');
              } else {
                $('#password').removeAttr('style');
              }
            } else if (json[i].errors == 'user_tidak_ada') {
              $('#loading_login').fadeOut("slow");
              $('#login_error').show();
              $('#pesan_error').html('Data login anda salah');
              if (json[i].user_name == '') {
                $('#user_name').css('background-color', '#DFB5B4');
              } else {
                $('#user_name').removeAttr('style');
              }
              if (json[i].password == '') {
                $('#password').css('background-color', '#DFB5B4');
              } else {
                $('#password').removeAttr('style');
              }
            } else if (json[i].errors == 'miss_match') {
              $('#loading_login').fadeOut("slow");
              $('#login_error').show();
              $('#pesan_error').html('Data login anda salah');
              if (json[i].user_name == '') {
                $('#user_name').css('background-color', '#DFB5B4');
              } else {
                $('#user_name').removeAttr('style');
              }
              if (json[i].password == '') {
                $('#password').css('background-color', '#DFB5B4');
              } else {
                $('#password').removeAttr('style');
              }
            } else {
              $('#error2').html('Pesan : ' + json[i].errors + '');
              $('#box_login').hide();
              $('#tunggu_redirect').show();
              window.location = "<?php echo base_url(); ?>";
            }
          }
        }
      });
    });
  });
</script>