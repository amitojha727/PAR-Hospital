@extends('layouts.app')
@section('title')
appoinment
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
					<span class="text-white">Book your Seat</span>
					<h1 class="text-capitalize mb-5 text-lg">Appoinment</h1>

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
					<h2 class="text-color mt-3">+83-3607-0583</h2>
				</div>
			</div>

			<div class="col-lg-8">
				<div class="appoinment-wrap mt-5 mt-lg-0 pl-lg-5">
					@include('include.appoinmentForm')
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
	function searchDoctor(data) {
        var site_id = $(data).val();
        //console.log(x);
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: "{{ route('web.appointment.doctor') }}",
            method:"POST",
            data: {
                site_id: site_id,
                _token:csrf_token
            },
            dataType:"json",
            success: function(msg){
                $('#emp_id').html(msg.output);
                console.log(msg);

            },
        });
    }
</script>
@endpush