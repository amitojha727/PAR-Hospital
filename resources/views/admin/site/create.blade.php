@extends('admin.layouts.app')

@section('title')
Department add
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
		<h1 class="m-0">{{ isset($site_id) ? 'Update' : 'Add' }} Department</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
		  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		  <li class="breadcrumb-item"><a href="{{ route('admin.sites') }}">Departments</a></li>
		  <li class="breadcrumb-item">{{ isset($site_id) ? 'Update' : 'Add' }}</li>
		</ol>
	</div>
@endsection
@section('content')
      <!-- Counts Section -->
    <div class="container-fluid">
        <div class="row" style="background-color:#FFFFFF;">
			<div class="col-md-12">
				<form method="POST" action="{{ isset($site_id) ? route('admin.siteUpdate',[$site_id]) : route('admin.siteStore') }}" enctype="multipart/form-data">
                @csrf
				<div style="box-shadow:0px 0px 10px 0px rgb(200,200,200); padding:10px 10px; position:relative;">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">       
								<label>Department Name : </label>
								<input name="site_nm" id="site_nm" class="form-control" placeholder="Enter department name" value="{{ isset($site_id) ? $site_details->site_nm : old('site_nm') }}">
								@if ($errors->has('site_nm'))
								<div class="text-danger">
									{{ $errors->first('site_nm') }}
								</div>
								@endif
							</div>
							<div class="form-group" style="margin-top: 27px;">       
								<label>Short Description : </label>
								<input type="text" name="site_short_desc" id="site_short_desc" class="form-control" placeholder="Enter short description" value="{{ isset($site_id) ? $site_details->site_short_desc : old('site_short_desc') }}">
								@if ($errors->has('site_short_desc'))
								<div class="text-danger">
									{{ $errors->first('site_short_desc') }}
								</div>
								@endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">       
								<label>Description : </label>
								<textarea name="site_desc" id="site_desc" class="form-control" placeholder="Enter description" rows="5">{{ isset($site_id) ? $site_details->site_desc : old('site_desc') }}</textarea>
								@if ($errors->has('site_desc'))
								<div class="text-danger">
									{{ $errors->first('site_desc') }}
								</div>
								@endif
							</div>
						</div>
					</div>					
				</div>
				<div style="margin-top:20px; margin-bottom:100px;" align="center">
					<button type="submit" class="btn btn-success">{{ isset($site_id) ? 'Update' : 'Submit' }}</button>
				</div>
				</form>
			</div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
  