@extends('layouts.app')
@section('title')
about
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
					<span class="text-white">About Us</span>
					<h1 class="text-capitalize mb-5 text-lg">About Us</h1>

					<!-- <ul class="list-inline breadcumb-nav">
			  <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
			  <li class="list-inline-item"><span class="text-white">/</span></li>
			  <li class="list-inline-item"><a href="#" class="text-white-50">About Us</a></li>
			</ul> -->
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section about-page">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<h2 class="title-color">Personal care for your healthy living</h2>
			</div>
			<div class="col-lg-8">
				<p>Our commitment is to provide individualized support and guidance to help you achieve optimal health and wellness.
					From tailored nutrition plans to holistic lifestyle recommendations, 
					we're dedicated to empowering you on your journey to a healthier, happier life.</p>
				{{-- <img src="{{ asset('website/images/about/sign.png') }}" alt="" class="img-fluid"> --}}
			</div>
		</div>
	</div>
</section>

<section class="fetaure-page ">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="about-block-item mb-5 mb-lg-0">
					<img src="{{ asset('website/images/about/about-1.jpg') }}" alt="" class="img-fluid w-100">
					<h4 class="mt-3">Healthcare for Kids</h4>
					<p>Expert pediatric care ensuring your child's health and happiness, delivered with compassion and expertise.</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="about-block-item mb-5 mb-lg-0">
					<img src="{{ asset('website/images/about/about-2.jpg') }}" alt="" class="img-fluid w-100">
					<h4 class="mt-3">Medical Counseling</h4>
					<p>Expert guidance for your health journey. Empowering you to make informed decisions and achieve optimal well-being.</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="about-block-item mb-5 mb-lg-0">
					<img src="{{ asset('website/images/about/about-3.jpg') }}" alt="" class="img-fluid w-100">
					<h4 class="mt-3">Modern Equipments</h4>
					<p>Cutting-edge technology ensures precise diagnostics and effective treatments for superior healthcare outcomes.</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="about-block-item">
					<img src="{{ asset('website/images/about/about-4.jpg') }}" alt="" class="img-fluid w-100">
					<h4 class="mt-3">Qualified Doctors</h4>
					<p>Our team comprises skilled professionals committed to delivering expert medical care tailored to your unique needs.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section team">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<div class="section-title text-center">
					<h2 class="mb-4">Meet Our Team</h2>
					<div class="divider mx-auto my-4"></div>
					<p>Meet the skilled individuals behind our innovative solutions, committed to bringing excellence to every aspect of our work.</p>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="team-block mb-5 mb-lg-0">
					<img src="{{ asset('website/images/team/abantika.jpg') }}" alt="" class="img-fluid w-100">

					<div class="content">
						<h4 class="mt-4 mb-0">Abantika Paul</h4>
						<p>Full Stack Developer</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="team-block mb-5 mb-lg-0">
					<img src="{{ asset('website/images/team/amit.jpg') }}" alt="" class="img-fluid w-100">

					<div class="content">
						<h4 class="mt-4 mb-0">Amit Kumar Ojha</h4>
						<p>Backend Developer</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="team-block mb-5 mb-lg-0">
					<img src="{{ asset('website/images/team/maoumaa.jpg') }}" alt="" class="img-fluid w-100">

					<div class="content">
						<h4 class="mt-4 mb-0">Maoumaa Dutta</h4>
						<p>Backend Developer</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="team-block mb-5 mb-lg-0">
					<img src="{{ asset('website/images/team/sanjana.jpg') }}" alt="" class="img-fluid w-100">

					<div class="content">
						<h4 class="mt-4 mb-0">Sanjana Deb</h4>
						<p>Backend Developer</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6"></div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="team-block mb-5 mb-lg-0">
					<img src="{{ asset('website/images/team/isha.jpg') }}" alt="" class="img-fluid w-100">

					<div class="content">
						<h4 class="mt-4 mb-0">Isha Ghosh</h4>
						<p>Frontend Developer</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="team-block">
					<img src="{{ asset('website/images/team/angana.jpg') }}" alt="" class="img-fluid w-100">

					<div class="content">
						<h4 class="mt-4 mb-0">Angana Patra</h4>
						<p>Frontend Developer</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section testimonial">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 offset-lg-6">
				<div class="section-title">
					<h2 class="mb-4">What they say about us</h2>
					<div class="divider  my-4"></div>
				</div>
			</div>
		</div>
		<div class="row align-items-center">
			<div class="col-lg-6 testimonial-wrap offset-lg-6">
				<div class="testimonial-block">
					<div class="client-info ">
						<h4>Amazing service!</h4>
						<span>John Partho</span>
					</div>
					<p>
						"Their services is amazing because we consistently exceed expectations, provide exceptional care, and prioritize customer satisfaction above all else."
					</p>
					<i class="icofont-quote-right"></i>

				</div>

				<div class="testimonial-block">
					<div class="client-info">
						<h4>Expert doctors!</h4>
						<span>Mullar Sarth</span>
					</div>
					<p>
						Renowned professionals with extensive experience and specialized expertise, providing top-notch medical care and guidance for optimal health outcomes.
					</p>
					<i class="icofont-quote-right"></i>
				</div>

				<div class="testimonial-block">
					<div class="client-info">
						<h4>Good Support!</h4>
						<span>Kolis Mullar</span>
					</div>
					<p>
						"They provide excellent support, always responsive and helpful, ensuring our needs are met promptly and efficiently, enhancing our experience."
					</p>
					<i class="icofont-quote-right"></i>
				</div>

				<div class="testimonial-block">
					<div class="client-info">
						<h4>Nice Environment!</h4>
						<span>Partho Sarothi</span>
					</div>
					<p>
						"They create a nice environment." This suggests that the atmosphere they provide is pleasant, comfortable, and conducive to positive interactions, fostering a sense of well-being and satisfaction among those involved.
					</p>
					<i class="icofont-quote-right"></i>
				</div>

				<div class="testimonial-block">
					<div class="client-info">
						<h4>Modern Service!</h4>
						<span>Kolis Mullar</span>
					</div>
					<p>
						"They provide modern service, we appreciate the innovative and up-to-date approach the company offers, ensuring convenience, efficiency, and relevance in meeting their needs.
					</p>
					<i class="icofont-quote-right"></i>
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