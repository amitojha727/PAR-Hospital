@extends('admin.layouts.app')

@section('title')
	Doctors add
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
		<h1 class="m-0">{{ isset($employee_id) ? 'Update' : 'Add' }} Doctor</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
		  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		  <li class="breadcrumb-item"><a href="{{ route('admin.employees') }}">Doctors</a></li>
		  <li class="breadcrumb-item">{{ isset($employee_id) ? 'Update' : 'Add' }}</li>
		</ol>
	</div>
@endsection
@section('content')
      <!-- Counts Section -->
    <div class="container-fluid">
        <div class="row" style="background-color:#FFFFFF;">
			<div class="col-md-12">
				<form method="POST" action="{{ isset($employee_id) ? route('admin.employeeUpdate',[$employee_id]) : route('admin.employeeStore') }}" enctype="multipart/form-data">
                @csrf
				<div style="box-shadow:0px 0px 10px 0px rgb(200,200,200); padding:10px 10px; position:relative;">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">       
								<label>Department : </label>
								<select name="site_id" id="site_id" class="form-control">
									<option value="">Select Department</option>
									@foreach($site_details as $row)
										<option value="{{ $row->site_id }}" {{ isset($employee_id) ? ($employee_details->site_id == $row->site_id ? 'selected' : '') : (old('site_id') == $row->site_id ? 'selected' : '') }}>{{ $row->site_nm }}</option>
									@endforeach
								</select>
								@if ($errors->has('site_id'))
								<div class="text-danger">
									{{ $errors->first('site_id') }}
								</div>
								@endif
							</div>
							<div class="form-group">       
								<label>First Name : </label>
								<input name="emp_fname" id="emp_fname" class="form-control" placeholder="Enter first name" value="{{ isset($employee_id) ? $employee_details->emp_fname : old('emp_fname') }}">
								@if ($errors->has('emp_fname'))
								<div class="text-danger">
									{{ $errors->first('emp_fname') }}
								</div>
								@endif
							</div>
							<div class="form-group">       
								<label>Last Name : </label>
								<input name="emp_sname" id="emp_sname" class="form-control" placeholder="Enter last name" value="{{ isset($employee_id) ? $employee_details->emp_sname : old('emp_sname') }}">
								@if ($errors->has('emp_sname'))
								<div class="text-danger">
									{{ $errors->first('emp_sname') }}
								</div>
								@endif
							</div>
							<div class="form-group">       
								<label>Profile Picture : </label>
								<input type="file" name="employe_img" id="employe_img" class="form-control" placeholder="Enter Profile Picture" accept="image/*" value="{{ isset($employee_id) ? $employee_details->employe_img : old('employe_img') }}">
								@if ($errors->has('employe_img'))
								<div class="text-danger">
									{{ $errors->first('employe_img') }}
								</div>
								@endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">       
								<label>Introduction : </label>
								<textarea name="employe_intro" id="employe_intro" class="form-control" placeholder="Enter description" rows="1">{{ isset($employee_id) ? $employee_details->employe_intro : old('employe_intro') }}</textarea>
								@if ($errors->has('employe_intro'))
								<div class="text-danger">
									{{ $errors->first('employe_intro') }}
								</div>
								@endif
							</div>
							<div class="form-group">       
								<label>skills : </label>
								<textarea name="employe_skills" id="employe_skills" class="form-control" placeholder="Enter description" rows="1">{{ isset($employee_id) ? $employee_details->employe_skills : old('employe_skills') }}</textarea>
								@if ($errors->has('employe_skills'))
								<div class="text-danger">
									{{ $errors->first('employe_skills') }}
								</div>
								@endif
							</div>
							<div class="form-group">       
								<label>User Id : </label>
								<input name="emp_user_id" id="emp_user_id" class="form-control" placeholder="Enter user id" value="{{ isset($employee_id) ? $employee_details->emp_user_id : old('emp_user_id') }}">
								@if ($errors->has('emp_user_id'))
								<div class="text-danger">
									{{ $errors->first('emp_user_id') }}
								</div>
								@endif
							</div>
							@if(!isset($employee_id))
							<div class="form-group">       
								<label>Password : </label>
								<input type="password" name="password" id="password" class="form-control" placeholder="Enter passward" value="{{ isset($employee_id) ? $employee_details->password : old('password') }}">
								@if ($errors->has('password'))
								<div class="text-danger">
									{{ $errors->first('password') }}
								</div>
								@endif
							</div>
							@endif
						</div>
					</div>
				</div>
				<div style="margin-top:20px; margin-bottom:100px;" align="center">
					<button type="submit" class="btn btn-success">{{ isset($employee_id) ? 'Update' : 'Submit' }}</button>
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
  