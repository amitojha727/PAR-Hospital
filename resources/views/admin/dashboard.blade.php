@extends('admin.layouts.app')
@section('title')
Dashboard
@endsection
@section('meta')

@endsection
@section('style')

@endsection
@push('head-scripts')

@endpush
@section('sub-header')
	<div class="col-sm-6">
		<h1 class="m-0">Dashboard</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
			<li class="breadcrumb-item active">Dashboard</li>
		</ol>
	</div>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-warning" role="alert">
					<div class="row">
						<div class="col-sm-6 col-xs-12">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
								fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								stroke-linejoin="round" data-lucide="zap" icon-name="zap" class="lucide lucide-zap">
								<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
							</svg>&nbsp;&nbsp;
							Explore what's important to review first
						</div>
						<div class="col-sm-6 col-xs-12">
							<marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
								<a class="link-primary" href="{{ route('admin.employeeAdd') }}" style="color: #5e3fc9;">Add New doctor</a>
							</marquee>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
				<div class="data-card" style="background: #ef476f;">
					<div class="icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
							fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round" data-lucide="users" icon-name="users"
							class="lucide lucide-users">
							<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
							<circle cx="9" cy="7" r="4"></circle>
							<path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
							<path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
						</svg>
					</div>
					<div class="content">
						<h4 class="count">{{ $deparments }}</h4>
						<p>Departments</p>
					</div>
					<a class="link" href="{{ route('admin.sites') }}">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
							fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round" data-lucide="external-link" icon-name="external-link"
							class="lucide lucide-external-link">
							<path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
							<polyline points="15 3 21 3 21 9"></polyline>
							<line x1="10" x2="21" y1="14" y2="3"></line>
						</svg>
					</a>
				</div>
			</div>
			<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
				<div class="data-card" style="background: #5e3fc9;">
					<div class="icon" style="color:#5e3fc9;">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
							fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round" data-lucide="user-check" icon-name="user-check"
							class="lucide lucide-user-check">
							<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
							<circle cx="9" cy="7" r="4"></circle>
							<polyline points="16 11 18 13 22 9"></polyline>
						</svg>
					</div>
					<div class="content">
						<h4 class="count">{{ $doctors }}</h4>
						<p>Doctors</p>
					</div>
					<a class="link" href="{{ route('admin.employees') }}">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
							fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round" data-lucide="external-link" icon-name="external-link"
							class="lucide lucide-external-link">
							<path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
							<polyline points="15 3 21 3 21 9"></polyline>
							<line x1="10" x2="21" y1="14" y2="3"></line>
						</svg>
					</a>
				</div>
			</div>
			<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
				<div class="data-card" style="background: #2a9d8f;">
					<div class="icon" style="color:#2a9d8f;">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
							fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round" data-lucide="package-plus" icon-name="package-plus"
							class="lucide lucide-package-plus">
							<path d="M16 16h6"></path>
							<path d="M19 13v6"></path>
							<path
								d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14">
							</path>
							<path d="M16.5 9.4 7.55 4.24"></path>
							<polyline points="3.29 7 12 12 20.71 7"></polyline>
							<line x1="12" x2="12" y1="22" y2="12"></line>
						</svg>
					</div>
					<div class="content">
						<h4 class="count">{{ $appointments }}</h4>
						<p>Appoinments</p>
					</div>
					<a class="link" href="{{ route('admin.show.appointment') }}">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
							fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round" data-lucide="external-link" icon-name="external-link"
							class="lucide lucide-external-link">
							<path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
							<polyline points="15 3 21 3 21 9"></polyline>
							<line x1="10" x2="21" y1="14" y2="3"></line>
						</svg>
					</a>
				</div>
			</div>
			<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
				<div class="data-card" style="background: #227c9d;">
					<div class="icon" style="color:#227c9d;">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
							fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round" data-lucide="sprout" icon-name="sprout"
							class="lucide lucide-sprout">
							<path d="M7 20h10"></path>
							<path d="M10 20c5.5-2.5.8-6.4 3-10"></path>
							<path
								d="M9.5 9.4c1.1.8 1.8 2.2 2.3 3.7-2 .4-3.5.4-4.8-.3-1.2-.6-2.3-1.9-3-4.2 2.8-.5 4.4 0 5.5.8z">
							</path>
							<path
								d="M14.1 6a7 7 0 0 0-1.1 4c1.9-.1 3.3-.6 4.3-1.4 1-1 1.6-2.3 1.7-4.6-2.7.1-4 1-4.9 2z">
							</path>
						</svg>
					</div>
					<div class="content">
						<h4 class="count">{{ $contacts }}</h4>
						<p>Contacts</p>
					</div>
					<a class="link" href="{{ route('admin.show.contact') }}">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
							fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round" data-lucide="external-link" icon-name="external-link"
							class="lucide lucide-external-link">
							<path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
							<polyline points="15 3 21 3 21 9"></polyline>
							<line x1="10" x2="21" y1="14" y2="3"></line>
						</svg>
					</a>
				</div>
			</div>
			
			<div class="col-sm-12 col-xs-12">
				<div class="row">
					<div class="col-sm-4 col-xs-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Call for an Emergency Service!</h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse">
										<i class="fas fa-minus"></i>
									</button>
									<button type="button" class="btn btn-tool" data-card-widget="remove">
										<i class="fas fa-times"></i>
									</button>
								</div>
							</div>
							<div class="card-body">
								<div class="alert alert-primary" role="alert"
									style="color: #EF476F;background-color: #FDECF0; border:none;">
									<strong>Call Us :</strong> 083-3607-0583
								</div>
								<div class="alert alert-primary" role="alert"
									style="color: #EF476F;background-color: #FDECF0; border:none;">
									<strong>Email Us :</strong> contact@gmail.com
								</div>
								<div class="alert alert-primary" role="alert"
									style="color: #EF476F;background-color: #FDECF0; border:none; margin-bottom:50px;">
									<strong>Location :</strong> Barol-Malimpur, Rajhat, Hooghly, West Bengal. Pin - 712123
								</div>
								
							</div>
						</div>
					</div>

					<div class="col-sm-4 col-xs-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Head to Head Statistics</h3>

								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse">
										<i class="fas fa-minus"></i>
									</button>
									<button type="button" class="btn btn-tool" data-card-widget="remove">
										<i class="fas fa-times"></i>
									</button>
								</div>
							</div>
							<div class="card-body">
								<canvas id="pieChart"
									style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
							</div>
							<!-- /.card-body -->
						</div>
					</div>
					<div class="col-sm-4 col-xs-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Appoinments Statistics</h3>

								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse">
										<i class="fas fa-minus"></i>
									</button>
									<button type="button" class="btn btn-tool" data-card-widget="remove">
										<i class="fas fa-times"></i>
									</button>
								</div>
							</div>
							<div class="card-body">
								<canvas id="stackedBarChart"
									style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
							</div>
							<!-- /.card-body -->
						</div>
					</div>
				</div>
			</div>

			<!-- ./col -->
		</div>
	</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('content')

