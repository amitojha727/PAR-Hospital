@extends('admin.layouts.app')

@section('title')
	Patient report
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
		<h1 class="m-0">{{ isset($client_id) ? 'Update' : 'Add' }} Client</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
		  <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Dashboard</a></li>
		  <li class="breadcrumb-item"><a href="{{ route('employee.clients') }}">Patients</a></li>
		  <li class="breadcrumb-item">Report Excel</li>
		</ol>
	</div>
@endsection
@section('content')
      <!-- Counts Section -->
    <div class="container-fluid">
        <div class="row" style="background-color:#FFFFFF;">
			<div class="col-md-12">
				<form method="POST" action="{{ route('employee.client.reportExcelStore') }}" enctype="multipart/form-data">
                @csrf
				<div style="box-shadow:0px 0px 10px 0px rgb(200,200,200); padding:10px 10px; position:relative;">
					<div class="form-group">       
						<label>First Name : </label>
						<input type="file" name="excel_report" id="excel_report" class="form-control" accept="application/msexcel" value="{{ old('client_fname') }}">
						@if ($errors->has('client_fname'))
						<div class="text-danger">
							{{ $errors->first('client_fname') }}
						</div>
						@endif
					</div>
				</div>
				<div style="margin-top:20px; margin-bottom:100px;" align="center">
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
				</form>
			</div>
			<div class="col-md-2">
				<a href="{{ route('employee.client.reportExcelEmployee') }}">Add Employee</a>
				<table width="100%" border="1" cellspacing="0" cellpadding="0">
				  <tr>
					<td style="font-weight:600;">Employee ({{ count($excel_dtl) }})</td>
				  </tr>
				  @foreach($excel_dtl as $row)
					  <tr>
						<td>{{ $row->ex_d }}</td>
					  </tr>
				  @endforeach
				</table>				
			</div>
			<div class="col-md-2">
				<a href="{{ route('employee.client.reportExcelClient') }}">Add Client</a>
				<table width="100%" border="1" cellspacing="0" cellpadding="0">
				  <tr>
					<td style="font-weight:600;">Client ({{ count($client_dtl) }})</td>
				  </tr>
				  @foreach($client_dtl as $row)
					  <tr>
						<td>{{ $row->ex_c }}</td>
					  </tr>
				  @endforeach
				</table>				
			</div>
			<div class="col-md-2">
				<a href="{{ route('employee.client.reportExcelClientGenerate') }}">Generate Client</a>
				<table width="100%" border="1" cellspacing="0" cellpadding="0">
				  <tr>
					<td style="font-weight:600;">Matched Client ({{ count($report_dtl) }})</td>
				  </tr>
				  @foreach($report_dtl as $row)
					  <tr>
						<td>{{ $row->ex_c }}</td>
					  </tr>
				  @endforeach
				</table>				
			</div>
			<div class="col-md-4">
				<a href="{{ route('employee.client.reportExcelFormGenerate') }}">Generate Form</a>
				<table width="100%" border="1" cellspacing="0" cellpadding="0">
				  <tr>
					<td style="font-weight:600;" colspan="4">With out NA ({{ count($na_report_dtl) }})</td>
				  </tr>
				  @foreach($na_report_dtl as $row)
					  <tr>
					  	<td>{{ $row->ex_e }}</td>
						<td>{{ $row->client_id }}</td>
						<td>{{ $row->ex_c }}</td>
						<td>{{ $row->ex_h }}</td>
					  </tr>
				  @endforeach
				</table>
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
  