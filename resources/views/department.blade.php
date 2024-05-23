@extends('layouts.app')
@section('title')
Department
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
					<span class="text-white">All Department</span>
					<h1 class="text-capitalize mb-5 text-lg">Care Department</h1>

					<!-- <ul class="list-inline breadcumb-nav">
			  <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
			  <li class="list-inline-item"><span class="text-white">/</span></li>
			  <li class="list-inline-item"><a href="#" class="text-white-50">All Department</a></li>
			</ul> -->
				</div>
			</div>
		</div>
	</div>
</section>


<section class="section service-2">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 text-center">
				<div class="section-title">
					<h2>Award winning patient care</h2>
					<div class="divider mx-auto my-4"></div>
					<p> Recognized for excellence, our dedicated team ensures compassionate, high-quality care, prioritizing your well-being and satisfaction above all else.</p>
				</div>
			</div>
		</div>

		<div class="row">
			@foreach($department_list as $key => $row)
				<div class="col-lg-4 col-md-6 ">
					<div class="department-block mb-5">
						<img src="{{ asset('website/images/service/'.$row->site_image) }}" alt="" class="img-fluid w-100">
						<div class="content">
							<h4 class="mt-4 mb-2 title-color">{{ $row->site_nm }}</h4>
							<p class="mb-4">{{ $row->site_short_desc }}</p>
							<a href="{{ route('department.details',[$row->site_id]) }}" class="read-more">Learn More <i
									class="icofont-simple-right ml-2"></i></a>
						</div>
					</div>
				</div>
			@endforeach
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