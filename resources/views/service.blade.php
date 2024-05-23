@extends('layouts.app')
@section('title')
Service
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
					<span class="text-white">Our services</span>
					<h1 class="text-capitalize mb-5 text-lg">What We Do</h1>

					<!-- <ul class="list-inline breadcumb-nav">
			  <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
			  <li class="list-inline-item"><span class="text-white">/</span></li>
			  <li class="list-inline-item"><a href="#" class="text-white-50">Our services</a></li>
			</ul> -->
				</div>
			</div>
		</div>
	</div>
</section>


<section class="section service-2">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-block mb-5">
					<img src="{{ asset('website/images/service/service-1.jpg') }}" alt="" class="img-fluid">
					<div class="content">
						<h4 class="mt-4 mb-2 title-color">Child care</h4>
						<p class="mb-4"> Nurturing, safe spaces for little ones to thrive.</p>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-block mb-5">
					<img src="{{ asset('website/images/service/service-2.jpg') }}" alt="" class="img-fluid">
					<div class="content">
						<h4 class="mt-4 mb-2  title-color">Personal Care</h4>
						<p class="mb-4">Tailored support for your well-being and health needs.</p>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-block mb-5">
					<img src="{{ asset('website/images/service/service-3.jpg') }}" alt="" class="img-fluid">
					<div class="content">
						<h4 class="mt-4 mb-2 title-color">CT scan</h4>
						<p class="mb-4">Advanced imaging for accurate diagnosis and effective treatment planning.</p>
					</div>
				</div>
			</div>


			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-block mb-5 mb-lg-0">
					<img src="{{ asset('website/images/service/service-4.jpg') }}" alt="" class="img-fluid">
					<div class="content">
						<h4 class="mt-4 mb-2 title-color">Joint replacement</h4>
						<p class="mb-4">Restoring mobility, relieving pain, enhancing life's quality.</p>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-block mb-5 mb-lg-0">
					<img src="{{ asset('website/images/service/service-6.jpg') }}" alt="" class="img-fluid">
					<div class="content">
						<h4 class="mt-4 mb-2 title-color">Examination & Diagnosis</h4>
						<p class="mb-4">Precision assessment for accurate treatment planning and care.</p>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-block mb-5 mb-lg-0">
					<img src="{{ asset('website/images/service/service-8.jpg') }}" alt="" class="img-fluid">
					<div class="content">
						<h4 class="mt-4 mb-2 title-color">Alzheimer's disease</h4>
						<p class="mb-4">Understanding, managing, and supporting those affected by memory loss.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="section cta-page">
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<div class="cta-content">
					<div class="divider mb-4"></div>
					<h2 class="mb-5 text-lg">We are pleased to offer you the <span class="title-color">chance to have
							the healthy</span></h2>
					<a href="{{ route('appoinment') }}" class="btn btn-main-2 btn-round-full">Get appoinment<i
							class="icofont-simple-right  ml-2"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>

@section('model')

@endsection
@endsection

@push('scripts')
<script type="text/javascript">

</script>
@endpush