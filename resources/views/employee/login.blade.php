@extends('layouts.app')
@section('title')
Doctor Log in
@endsection
@section('meta')

@endsection
@section('style')
<style>

</style>
@endsection
@section('content')
<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <span class="text-white">Login as a Doctor</span>
          <h1 class="text-capitalize mb-5 text-lg">Login</h1>

          <!-- <ul class="list-inline breadcumb-nav">
			  <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
			  <li class="list-inline-item"><span class="text-white">/</span></li>
			  <li class="list-inline-item"><a href="#" class="text-white-50">Book your Seat</a></li>
			</ul> -->
        </div>
      </div>
    </div>
  </div>
</section>

<section class="appoinment section">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="mt-3">
          <div class="feature-icon mb-3">
            <i class="icofont-support text-lg"></i>
          </div>
          <span class="h3">Call for an Emergency Service!</span>
          <h2 class="text-color mt-3">+83 3607 0583</h2>
        </div>
      </div>

      <div class="col-lg-8">
        <div class="appoinment-wrap mt-5 mt-lg-0 pl-lg-5">
          <h2 class="mb-2 title-color">Login as a Doctor</h2>
          <p class="mb-4">"Secure portal for medical professionals to access patient records, manage appointments, and collaborate on healthcare plans. Streamlined interface for efficient practice management."</p>
          <form method="post" action="{{ url('employeelogin') }}" id="form" class="appoinment-form">
            @csrf
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <input class="form-control" id="emp_user_id" type="text" name="emp_user_id" placeholder="User ID"
                    value="{{ old('emp_user_id') }}">
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <input class="form-control" id="password" type="password" name="password" placeholder="Password">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="input-group mb-3">
                  <div id="recaptcha1"></div>
                </div>
                @if(session('errmsg'))
                <div class="input-group mb-3">
                  {{ session('errmsg') }}
                </div>
                @endif
              </div>
            </div>

            <button type="submit" class="btn btn-main btn-round-full">Login<i
                class="icofont-simple-right ml-2"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
@section('model')

@endsection
@endsection

@push('scripts')
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
@endpush