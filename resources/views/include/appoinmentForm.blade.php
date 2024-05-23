<h2 class="mb-2 title-color">Book appointment</h2>
<p class="mb-4">Easily schedule your healthcare visits online for convenient, timely access to medical professionals. Your health, your schedule.</p>
<form class="appoinment-form" method="post" action="{{ route('web.appointment.add') }}">
	@csrf
	<div class="row">
		<div class="col-lg-6">
			<div class="form-group">
				@php
					$department_list = App\Models\Site::select('site_id','site_nm')->get();
				@endphp
				<select class="form-control" id="exampleFormControlSelect1" name="site_id" onchange="searchDoctor(this)">
					<option value="">Choose Department</option>
					@foreach ($department_list as $row)
						<option value="{{ $row->site_id }}">{{ $row->site_nm }}</option>
					@endforeach
				</select>
				@if ($errors->has('site_id'))
					<div class="text-danger">
						{{ $errors->first('site_id') }}
					</div>
				@endif
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<select class="form-control" id="emp_id" name="emp_id">
				<option value="">Select Doctor</option>
				</select>
				@if ($errors->has('emp_id'))
					<div class="text-danger">
						{{ $errors->first('emp_id') }}
					</div>
				@endif
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<input name="appoinment_date" id="date" type="text" class="form-control" placeholder="dd/mm/yyyy">
				@if ($errors->has('appoinment_date'))
					<div class="text-danger">
						{{ $errors->first('appoinment_date') }}
					</div>
				@endif
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<input name="appoinment_time" id="time" type="text" class="form-control" placeholder="Time">
				@if ($errors->has('appoinment_time'))
					<div class="text-danger">
						{{ $errors->first('appoinment_time') }}
					</div>
				@endif
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<input name="applicant_name" id="name" type="text" class="form-control" placeholder="Full Name">
				@if ($errors->has('applicant_name'))
					<div class="text-danger">
						{{ $errors->first('applicant_name') }}
					</div>
				@endif
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<input name="applicant_contact_number" id="phone" type="Number" class="form-control" placeholder="Phone Number">
				@if ($errors->has('applicant_contact_number'))
					<div class="text-danger">
						{{ $errors->first('applicant_contact_number') }}
					</div>
				@endif
			</div>
		</div>
	</div>
	<div class="form-group-2 mb-4">
		<textarea name="message" id="message" class="form-control" rows="6" placeholder="Your Message"></textarea>
	</div>
	<button class="btn btn-main btn-round-full" type="submit" >Make Appoinment <i class="icofont-simple-right ml-2  "></i></button>
</form>