@extends('admin.layouts.app')

@section('title')
Patient {{ isset($form_id) ? 'Update' : 'Add' }} form
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
		<h1 class="m-0">{{ $client_details->client_fname }} {{ $client_details->client_sname }}</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
		  <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Dashboard</a></li>
		  <li class="breadcrumb-item"><a href="{{ route('employee.clients') }}">Patients</a></li>
		  @if(isset($form_id))
		  <li class="breadcrumb-item"><a href="{{ route('employee.client.viewDetails',['client_id' => $client_id]) }}">View Form</a></li>
		  @endif
		  <li class="breadcrumb-item">{{ isset($form_id) ? 'Update' : 'Add' }} Form</li>
		</ol>
	</div>
@endsection
@section('content')
      <!-- Counts Section -->
    <div class="container-fluid">
        <div class="row" style="background-color:#FFFFFF;">
			<div class="col-md-12">
				<form method="POST" action="{{ isset($form_id) ? route('employee.client.updateDetails',[$form_id]) : route('employee.client.storeDetails') }}" enctype="multipart/form-data">
                @csrf
				<input type="hidden" name="client_id" value="{{ $client_details->client_id }}" />
				<div class="form-group">
                  <label>Date:</label>
                    <div class="input-group date" id="date" data-target-input="nearest">
                        <input type="text" name="date" class="form-control datetimepicker-input" data-target="#date" value="{{ isset($form_id) ? $form_details[0]->date : date('d-m-Y') }}"/>
                        <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
					@if ($errors->has('date'))
					<div class="text-danger">
						{{ $errors->first('date') }}
					</div>
					@endif
                </div>
				<!-- Health Status -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-user-md"></i>
							Health Status
						</h3>
					</div>
					<div class="card-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-12">
									<label>Medication :</label>
								</div>
								<div class="col-sm-4">
									<div style="text-align:center;">Morning</div>
									<select name="medi_morning" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($health_details[0]->medi_morning == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($health_details[0]->medi_morning == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($health_details[0]->medi_morning == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($health_details[0]->medi_morning == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($health_details[0]->medi_morning == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('medi_morning'))
									<div class="text-danger">
										{{ $errors->first('medi_morning') }}
									</div>
									@endif
								</div>
								<div class="col-sm-4">
									<div style="text-align:center;">Afternoon</div>
									<select name="medi_afternoon" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($health_details[0]->medi_afternoon == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($health_details[0]->medi_afternoon == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($health_details[0]->medi_afternoon == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($health_details[0]->medi_afternoon == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($health_details[0]->medi_afternoon == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('medi_afternoon'))
									<div class="text-danger">
										{{ $errors->first('medi_afternoon') }}
									</div>
									@endif
								</div>
								<div class="col-sm-4">
									<div style="text-align:center;">Evening</div>
									<select name="medi_evening" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($health_details[0]->medi_evening == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($health_details[0]->medi_evening == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($health_details[0]->medi_evening == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($health_details[0]->medi_evening == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($health_details[0]->medi_evening == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('medi_evening'))
									<div class="text-danger">
										{{ $errors->first('medi_evening') }}
									</div>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<label>Medical Appointment :</label>
								</div>
								<div class="col-sm-4">
									<select name="appo_stat" class="form-control" onchange="appoWith(this.value);">
										<option value="N/A|0" {{ isset($form_id) ? ($health_details[0]->appo_stat == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($health_details[0]->appo_stat == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($health_details[0]->appo_stat == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($health_details[0]->appo_stat == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($health_details[0]->appo_stat == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('appo_stat'))
									<div class="text-danger">
										{{ $errors->first('appo_stat') }}
									</div>
									@endif
								</div>
								<div class="col-sm-4" id="appo_other_show" style="{{ isset($form_id) ? ($health_details[0]->appo_stat == 'N/A' ? 'display:none;' : '') : 'display:none;' }}">
									<input name="appo_other" id="appo_other" class="form-control" placeholder="Enter Other Appointment" value="{{ isset($form_id) ? $health_details[0]->appo_other : old('appo_other') }}">
									@if ($errors->has('appo_other'))
									<div class="text-danger">
										{{ $errors->first('appo_other') }}
									</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Daily Routine -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-user-md"></i>
							Daily Routine
						</h3>
					</div>
					<div class="card-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-12">
									<label>Brushed Teeth :</label>
								</div>
								<div class="col-sm-4">
									<div style="text-align:center;">Morning</div>
									<select name="teeth_morning" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($routine_details[0]->teeth_morning == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($routine_details[0]->teeth_morning == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($routine_details[0]->teeth_morning == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($routine_details[0]->teeth_morning == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($routine_details[0]->teeth_morning == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('teeth_morning'))
									<div class="text-danger">
										{{ $errors->first('teeth_morning') }}
									</div>
									@endif
								</div>
								<div class="col-sm-4">
									<div style="text-align:center;">Evening</div>
									<select name="teeth_evening" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($routine_details[0]->teeth_evening == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($routine_details[0]->teeth_evening == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($routine_details[0]->teeth_evening == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($routine_details[0]->teeth_evening == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($routine_details[0]->teeth_evening == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('teeth_evening'))
									<div class="text-danger">
										{{ $errors->first('teeth_evening') }}
									</div>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<label>Shower :</label>
								</div>
								<div class="col-sm-4">
									<div style="text-align:center;">Morning</div>
									<select name="shower_morning" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($routine_details[0]->shower_morning == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($routine_details[0]->shower_morning == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($routine_details[0]->shower_morning == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($routine_details[0]->shower_morning == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($routine_details[0]->shower_morning == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('shower_morning'))
									<div class="text-danger">
										{{ $errors->first('shower_morning') }}
									</div>
									@endif
								</div>
								<div class="col-sm-4">
									<div style="text-align:center;">Evening</div>
									<select name="shower_evening" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($routine_details[0]->shower_evening == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($routine_details[0]->shower_evening == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($routine_details[0]->shower_evening == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($routine_details[0]->shower_evening == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($routine_details[0]->shower_evening == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('shower_evening'))
									<div class="text-danger">
										{{ $errors->first('shower_evening') }}
									</div>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<label>Made Bed :</label>
								</div>
								<div class="col-sm-4">
									<div style="text-align:center;">Morning</div>
									<select name="bed_morning" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($routine_details[0]->bed_morning == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($routine_details[0]->bed_morning == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($routine_details[0]->bed_morning == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($routine_details[0]->bed_morning == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($routine_details[0]->bed_morning == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('bed_morning'))
									<div class="text-danger">
										{{ $errors->first('bed_morning') }}
									</div>
									@endif
								</div>
								<div class="col-sm-4">
									<div style="text-align:center;">Evening</div>
									<select name="bed_evening" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($routine_details[0]->bed_evening == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($routine_details[0]->bed_evening == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($routine_details[0]->bed_evening == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($routine_details[0]->bed_evening == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($routine_details[0]->bed_evening == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('bed_evening'))
									<div class="text-danger">
										{{ $errors->first('bed_evening') }}
									</div>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<label>Put Dirty Clothes Away :</label>
								</div>
								<div class="col-sm-4">
									<div style="text-align:center;">Morning</div>
									<select name="clothes_morning" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($routine_details[0]->clothes_morning == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($routine_details[0]->clothes_morning == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($routine_details[0]->clothes_morning == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($routine_details[0]->clothes_morning == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($routine_details[0]->clothes_morning == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('clothes_morning'))
									<div class="text-danger">
										{{ $errors->first('clothes_morning') }}
									</div>
									@endif
								</div>
								<div class="col-sm-4">
									<div style="text-align:center;">Evening</div>
									<select name="clothes_evening" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($routine_details[0]->clothes_evening == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($routine_details[0]->clothes_evening == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($routine_details[0]->clothes_evening == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($routine_details[0]->clothes_evening == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($routine_details[0]->clothes_evening == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('clothes_evening'))
									<div class="text-danger">
										{{ $errors->first('clothes_evening') }}
									</div>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<label>Cleared Bedroom Floor :</label>
								</div>
								<div class="col-sm-4">
									<div style="text-align:center;">Morning</div>
									<select name="floor_morning" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($routine_details[0]->floor_morning == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($routine_details[0]->floor_morning == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($routine_details[0]->floor_morning == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($routine_details[0]->floor_morning == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($routine_details[0]->floor_morning == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('floor_morning'))
									<div class="text-danger">
										{{ $errors->first('floor_morning') }}
									</div>
									@endif
								</div>
								<div class="col-sm-4">
									<div style="text-align:center;">Evening</div>
									<select name="floor_evening" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($routine_details[0]->floor_evening == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($routine_details[0]->floor_evening == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($routine_details[0]->floor_evening == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($routine_details[0]->floor_evening == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($routine_details[0]->floor_evening == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('floor_evening'))
									<div class="text-danger">
										{{ $errors->first('floor_evening') }}
									</div>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<label>Went to Bed at Bedtime :</label>
								</div>
								<div class="col-sm-4">
									<div style="text-align:center;">Evening</div>
									<select name="bedtime_evening" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($routine_details[0]->bedtime_evening == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($routine_details[0]->bedtime_evening == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($routine_details[0]->bedtime_evening == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($routine_details[0]->bedtime_evening == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($routine_details[0]->bedtime_evening == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('bedtime_evening'))
									<div class="text-danger">
										{{ $errors->first('bedtime_evening') }}
									</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Social Well-being -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-user-md"></i>
							Social Well-being
						</h3>
					</div>
					<div class="card-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-12">
									<label>School :</label>
								</div>
								<div class="col-sm-4">
									<select name="school_stat" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($social_details[0]->school_stat == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($social_details[0]->school_stat == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($social_details[0]->school_stat == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($social_details[0]->school_stat == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($social_details[0]->school_stat == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('school_stat'))
									<div class="text-danger">
										{{ $errors->first('school_stat') }}
									</div>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<label>Community Outing :</label>
								</div>
								<div class="col-sm-4">
									<select name="community_stat" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($social_details[0]->community_stat == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($social_details[0]->community_stat == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($social_details[0]->community_stat == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($social_details[0]->community_stat == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($social_details[0]->community_stat == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('community_stat'))
									<div class="text-danger">
										{{ $errors->first('community_stat') }}
									</div>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<label>In-House Programs :</label>
								</div>
								<div class="col-sm-4">
									<select name="house_stat" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($social_details[0]->house_stat == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($social_details[0]->house_stat == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($social_details[0]->house_stat == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($social_details[0]->house_stat == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($social_details[0]->house_stat == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('house_stat'))
									<div class="text-danger">
										{{ $errors->first('house_stat') }}
									</div>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<label>Extracurricular Activities :</label>
								</div>
								<div class="col-sm-4">
									<select name="activities_stat" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($social_details[0]->activities_stat == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($social_details[0]->activities_stat == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($social_details[0]->activities_stat == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($social_details[0]->activities_stat == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($social_details[0]->activities_stat == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('activities_stat'))
									<div class="text-danger">
										{{ $errors->first('activities_stat') }}
									</div>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<label>Contact with Family :</label>
								</div>
								<div class="col-sm-4">
									<select name="family_stat" class="form-control" onchange="familyWith(this.value);">
										<option value="N/A|0" {{ isset($form_id) ? ($social_details[0]->family_stat == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($social_details[0]->family_stat == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($social_details[0]->family_stat == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($social_details[0]->family_stat == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($social_details[0]->family_stat == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('family_stat'))
									<div class="text-danger">
										{{ $errors->first('family_stat') }}
									</div>
									@endif
								</div>
								<div class="col-sm-4" id="family_other_show" style="{{ isset($form_id) ? ($social_details[0]->family_stat == 'N/A' ? 'display:none;' : '') : 'display:none;' }}">
									<input name="family_other" id="family_other" class="form-control" placeholder="Enter some text" value="{{ isset($form_id) ? $social_details[0]->family_other : old('family_other') }}">
									@if ($errors->has('family_other'))
									<div class="text-danger">
										{{ $errors->first('family_other') }}
									</div>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<label>Contact with Caseworker :</label>
								</div>
								<div class="col-sm-4">
									<select name="caseworker_stat" class="form-control" onchange="caseworkerWith(this.value);">
										<option value="N/A|0" {{ isset($form_id) ? ($social_details[0]->caseworker_stat == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Refused|-2" {{ isset($form_id) ? ($social_details[0]->caseworker_stat == 'Refused' ? 'selected' : '') : '' }}>Refused (-2)</option>
										<option value="Completed with Difficulty|-1" {{ isset($form_id) ? ($social_details[0]->caseworker_stat == 'Completed with Difficulty' ? 'selected' : '') : '' }}>Completed with Difficulty (-1)</option>
										<option value="Completed with Minor Difficulty|1" {{ isset($form_id) ? ($social_details[0]->caseworker_stat == 'Completed with Minor Difficulty' ? 'selected' : '') : '' }}>Completed with Minor Difficulty (1)</option>
										<option value="Completed Independently|2" {{ isset($form_id) ? ($social_details[0]->caseworker_stat == 'Completed Independently' ? 'selected' : '') : '' }}>Completed Independently (2)</option>
									</select>
									@if ($errors->has('caseworker_stat'))
									<div class="text-danger">
										{{ $errors->first('caseworker_stat') }}
									</div>
									@endif
								</div>
								<div class="col-sm-4" id="caseworker_other_show" style="{{ isset($form_id) ? ($social_details[0]->caseworker_stat == 'N/A' ? 'display:none;' : '') : 'display:none;' }}">
									<input name="caseworker_other" id="caseworker_other" class="form-control" placeholder="Enter Some text" value="{{ isset($form_id) ? $social_details[0]->caseworker_other : old('caseworker_other') }}">
									@if ($errors->has('caseworker_other'))
									<div class="text-danger">
										{{ $errors->first('caseworker_other') }}
									</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- General Observation -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-user-md"></i>
							General Observation
						</h3>
					</div>
					<div class="card-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-12">
									<label>Emotional State :</label>
								</div>
								<div class="col-sm-4">
									<div style="text-align:center;">Morning</div>
									<select name="emotional_morning" class="form-control">
										<option value="Happy|2" {{ isset($form_id) ? ($general_details[0]->emotional_morning == 'Happy' ? 'selected' : '') : '' }}>Happy(2)</option>
										<option value="Stressed|1" {{ isset($form_id) ? ($general_details[0]->emotional_morning == 'Stressed' ? 'selected' : '') : '' }}>Stressed(1)</option>
										<option value="Sad|0" {{ isset($form_id) ? ($general_details[0]->emotional_morning == 'Sad' ? 'selected' : '') : '' }}>Sad(0)</option>
										<option value="Depressed|-2" {{ isset($form_id) ? ($general_details[0]->emotional_morning == 'Depressed' ? 'selected' : '') : '' }}>Depressed (-2)</option>
										<option value="Happy & Sad|1" {{ isset($form_id) ? ($general_details[0]->emotional_morning == 'Happy & Sad' ? 'selected' : '') : '' }}>Happy & Sad (1)</option>
									</select>
									@if ($errors->has('emotional_morning'))
									<div class="text-danger">
										{{ $errors->first('emotional_morning') }}
									</div>
									@endif
								</div>
								<div class="col-sm-4">
									<div style="text-align:center;">Evening</div>
									<select name="emotional_evening" class="form-control">
										<option value="Happy|2" {{ isset($form_id) ? ($general_details[0]->emotional_evening == 'Happy' ? 'selected' : '') : '' }}>Happy(2)</option>
										<option value="Stressed|1" {{ isset($form_id) ? ($general_details[0]->emotional_evening == 'Stressed' ? 'selected' : '') : '' }}>Stressed(1)</option>
										<option value="Sad|0" {{ isset($form_id) ? ($general_details[0]->emotional_evening == 'Sad' ? 'selected' : '') : '' }}>Sad(0)</option>
										<option value="Depressed|-2" {{ isset($form_id) ? ($general_details[0]->emotional_evening == 'Depressed' ? 'selected' : '') : '' }}>Depressed (-2)</option>
										<option value="Happy & Sad|1" {{ isset($form_id) ? ($general_details[0]->emotional_evening == 'Happy & Sad' ? 'selected' : '') : '' }}>Happy & Sad (1)</option>
									</select>
									@if ($errors->has('emotional_evening'))
									<div class="text-danger">
										{{ $errors->first('emotional_evening') }}
									</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Behavior -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-user-md"></i>
							Behavior
						</h3>
					</div>
					<div class="card-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-12">
									<label>Followed Rules :</label>
								</div>
								<div class="col-sm-4">
									<select name="rule_stat" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($behavior_details[0]->rule_stat == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Needs Improvement|-1" {{ isset($form_id) ? ($behavior_details[0]->rule_stat == 'Needs Improvement' ? 'selected' : '') : '' }}>Needs Improvement (-1)</option>
										<option value="Fair|1" {{ isset($form_id) ? ($behavior_details[0]->rule_stat == 'Fair' ? 'selected' : '') : '' }}>Fair(1)</option>
										<option value="Good|2" {{ isset($form_id) ? ($behavior_details[0]->rule_stat == 'Good' ? 'selected' : '') : '' }}>Good(2)</option>
										<option value="Excellent|3" {{ isset($form_id) ? ($behavior_details[0]->rule_stat == 'Excellent' ? 'selected' : '') : '' }}>Excellent(3)</option>
									</select>
									@if ($errors->has('rule_stat'))
									<div class="text-danger">
										{{ $errors->first('rule_stat') }}
									</div>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<label>Listened to Instructions :</label>
								</div>
								<div class="col-sm-4">
									<select name="instruction_stat" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($behavior_details[0]->instruction_stat == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Needs Improvement|-1" {{ isset($form_id) ? ($behavior_details[0]->instruction_stat == 'Needs Improvement' ? 'selected' : '') : '' }}>Needs Improvement (-1)</option>
										<option value="Fair|1" {{ isset($form_id) ? ($behavior_details[0]->instruction_stat == 'Fair' ? 'selected' : '') : '' }}>Fair(1)</option>
										<option value="Good|2" {{ isset($form_id) ? ($behavior_details[0]->instruction_stat == 'Good' ? 'selected' : '') : '' }}>Good(2)</option>
										<option value="Excellent|3" {{ isset($form_id) ? ($behavior_details[0]->instruction_stat == 'Excellent' ? 'selected' : '') : '' }}>Excellent(3)</option>
									</select>
									@if ($errors->has('instruction_stat'))
									<div class="text-danger">
										{{ $errors->first('instruction_stat') }}
									</div>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<label>Able to Control Behavior :</label>
								</div>
								<div class="col-sm-4">
									<select name="behavior_stat" class="form-control">
										<option value="N/A|0" {{ isset($form_id) ? ($behavior_details[0]->behavior_stat == 'N/A' ? 'selected' : '') : '' }}>N/A (0)</option>
										<option value="Needs Improvement|-1" {{ isset($form_id) ? ($behavior_details[0]->behavior_stat == 'Needs Improvement' ? 'selected' : '') : '' }}>Needs Improvement (-1)</option>
										<option value="Fair|1" {{ isset($form_id) ? ($behavior_details[0]->behavior_stat == 'Fair' ? 'selected' : '') : '' }}>Fair(1)</option>
										<option value="Good|2" {{ isset($form_id) ? ($behavior_details[0]->behavior_stat == 'Good' ? 'selected' : '') : '' }}>Good(2)</option>
										<option value="Excellent|3" {{ isset($form_id) ? ($behavior_details[0]->behavior_stat == 'Excellent' ? 'selected' : '') : '' }}>Excellent(3)</option>
									</select>
									@if ($errors->has('behavior_stat'))
									<div class="text-danger">
										{{ $errors->first('behavior_stat') }}
									</div>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4">
									<label>Other Inapporiate Behavior :</label>
								</div>
							</div>
							<div id="other_behavior_show">
								@if(isset($form_id))
									@foreach($inapporiate_details as $key => $row)
										<div class="row" id="row-{{ $key+1 }}" style="margin-top:10px;">
											<div class="col-sm-4">
												<select name="behavior_other[]" class="form-control">
													<option value="">Select Other Inapporiate Behavior</option>
													<option value="Refrained from picking up non-permitted items" {{ $row->behavior_other == 'Refrained from picking up non-permitted items' ? 'selected' : '' }}>Refrained from picking up non-permitted items</option>
													<option value="Running Away" {{ $row->behavior_other == 'Running Away' ? 'selected' : '' }}>Running Away</option>
													<option value="Self-Stimulatory Behaviour" {{ $row->behavior_other == 'Self-Stimulatory Behaviour' ? 'selected' : '' }}>Self-Stimulatory Behaviour</option>
													<option value="Crying" {{ $row->behavior_other == 'Crying' ? 'selected' : '' }}>Crying</option>
													<option value="Screaming" {{ $row->behavior_other == 'Screaming' ? 'selected' : '' }}>Screaming</option>
													<option value="Being Disrespectful" {{ $row->behavior_other == 'Being Disrespectful' ? 'selected' : '' }}>Being Disrespectful</option>
													<option value="Swearing" {{ $row->behavior_other == 'Swearing' ? 'selected' : '' }}>Swearing</option>
													<option value="Name Calling" {{ $row->behavior_other == 'Name Calling' ? 'selected' : '' }}>Name Calling</option>
													<option value="Verbally Threatening" {{ $row->behavior_other == 'Verbally Threatening' ? 'selected' : '' }}>Verbally Threatening</option>
													<option value="Slamming Doors" {{ $row->behavior_other == 'Slamming Doors' ? 'selected' : '' }}>Slamming Doors</option>
													<option value="Throwing Objects" {{ $row->behavior_other == 'Throwing Objects' ? 'selected' : '' }}>Throwing Objects</option>
													<option value="Showing Finger" {{ $row->behavior_other == 'Showing Finger' ? 'selected' : '' }}>Showing Finger</option>
													<option value="Unsafe Behaviour" {{ $row->behavior_other == 'Unsafe Behaviour' ? 'selected' : '' }}>Unsafe Behaviour</option>
													<option value="Self Harm" {{ $row->behavior_other == 'Self Harm' ? 'selected' : '' }}>Self Harm</option>
													<option value="Suicidal Ideation" {{ $row->behavior_other == 'Suicidal Ideation' ? 'selected' : '' }}>Suicidal Ideation</option>
													<option value="Physical Aggression" {{ $row->behavior_other == 'Physical Aggression' ? 'selected' : '' }}>Physical Aggression</option>
													<option value="Property Damage" {{ $row->behavior_other == 'Property Damage' ? 'selected' : '' }}>Property Damage</option>
													<option value="Technology Violation" {{ $row->behavior_other == 'Technology Violation' ? 'selected' : '' }}>Technology Violation</option>
													<option value="Sexual Behaviour" {{ $row->behavior_other == 'Sexual Behaviour' ? 'selected' : '' }}>Sexual Behaviour</option>
													<option value="Alcohol" {{ $row->behavior_other == 'Select' ? 'Alcohol' : '' }}>Alcohol</option>
													<option value="Cigarette Smoking" {{ $row->behavior_other == 'Cigarette Smoking' ? 'selected' : '' }}>Cigarette Smoking</option>
													<option value="Marijuana Smoking" {{ $row->behavior_other == 'Marijuana Smoking' ? 'selected' : '' }}>Marijuana Smoking</option>
													<option value="Stealing" {{ $row->behavior_other == 'Stealing' ? 'selected' : '' }}>Stealing</option>
												</select>
											</div>
											<div class="col-sm-4">
												<button type="button" class="btn btn-danger" onclick="behaviorOtherDelete({{ $key+1 }});"><i class="fa fa-trash"></i></button>
											</div>
											<div class="col-sm-4">
												<input type="hidden" name="behavior_other_no[]" class="form-control" placeholder="Enter Score" value="{{ $row->behavior_other_no }}">
											</div>
										</div>
									@endforeach
								@else
									<div class="row" id="row-1" style="margin-top:10px;">
										<div class="col-sm-4">
											<select name="behavior_other[]" class="form-control">
												<option value="">Select Other Inapporiate Behavior</option>
												<option value="Refrained from picking up non-permitted items">Refrained from picking up non-permitted items</option>
												<option value="Running Away">Running Away</option>
												<option value="Self-Stimulatory Behaviour">Self-Stimulatory Behaviour</option>
												<option value="Crying">Crying</option>
												<option value="Screaming">Screaming</option>
												<option value="Being Disrespectful">Being Disrespectful</option>
												<option value="Swearing">Swearing</option>
												<option value="Name Calling">Name Calling</option>
												<option value="Verbally Threatening">Verbally Threatening</option>
												<option value="Slamming Doors">Slamming Doors</option>
												<option value="Throwing Objects">Throwing Objects</option>
												<option value="Showing Finger">Showing Finger</option>
												<option value="Unsafe Behaviour">Unsafe Behaviour</option>
												<option value="Self Harm">Self Harm</option>
												<option value="Suicidal Ideation">Suicidal Ideation</option>
												<option value="Physical Aggression">Physical Aggression</option>
												<option value="Property Damage">Property Damage</option>
												<option value="Technology Violation">Technology Violation</option>
												<option value="Sexual Behaviour">Sexual Behaviour</option>
												<option value="Alcohol">Alcohol</option>
												<option value="Cigarette Smoking">Cigarette Smoking</option>
												<option value="Marijuana Smoking">Marijuana Smoking</option>
												<option value="Stealing">Stealing</option>
											</select>
										</div>
										<div class="col-sm-4">
											<button type="button" class="btn btn-danger" onclick="behaviorOtherDelete(1);"><i class="fa fa-trash"></i></button>
										</div>
										<div class="col-sm-4">
											<input type="hidden" name="behavior_other_no[]" class="form-control" placeholder="Enter Score" value="-2">
										</div>
									</div>
								@endif
							</div>
							<div class="row" style="margin-top:15px;">
								<div class="col-sm-4">
									<button type="button" class="btn btn-light" onclick="behaviorOther();">Add more</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div style="margin-top:20px; margin-bottom:100px;" align="center">
					<button type="submit" class="btn btn-success">{{ isset($form_id) ? 'Update' : 'Submit' }}</button>
				</div>
				</form>
			</div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function appoWith(id){
	if(id != 'N/A|0'){
		$('#appo_other_show').show();
	}
	else{
		$('#appo_other_show').hide();
	}
}
function familyWith(id){
	if(id != 'N/A|0'){
		$('#family_other_show').show();
	}
	else{
		$('#family_other_show').hide();
	}
}
function caseworkerWith(id){
	if(id != 'N/A|0'){
		$('#caseworker_other_show').show();
	}
	else{
		$('#caseworker_other_show').hide();
	}
}
var cnt =  {{ isset($form_id) ? count($inapporiate_details) : 1 }};
function behaviorOther(){
	cnt++;
	var data = '<div class="row" id="row-'+cnt+'" style="margin-top:10px;">';
		data += '<div class="col-sm-4">';
			data += '<select name="behavior_other[]" class="form-control">';
				data += '<option value="">Select Other Inapporiate Behavior</option>';
				data += '<option value="Refrained from picking up non-permitted items">Refrained from picking up non-permitted items</option>';
				data += '<option value="Running Away">Running Away</option>';
				data += '<option value="Self-Stimulatory Behaviour">Self-Stimulatory Behaviour</option>';
				data += '<option value="Crying">Crying</option>';
				data += '<option value="Screaming">Screaming</option>';
				data += '<option value="Being Disrespectful">Being Disrespectful</option>';
				data += '<option value="Swearing">Swearing</option>';
				data += '<option value="Name Calling">Name Calling</option>';
				data += '<option value="Verbally Threatening">Verbally Threatening</option>';
				data += '<option value="Slamming Doors">Slamming Doors</option>';
				data += '<option value="Throwing Objects">Throwing Objects</option>';
				data += '<option value="Showing Finger">Showing Finger</option>';
				data += '<option value="Unsafe Behaviour">Unsafe Behaviour</option>';
				data += '<option value="Self Harm">Self Harm</option>';
				data += '<option value="Suicidal Ideation">Suicidal Ideation</option>';
				data += '<option value="Physical Aggression">Physical Aggression</option>';
				data += '<option value="Property Damage">Property Damage</option>';
				data += '<option value="Technology Violation">Technology Violation</option>';
				data += '<option value="Sexual Behaviour">Sexual Behaviour</option>';
				data += '<option value="Alcohol">Alcohol</option>';
				data += '<option value="Cigarette Smoking">Cigarette Smoking</option>';
				data += '<option value="Marijuana Smoking">Marijuana Smoking</option>';
				data += '<option value="Stealing">Stealing</option>';
			data += '</select>';
		data += '</div>';
		data += '<div class="col-sm-4">';
			data += '<button type="button" class="btn btn-danger" onclick="behaviorOtherDelete('+cnt+');"><i class="fa fa-trash"></i></button>';
		data += '</div>';
		data += '<div class="col-sm-4">';
			data += '<input type="hidden" name="behavior_other_no[]" class="form-control" placeholder="Enter Score" value="-2">';
		data += '</div>';
	data += '</div>';
	$('#other_behavior_show').append(data);
}
function behaviorOtherDelete(id){
	$('#row-'+id).remove();
}

@if(session('status'))
swal({
  title: "{{ session('status')['title'] }}",
  text: "{{ session('status')['text'] }}",
  icon: "{{ session('status')['icon'] }}",
  button: "Ok",
});
@endif

//Date picker
$('#date').datetimepicker({
	format: 'L',
	format:'DD-MM-YYYY',
});

</script>
@endpush
  