@endsection
@section('model')

@endsection
@push('scripts')
<script>
	//-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
	var donutData        = {
      labels: [
          'Doctors',
          'Patients'
      ],
      datasets: [
        {
          data: [<?php echo $doctors; ?>,<?php echo $patients; ?>],
          backgroundColor : ['#5E3FC9', '#EF476F'],
        }
      ]
    }
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })
	
	function copyText(id) {
	  // Get the text field
	  var copyText = document.getElementById("copyTextInput"+id);
	
	  // Select the text field
	  copyText.select();
	  copyText.setSelectionRange(0, 99999); // For mobile devices
	
	  // Copy the text inside the text field
	  navigator.clipboard.writeText(copyText.value);
	  
	  // Alert the copied text
	  //alert("Copied the text: " + copyText.value);
	}
	
	@php
		$arr = [date('F'),date('F',strtotime('-1 month')),date('F',strtotime('-2 month'))];
		$cur = App\Models\Appointment::whereRaw("str_to_date(created_at,'%Y-%m-%d') between str_to_date('".date('Y-m-01')."','%Y-%m-%d') and str_to_date('".date('Y-m-t')."','%Y-%m-%d')")->count();
		$cur_1 = App\Models\Appointment::whereRaw("str_to_date(created_at,'%Y-%m-%d') between str_to_date('".date('Y-m-01',strtotime('-1 month'))."','%Y-%m-%d') and str_to_date('".date('Y-m-t',strtotime('-1 month'))."','%Y-%m-%d')")->count();
		$cur_2 = App\Models\Appointment::whereRaw("str_to_date(created_at,'%Y-%m-%d') between str_to_date('".date('Y-m-01',strtotime('-2 month'))."','%Y-%m-%d') and str_to_date('".date('Y-m-t',strtotime('-2 month'))."','%Y-%m-%d')")->count();
		// dd($cur);
		$arr_payout = [$cur,$cur_1,$cur_2];
	@endphp
	var labels = {!! json_encode($arr) !!};
	var arr_payout = {!! json_encode($arr_payout) !!};
	var areaChartData = {
      labels  : labels,
      datasets: [
        {
          label               : 'Appoinments',
          backgroundColor     : '#227c9d',
          borderColor         : '#227c9d',
          pointRadius          : false,
          pointColor          : '#EF476F',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : arr_payout
        }
      ]
    }
	var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    barChartData.datasets[0] = temp0
	//---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
</script>
@endpush