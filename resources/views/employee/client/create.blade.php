@extends('admin.layouts.app')

@section('title')
Patient add
@endsection
@section('style')
<style>
	.dataTables_filter, .dataTables_info { display: none; }
</style>
@endsection
@push('head-script')
	
@endpush
@section('sub-header')
	<div class="col-sm-6">
		<h1 class="m-0">{{ isset($client_id) ? 'Update' : 'Add' }} Patient</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
		  <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Dashboard</a></li>
		  <li class="breadcrumb-item"><a href="{{ route('employee.clients') }}">Patients</a></li>
		  <li class="breadcrumb-item">{{ isset($client_id) ? 'Update' : 'Add' }}</li>
		</ol>
	</div>
@endsection
@section('content')
      <!-- Counts Section -->
    <div class="container-fluid">
        <div class="row" style="background-color:#FFFFFF;">
			<div class="col-md-12">
				<form method="POST" action="{{ isset($client_id) ? route('employee.clientUpdate',[$client_id]) : route('employee.clientStore') }}" enctype="multipart/form-data">
                @csrf
				<div style="box-shadow:0px 0px 10px 0px rgb(200,200,200); padding:10px 10px; position:relative;">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">       
								<label>First Name : </label>
								<input name="client_fname" id="client_fname" class="form-control" placeholder="Enter first name" value="{{ isset($client_id) ? $client_details->client_fname : old('client_fname') }}">
								@if ($errors->has('client_fname'))
								<div class="text-danger">
									{{ $errors->first('client_fname') }}
								</div>
								@endif
							</div>
							<div class="form-group">       
								<label>Last Name : </label>
								<input name="client_sname" id="client_sname" class="form-control" placeholder="Enter last name" value="{{ isset($client_id) ? $client_details->client_sname : old('client_sname') }}">
								@if ($errors->has('client_sname'))
								<div class="text-danger">
									{{ $errors->first('client_sname') }}
								</div>
								@endif
							</div>
							<div class="form-group">       
								<label>Contact Number : </label>
								<input name="client_contact_no" id="client_contact_no" class="form-control" placeholder="Enter last name" value="{{ isset($client_id) ? $client_details->client_contact_no : old('client_contact_no') }}">
								@if ($errors->has('client_contact_no'))
								<div class="text-danger">
									{{ $errors->first('client_contact_no') }}
								</div>
								@endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Disease : </label>
								<input name="client_disease" id="client_disease" class="form-control" placeholder="Enter last name" value="{{ isset($client_id) ? $client_details->client_disease : old('client_disease') }}">
								@if ($errors->has('client_disease'))
								<div class="text-danger">
									{{ $errors->first('client_disease') }}
								</div>
								@endif
							</div>
							<div class="form-group">
								<label>Date of Admission : </label>
								<input type="date" name="client_admission_date" id="client_admission_date" class="form-control" placeholder="Enter last name" value="{{ isset($client_id) ? $client_details->client_admission_date : old('client_admission_date') }}">
								@if ($errors->has('client_admission_date'))
								<div class="text-danger">
									{{ $errors->first('client_admission_date') }}
								</div>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div style="margin-top:20px; margin-bottom:100px;" align="center">
					<button type="submit" class="btn btn-success">{{ isset($client_id) ? 'Update' : 'Submit' }}</button>
				</div>
				</form>
			</div>
        </div>
    </div>
@endsection

@push('scripts')
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
@endpush
  