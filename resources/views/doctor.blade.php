@extends('layouts.app')
@section('title')
Doctor
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
					<span class="text-white">All Doctors</span>
					<h1 class="text-capitalize mb-5 text-lg">Specalized doctors</h1>

					<!-- <ul class="list-inline breadcumb-nav">
			  <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
			  <li class="list-inline-item"><span class="text-white">/</span></li>
			  <li class="list-inline-item"><a href="#" class="text-white-50">All Doctors</a></li>
			</ul> -->
				</div>
			</div>
		</div>
	</div>
</section>


<!-- portfolio -->
<section class="section doctors">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6 text-center">
				<div class="section-title">
					<h2>Doctors</h2>
					<div class="divider mx-auto my-4"></div>
					<p>We provide a wide range of creative services adipisicing elit. Autem maxime rem modi eaque,
						voluptate. Beatae officiis neque </p>
				</div>
			</div>
		</div>

		<div class="col-12 text-center  mb-5">
			<div class="btn-group btn-group-toggle " data-toggle="buttons">
				<label class="btn active ">
					<input type="radio" name="shuffle-filter" value="all" checked="checked" />All Department
				</label>
				@foreach($department_list as $key => $row)
					<label class="btn ">
						<input type="radio" name="shuffle-filter" value="{{ $row->site_id }}" />{{ $row->site_nm }}
					</label>
				@endforeach
				
				{{-- <label class="btn">
					<input type="radio" name="shuffle-filter" value="cat2" />Dental
				</label>
				<label class="btn">
					<input type="radio" name="shuffle-filter" value="cat3" />Neurology
				</label>
				<label class="btn">
					<input type="radio" name="shuffle-filter" value="cat4" />Medicine
				</label>
				<label class="btn">
					<input type="radio" name="shuffle-filter" value="cat5" />Pediatric
				</label>
				<label class="btn">
					<input type="radio" name="shuffle-filter" value="cat6" />Traumatology
				</label> --}}
			</div>
		</div>

		<div class="row shuffle-wrapper portfolio-gallery">
			@php
				$images = ['1.jpg','2.jpg','3.jpg','4.jpg'];
			@endphp
			@foreach($doctor_list as $key => $row)
				<div class="col-lg-3 col-sm-6 col-md-6 mb-4 shuffle-item" data-groups="[&quot;{{ $row->site_id }}&quot;]">
					<div class="position-relative doctor-inner-box">
						<div class="doctor-profile">
							<div class="doctor-img">
								<img src="{{ $row->employe_img }}" alt="doctor-image" class="img-fluid w-100">
							</div>
						</div>
						<div class="content mt-3">
							<h4 class="mb-0"><a href="{{ route('doctor.details',[$row->emp_id]) }}">{{ $row->emp_fname }} {{ $row->emp_sname }}</a></h4>
							<p>{{ $row->site->site_nm }}</p>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</section>
<!-- /portfolio -->
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