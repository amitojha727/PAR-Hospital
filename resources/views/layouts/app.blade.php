<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Arrow">
    <meta name="keywords" content="Arrow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
	@yield('meta')
	<!-- Favicon -->
  	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('website/images/short-icon.png') }}" />

  	<!-- bootstrap.min css -->
  	<link rel="stylesheet" href="{{ asset('website/plugins/bootstrap/css/bootstrap.min.css') }}">
  	<!-- Icon Font Css -->
  	<link rel="stylesheet" href="{{ asset('website/plugins/icofont/icofont.min.css') }}">
  	<!-- Slick Slider  CSS -->
  	<link rel="stylesheet" href="{{ asset('website/plugins/slick-carousel/slick/slick.css') }}">
  	<link rel="stylesheet" href="{{ asset('website/plugins/slick-carousel/slick/slick-theme.css') }}">

  	<!-- Main Stylesheet -->
  	<link rel="stylesheet" href="{{ asset('website/css/style.css') }}">
	@yield('style')
	<style>
	
	</style>
</head>
<body id="top">
	<!-- header -->
	@include('layouts.headerWeb')
	<!-- end header -->
	<!-- body -->
	@yield('content')
	<!-- end body -->
	<!-- footer -->
	@include('layouts.footerWeb')
	<!-- end footer -->
	<!-- Modal -->
	
	@yield('model')
	<!-- 
    Essential Scripts
    =====================================-->

    
    <!-- Main jQuery -->
    <script src="{{ asset('website/plugins/jquery/jquery.js') }}"></script>
    <!-- Bootstrap 4.3.2 -->
    <script src="{{ asset('website/plugins/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('website/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('website/plugins/counterup/jquery.easing.js') }}"></script>
    <!-- Slick Slider -->
    <script src="{{ asset('website/plugins/slick-carousel/slick/slick.min.js') }}"></script>
    <!-- Counterup -->
    <script src="{{ asset('website/plugins/counterup/jquery.waypoints.min.js') }}"></script>
    
    <script src="{{ asset('website/plugins/shuffle/shuffle.min.js') }}"></script>
    <script src="{{ asset('website/plugins/counterup/jquery.counterup.min.js') }}"></script>
    <!-- Google Map -->
    <script src="{{ asset('website/plugins/google-map/map.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA&callback=initMap"></script>    
    
    <script src="{{ asset('website/js/script.js') }}"></script>
    {{-- <script src="{{ asset('website/js/contact.js') }}"></script> --}}
	<script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit" async defer></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
		@if(session('status'))
			swal({
				title: "{{ session('status')['title'] }}",
				text: "{{ session('status')['text'] }}",
				icon: "{{ session('status')['icon'] }}",
				button: "Ok",
			});
		@endif
	</script>
	@stack('scripts')
</body>
</html>