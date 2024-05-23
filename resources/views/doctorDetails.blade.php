@extends('layouts.app')
@section('title')
Doctor Details
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
					<span class="text-white">Doctor Details</span>
					<h1 class="text-capitalize mb-5 text-lg">{{ $doctor->emp_fname }} {{ $doctor->emp_sname }}</h1>

					<!-- <ul class="list-inline breadcumb-nav">
			  <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
			  <li class="list-inline-item"><span class="text-white">/</span></li>
			  <li class="list-inline-item"><a href="#" class="text-white-50">Doctor Details</a></li>
			</ul> -->
				</div>
			</div>
		</div>
	</div>
</section>


<section class="section doctor-single">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6">
				<div class="doctor-img-block">
					@php
						$images = ['1.jpg','2.jpg','3.jpg','4.jpg'];
					@endphp
					<img src="{{ $doctor->employe_img }}" alt="" class="img-fluid w-100">

					<div class="info-block mt-4">
						<h4 class="mb-0">{{ $doctor->emp_fname }} {{ $doctor->emp_sname }}</h4>
						<p>{{ $doctor->site->site_nm }}</p>

						<ul class="list-inline mt-4 doctor-social-links">
							<li class="list-inline-item"><a href="#"><i class="icofont-facebook"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="icofont-twitter"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="icofont-skype"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="icofont-linkedin"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="icofont-pinterest"></i></a></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-lg-8 col-md-6">
				<div class="doctor-details mt-4 mt-lg-0">
					<h2 class="text-md">Introducing to myself</h2>
					<div class="divider my-4"></div>
					<p>{{ $doctor->employe_intro }}</p>
					<a href="{{ route('appoinment') }}" class="btn btn-main-2 btn-round-full mt-3">Make an Appoinment<i
							class="icofont-simple-right ml-2  "></i></a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section doctor-qualification gray-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="section-title">
					<h3>My Educational Qualifications</h3>
					<div class="divider my-4"></div>
				</div>
			</div>
		</div>

		<div class="row">
			@foreach ($qualification as $item)
				<div class="col-lg-6">
					<div class="edu-block mb-5">
						@if ($item->degree_start_year != '')
							<span class="h6 text-muted">Year({{ $item->degree_start_year }}-{{ $item->degree_end_year }}) </span>
						@endif
						<h4 class="mb-3 title-color">{{ $item->degree_name }}</h4>
						<p>{{ $item->degree_intro }}</p>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</section>


<section class="section doctor-skills">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				{{-- <h5 class="divider my-4">My skills</h5> --}}
				<h5>My skills</h5>
				<div class="divider" style="margin-bottom:5px;"></div>
				<p>{{ $doctor->employe_skills }}</p>
			</div>
			<div class="col-lg-4">
				<div class="skill-list">
					<h5 class="mb-4">Expertise area</h5>
					<ul class="list-unstyled department-service">
						<li><i class="icofont-check mr-2"></i>International Drug Database</li>
						<li><i class="icofont-check mr-2"></i>Stretchers and Stretcher Accessories</li>
						<li><i class="icofont-check mr-2"></i>Cushions and Mattresses</li>
						<li><i class="icofont-check mr-2"></i>Cholesterol and lipid tests</li>
						<li><i class="icofont-check mr-2"></i>Critical Care Medicine Specialists</li>
						<li><i class="icofont-check mr-2"></i>Emergency Assistance</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="sidebar-widget  gray-bg p-4">
					<h5 class="mb-4">Make Appoinment</h5>

					<ul class="list-unstyled lh-35">
						<li class="d-flex justify-content-between align-items-center">
							<a href="#">Monday - Friday</a>
							<span>8:00 - 17:00</span>
						</li>
						<li class="d-flex justify-content-between align-items-center">
							<a href="#">Saturday</a>
							<span>9:00 - 17:00</span>
						</li>
						<li class="d-flex justify-content-between align-items-center">
							<a href="#">Sunday</a>
							<span>10:00 - 17:00</span>
						</li>
					</ul>

					<div class="sidebar-contatct-info mt-4">
						<p class="mb-0">Need Urgent Help?</p>
						<h3 class="text-color-2">+083-3607-0583</h3>
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
<script type="text/javascript">

</script>
@endpush