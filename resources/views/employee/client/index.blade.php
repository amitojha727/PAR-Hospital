@extends('admin.layouts.app')

@section('title')
Patients
@endsection
@section('style')
<style>
	.dataTables_filter,
	.dataTables_info {
		display: none;
	}
</style>
@endsection
@push('head-script')

@endpush
@section('sub-header')
<div class="col-sm-6">
	<h1 class="m-0">Patients</h1>
</div><!-- /.col -->
<div class="col-sm-6">
	<ol class="breadcrumb float-sm-right">
		<li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item">Patients</li>
	</ol>
</div>
@endsection
@section('content')
<!-- Counts Section -->
<div class="container-fluid">
	<div class="row" style="background-color:#FFFFFF;">
		<div class="col-md-12">
			<div
				style="box-shadow:0px 0px 10px 0px rgb(200,200,200); padding:10px 10px; position:relative; padding-top:20px;">
				<div style="width:40%; position:absolute; top:10px; right:10px; z-index:999;" align="right">
					<input id="word_search" class="form-control" placeholder="Search Name"
						style="width:50%; display:inline-block;">
					<a href="{{ route('employee.clientAdd') }}" class="btn btn-info"
						style="padding:6px 10px; margin-top:-3px;">New Patient</a>
				</div>
				<table id="example" class="display nowrap" style="width:100%">
					<thead>
						<tr height="40px" align="left" style="background-color:#F7F7F7; font-weight:600;">
							<th>Id</th>
							<th>Name</th>
							<th>Contact Number</th>
							<th>Date of Admission</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="tb2">
						@foreach($client_details as $row)
						<tr style="border-bottom:1px solid #F7F7F7;">
							<td style="padding:0px 10px;">{{ $row->client_id }}</td>
							<td style="padding:0px 10px;">{{ $row->client_fname }} {{ $row->client_sname }}</td>
							<td style="padding:0px 10px;">{{ $row->client_contact_no }}</td>
							<td style="padding:0px 10px;">{{ date('d F,Y',strtotime($row->client_admission_date)) }}</td>
							<td style="padding:10px 10px;">
								<a href="{{ route('employee.clientAdd',['client_id' => $row->client_id]) }}"
									class="btn btn-warning btn-sm">Edit</a>
								<a href="{{ route('employee.clientDelete',['client_id' => $row->client_id]) }}"
									class="btn btn-danger btn-sm" onClick="return delSchool()">Delete</a>
								<a href="{{ route('employee.client.addDetails',['client_id' => $row->client_id]) }}"
									class="btn btn-primary btn-sm">Add Form</a>
								<a href="{{ route('employee.client.viewDetails',['client_id' => $row->client_id]) }}"
									class="btn btn-primary btn-sm">View Form</a>
								<a href="{{ route('employee.client.reportDetails',['client_id' => $row->client_id]) }}"
									class="btn btn-primary btn-sm">View Report</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script>
	function delSchool(){
		var r = confirm("Are you want to delete this Patient?");
	  	if (r == true) {
			return true;
	  	} else {
			return false;
	  	}
	}
	// table word
	$(function () {
		var oTable;
		var oTable = $('#example').DataTable( {
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
			"aoColumnDefs": [{
				"bSortable": false,
				"aTargets": ["sorting_disabled"]
			}],
			"bDestroy": true
		});
		$('#word_search').on('keyup', function() {
			//oTable.fnFilter( $(this).val() ); 
			oTable.column(1).search($(this).val()).draw();
		});
  	});
	/*$(document).ready(function() {
		var oTable;
		var oTable = $('#example').DataTable( {
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
			"aoColumnDefs": [{
				"bSortable": false,
				"aTargets": ["sorting_disabled"]
			}],
			"bDestroy": true
		});
		$('#word_search').on('keyup', function() {
			//oTable.fnFilter( $(this).val() ); 
			oTable.column(1).search($(this).val()).draw();
		});
		
	});*/

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