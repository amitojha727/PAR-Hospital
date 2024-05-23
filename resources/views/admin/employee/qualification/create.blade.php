@extends('admin.layouts.app')

@section('title')
Qualification {{ isset($id) ? 'Update' : 'Add' }}
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
		<h1 class="m-0">{{ isset($id) ? 'Update' : 'Add' }} Qualification</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
		  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		  <li class="breadcrumb-item"><a href="{{ route('admin.employees') }}">Doctors</a></li>
          <li class="breadcrumb-item"><a href="{{ isset($id) ? route('admin.employee.qualification',['employee_id' => $employee_id]) : route('admin.employee.qualification',['employee_id' => $employee_id]) }}">Qualification</a></li>
		  <li class="breadcrumb-item">{{ isset($id) ? 'Update' : 'Add' }}</li>
		</ol>
	</div>
@endsection
@section('content')
      <!-- Counts Section -->
    <div class="container-fluid">
        <div class="row" style="background-color:#FFFFFF;">
			<div class="col-md-12">
				<form method="POST" action="{{ isset($id) ? route('admin.qualification.update',[$id]) : route('admin.employee.add.qualification.post') }}" enctype="multipart/form-data">
                @csrf
				<div style="box-shadow:0px 0px 10px 0px rgb(200,200,200); padding:10px 10px; position:relative;">
					<div class="row">
						<div class="col-md-6">
                            <input type="hidden" name="emp_id" value="{{ $employee_id }}">
							<div class="form-group">       
								<label>Degree Name : </label>
								<input name="degree_name" id="degree_name" class="form-control" placeholder="Enter first name" value="{{ isset($id) ? $qualification_details->degree_name : old('degree_name') }}">
								@if ($errors->has('degree_name'))
								<div class="text-danger">
									{{ $errors->first('degree_name') }}
								</div>
								@endif
							</div>
							<div class="form-group">       
								<label>Degree Start Year : </label>
								<input name="degree_start_year" id="degree_start_year" class="form-control" placeholder="Enter last name" value="{{ isset($id) ? $qualification_details->degree_start_year : old('degree_start_year') }}">
								@if ($errors->has('degree_start_year'))
								<div class="text-danger">
									{{ $errors->first('degree_start_year') }}
								</div>
								@endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">       
								<label>Introduction : </label>
								<textarea name="degree_intro" id="degree_intro" class="form-control" placeholder="Enter description" rows="1">{{ isset($id) ? $qualification_details->degree_intro : old('degree_intro') }}</textarea>
								@if ($errors->has('degree_intro'))
								<div class="text-danger">
									{{ $errors->first('degree_intro') }}
								</div>
								@endif
							</div>
                            <div class="form-group">       
								<label>Degree End Year : </label>
								<input name="degree_end_year" id="degree_end_year" class="form-control" placeholder="Enter last name" value="{{ isset($id) ? $qualification_details->degree_end_year : old('degree_end_year') }}">
								@if ($errors->has('degree_end_year'))
								<div class="text-danger">
									{{ $errors->first('degree_end_year') }}
								</div>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div style="margin-top:20px; margin-bottom:100px;" align="center">
					<button type="submit" class="btn btn-success">{{ isset($id) ? 'Update' : 'Submit' }}</button>
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
  