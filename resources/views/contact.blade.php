@extends('layouts.app')
@section('title')
contact
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
					<span class="text-white">Contact Us</span>
					<h1 class="text-capitalize mb-5 text-lg">Get in Touch</h1>

					<!-- <ul class="list-inline breadcumb-nav">
			  <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
			  <li class="list-inline-item"><span class="text-white">/</span></li>
			  <li class="list-inline-item"><a href="#" class="text-white-50">Contact Us</a></li>
			</ul> -->
				</div>
			</div>
		</div>
	</div>
</section>
<!-- contact form start -->

<section class="section contact-info pb-0">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-sm-6 col-md-6">
				<div class="contact-block mb-4 mb-lg-0">
					<i class="icofont-live-support"></i>
					<h5>Call Us</h5>
					+083-3607-0583
				</div>
			</div>
			<div class="col-lg-4 col-sm-6 col-md-6">
				<div class="contact-block mb-4 mb-lg-0">
					<i class="icofont-support-faq"></i>
					<h5>Email Us</h5>
					contact@gmail.com
				</div>
			</div>
			<div class="col-lg-4 col-sm-6 col-md-6">
				<div class="contact-block mb-4 mb-lg-0">
					<i class="icofont-location-pin"></i>
					<h5>Location</h5>
					Barol-Malimpur, Hooghly, West Bengal.
				</div>
			</div>
		</div>
	</div>
</section>

<section class="contact-form-wrap section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<div class="section-title text-center">
					<h2 class="text-md mb-2">Contact us</h2>
					<div class="divider mx-auto my-4"></div>
					<p class="mb-5">"Need assistance? Contact us for support, inquiries, or feedback. We're here to help!"</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<form id="contact-form" class="contact__form " method="post" action="{{ route('web.contact.add') }}">
					@csrf
					<!-- form message -->
					<div class="row">
						<div class="col-12">
							<div class="alert alert-success contact__msg" style="display: none" role="alert">
								Your message was sent successfully.
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<input name="name" id="name" type="text" class="form-control" placeholder="Your Full Name">
								@if ($errors->has('name'))
									<div class="text-danger">
										{{ $errors->first('name') }}
									</div>
								@endif
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<input name="email_address" id="email" type="email" class="form-control" placeholder="Your Email Address">
								@if ($errors->has('email_address'))
									<div class="text-danger">
										{{ $errors->first('email_address') }}
									</div>
								@endif
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<input name="query_topic" id="subject" type="text" class="form-control" placeholder="Your Query Topic">
								@if ($errors->has('query_topic'))
									<div class="text-danger">
										{{ $errors->first('query_topic') }}
									</div>
								@endif
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<input name="contact_number" id="phone" type="text" class="form-control" placeholder="Your Phone Number">
								@if ($errors->has('contact_number'))
									<div class="text-danger">
										{{ $errors->first('contact_number') }}
									</div>
								@endif
							</div>
						</div>
					</div>

					<div class="form-group-2 mb-4">
						<textarea name="message" id="message" class="form-control" rows="8" placeholder="Your Message"></textarea>
					</div>

					<div class="text-center">
						<button class="btn btn-main btn-round-full" type="submit">Send Messege</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>


<div class="google-map ">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3674.0477088219905!2d88.35199767476807!3d22.94847001909054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f89250a79aa925%3A0xc6e131b8eb71dfdd!2sModern%20Institute%20of%20Engineering%20%26%20Technology!5e0!3m2!1sen!2sin!4v1715610925745!5m2!1sen!2sin" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
@section('model')

@endsection
@endsection

@push('scripts')
<script type="text/javascript">

</script>
@endpush