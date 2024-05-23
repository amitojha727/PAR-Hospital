@extends('admin.layouts.app')

@section('title')
    Doctors
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
		<h1 class="m-0">Doctors</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
		  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		  <li class="breadcrumb-item">Doctors</li>
		</ol>
	</div>
@endsection
@section('content')
      <!-- Counts Section -->
    <div class="container-fluid">
        <div class="row" style="background-color:#FFFFFF;">
			<div class="col-md-12">
				<div style="box-shadow:0px 0px 10px 0px rgb(200,200,200); padding:10px 10px; position:relative; padding-top:20px;">
					<div style="width:40%; position:absolute; top:10px; right:10px; z-index:999;" align="right">
						<input id="word_search" class="form-control" placeholder="Search Name" style="width:50%; display:inline-block;">
						<a href="{{ route('admin.employeeAdd') }}" class="btn btn-info" style="padding:6px 10px; margin-top:-3px;">New Doctor</a>
					</div>
					<table id="example" class="display nowrap" style="width:100%">
						<thead>
						<tr height="40px" align="left" style="background-color:#F7F7F7; font-weight:600;">
						 <th width="10%">Id</th>
						 <th width="30%">Department</th>
						 <th width="30%">Name</th>
						 <th width="15%">User Id</th>
						 <th width="15%">Action</th>
						</tr>
						</thead>
						<tbody id="tb2">
							@foreach($employee_details as $row)
								<tr style="border-bottom:1px solid #F7F7F7;">
									<td style="padding:0px 10px;">{{ $row->emp_id }}</td>
									<td style="padding:0px 10px;">{{ DB::table('site_mast')->where('site_id',$row->site_id)->value('site_nm') }}</td>
									<td style="padding:0px 10px;">{{ $row->emp_fname }} {{ $row->emp_sname }}</td>
									<td style="padding:0px 10px;">{{ $row->emp_user_id }}</td>
									<td style="padding:10px 10px;">
										<a href="{{ route('admin.employeeAdd',['employee_id' => $row->emp_id]) }}" class="btn btn-warning btn-sm">Edit</a>
										<a href="{{ route('admin.employeeDelete',['employee_id' => $row->emp_id]) }}" class="btn btn-danger btn-sm" onClick="return delSchool()">Delete</a>
										<a href="{{ route('admin.employeeChangePassword',['employee_id' => $row->emp_id]) }}" class="btn btn-info btn-sm">Change Password</a>
										<a href="{{ route('admin.employee.qualification',['employee_id' => $row->emp_id]) }}" class="btn btn-primary btn-sm">Qualification</a>
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
		var r = confirm("Are you want to delete this Doctor?");
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
			oTable.column(2).search($(this).val()).draw();
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
</script>
@endpush
  