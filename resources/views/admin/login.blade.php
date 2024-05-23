<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRM Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
	  <div style="border-bottom:1px solid #999999; padding-bottom:10px;" align="center">
	  	<img src="{{ asset('website/images/logo.png') }}" alt="" style=" width:60%;">
	  </div>
      <p class="login-box-msg">CRM</p>

      <form  method="post" action="{{ url('adminlogin') }}" id="form">
	  @csrf
        <div class="input-group mb-3">
		  <input class="form-control" id="admin_user_id" type="text" name="admin_user_id" placeholder="User ID" value="{{ old('admin_user_id') }}" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
		  <input class="form-control" id="admin_password" type="password" name="admin_password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
		<div class="input-group mb-3">
          <div id="recaptcha1"></div>
        </div>
		 
        <div class="row">
         
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit" async defer></script>
<script>
var recaptcha1;
var myCallBack = function(){
        //Render the recaptcha1 on the element with ID "recaptcha1"
        recaptcha1 = grecaptcha.render('recaptcha1', {
          'sitekey' : '6LecxuMmAAAAAJS-rqfCXVTw9I2e66zGLuRaVIYw', //Replace this with your Site key
          'theme' : 'light'
        });
   };
	 
$(function(){
		//$('#trial_dt').datepick({dateFormat: 'dd-mm-yyyy'});
		$('#form').submit(function(event){
		  
			var varified = grecaptcha.getResponse();
			if(varified.length === 0)
			{
				alert('Please fill captcha');
				event.preventDefault();
			}
		
		});
	});
	
	$(".toggle-password").click(function() {

	  $(this).toggleClass("fa-eye fa-eye-slash");
	  var input = $($(this).attr("toggle"));
	  if (input.attr("type") == "password") {
		input.attr("type", "text");
	  } else {
		input.attr("type", "password");
	  }
   });
</script>
</body>
</html>
