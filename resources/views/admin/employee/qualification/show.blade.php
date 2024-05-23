@extends('admin.layouts.app')

@section('title')
    Qualification
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
		<h1 class="m-0">Qualification</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
		  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		  <li class="breadcrumb-item"><a href="{{ route('admin.employees') }}">Doctors</a></li>
		  <li class="breadcrumb-item">Qualification</li>
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
						<a href="{{ route('admin.employee.add.qualification',['employee_id' => $employee_id]) }}" class="btn btn-info" style="padding:6px 10px; margin-top:-3px;">Add Qualification</a>
					</div>
					<table id="example" class="display nowrap" style="width:100%">
						<thead>
						<tr height="40px" align="left" style="background-color:#F7F7F7; font-weight:600;">
                            <th width="10%">Id</th>
                            <th width="30%">Degree Name</th>
                            <th width="15%">Degree Start Year</th>
                            <th width="15%">Degree End Year</th>
                            <th width="30%">Action</th>
						</tr>
						</thead>
						<tbody id="tb2">
							@foreach($qualification_details as $row)
								<tr style="border-bottom:1px solid #F7F7F7;">
									<td style="padding:0px 10px;">{{ $row->id }}</td>
									<td style="padding:0px 10px;">{{ $row->degree_name }}</td>
									<td style="padding:0px 10px;">{{ $row->degree_start_year }}</td>
									<td style="padding:0px 10px;">{{ $row->degree_end_year }}</td>
									<td style="padding:10px 10px;">
										<a href="{{ route('admin.employee.add.qualification',['employee_id' => $employee_id,'id' => $row->id]) }}" class="btn btn-warning btn-sm">Edit</a>
										<a href="{{ route('admin.employee.delete.qualification',['id' => $row->id]) }}" class="btn btn-danger btn-sm" onClick="return delSchool()">Delete</a>
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
		var r = confirm("Are you want to delete this employee?");
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
  