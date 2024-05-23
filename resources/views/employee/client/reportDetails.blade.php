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
		<h1 class="m-0">{{ $client_details->client_fname }} {{ $client_details->client_sname }}</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
		  <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Dashboard</a></li>
		  <li class="breadcrumb-item"><a href="{{ route('employee.clients') }}">Patients</a></li>
		  <li class="breadcrumb-item">View Report</li>
		</ol>
	</div>
@endsection
@section('content')
      <!-- Counts Section -->
    <div class="container-fluid">
        <div class="row" style="background-color:#FFFFFF;">
			<div class="col-md-12">
				<div style="box-shadow:0px 0px 10px 0px rgb(200,200,200); padding:10px 10px; position:relative; padding-top:20px;">
					<form action="{{ route('employee.client.reportDetails') }}" method="get">
					@csrf
					<input type="hidden" name="client_id" value="{{ $client_id }}"/>
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">
								  	<label>From Date:</label>
									<div class="input-group date" id="from_date" data-target-input="nearest">
										<input type="text" name="from_date" id="from_date" class="form-control datetimepicker-input filter_disable" data-target="#from_date" value="{{ $from_date ? $from_date : date('d-m-Y') }}" {{ $filter_by != '' ? 'disabled' : '' }}/>
										<div class="input-group-append" data-target="#from_date" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
								  	<label>To Date:</label>
									<div class="input-group date" id="to_date" data-target-input="nearest">
										<input type="text" name="to_date" id="to_date" class="form-control datetimepicker-input filter_disable" data-target="#to_date" value="{{ $to_date ? $to_date : date('d-m-Y') }}" {{ $filter_by != '' ? 'disabled' : '' }}/>
										<div class="input-group-append" data-target="#to_date" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
								  	<label>Filter By :</label>
									<select name="filter_by" id="filter_by" class="form-control">
										<option value="">Date Range</option>
										<option value="Daily" {{ request('filter_by') == 'Daily' ? 'selected' : '' }}>Daily</option>
										<option value="Weekly" {{ request('filter_by') == 'Weekly' ? 'selected' : '' }}>Weekly</option>
										<option value="Monthly" {{ request('filter_by') == 'Monthly' ? 'selected' : '' }}>Monthly</option>
										<option value="Quarterly" {{ request('filter_by') == 'Quarterly' ? 'selected' : '' }}>Quarterly</option>
										<option value="Yearly" {{ request('filter_by') == 'Yearly' ? 'selected' : '' }}>Yearly</option>
									</select>
								</div>
							</div>
							<div class="col-sm-2" style="padding-top:32px;">
								<button class="btn btn-primary">Search</button>
							</div>
							@if($from_date != '' && $to_date != '')
								<div class="col-sm-4" style="padding-top:32px;">
									<button type="button" id="exportPDF" class="btn btn-info">Export as pdf</button>
									<button type="button" id="exportPrint" class="btn btn-secondary">Print</button>
								</div>
							@endif
						</div>
					</div>
					</form>
				</div>
				@if($from_date != '' && $to_date != '' && count($form_details) > 0)
					<div style="box-shadow:0px 0px 10px 0px rgb(200,200,200); padding:10px 10px; position:relative; padding-top:20px; margin-top:15px; margin-bottom:20px;">
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-12">
									<label>Patient Report</label>
									<div><label>Name:</label> {{ $client_details->client_fname }} {{ $client_details->client_sname }}</div>
									<div><label>Date Range:</label> {{ date('F jS Y', strtotime($from_date)) }} - {{ date('F jS Y', strtotime($to_date)) }}</div>
									<div><label>Overall Score:</label> {{ $form_details->sum('total_overalle_score') == 0 ? 0 : round(($form_details->sum('score')/$form_details->sum('total_overalle_score')) * 100) }} %</div>
									<div>
										<canvas id="overallScoreChart" style="height:300px;"></canvas>
									</div>
									<div style="margin-top:15px;"><label>Health Score:</label> {{ $form_details->sum('health_tot_score') == 0 ? 0 : round(($form_details->sum('health_score')/$form_details->sum('health_tot_score')) * 100) }} %</div>
									<div>
										<canvas id="healthScoreChart" style="height:300px;"></canvas>
									</div>
									<div style="margin-top:15px;"><label>Daily Routine Score:</label> {{ $form_details->sum('routine_tot_score') == 0 ? 0 : round(($form_details->sum('routine_score')/$form_details->sum('routine_tot_score')) * 100) }} %</div>
									<div>
										<canvas id="routineScoreChart" style="height:300px;"></canvas>
									</div>
									<div style="margin-top:15px;"><label>Social Wellbeing Score:</label> {{ $form_details->sum('social_tot_score') == 0 ? 0 : round(($form_details->sum('social_score')/$form_details->sum('social_tot_score')) * 100) }} %</div>
									<div>
										<canvas id="socialScoreChart" style="height:300px;"></canvas>
									</div>
									<div style="margin-top:15px;"><label>Behavior Score:</label> {{ $form_details->sum('behavior_tot_score') == 0 ? 0 : round(($form_details->sum('tot_behavior_score')/$form_details->sum('behavior_tot_score')) * 100) }} %</div>
									<div>
										<canvas id="behaviorScoreChart" style="height:300px;"></canvas>
									</div>
									@php
										$arr_other = [];
									@endphp
									@foreach($form_details as $row)
										@if($row->clientHealthStatus->appo_other != '')
											<div>{{ date('F jS Y', strtotime($row->date)) }}: Medical Appointment - {{ $row->clientHealthStatus->appo_other }}</div>
										@endif
										@if($row->clientSocialWellBeing->family_other != '')
											<div>{{ date('F jS Y', strtotime($row->date)) }}: Contact with Family - {{ $row->clientSocialWellBeing->family_other }}</div>
										@endif
										@if($row->clientSocialWellBeing->caseworker_other != '')
											<div>{{ date('F jS Y', strtotime($row->date)) }}: Contact with Caseworker - {{ $row->clientSocialWellBeing->caseworker_other }}</div>
										@endif
										@if(count($row->clientInapporiateBehavior) > 0)
											@foreach($row->clientInapporiateBehavior as $row22)
												@if($row22->behavior_other != '')
													@php
														array_push($arr_other,$row22->behavior_other);
													@endphp
													<!--<div>{{ date('F jS Y', strtotime($row->date)) }}: Other Inapporiate Behavior - {{ $row22->behavior_other }}</div>-->
												@endif
											@endforeach
										@endif
									@endforeach
									@php
										$arr_other = array_count_values($arr_other);
									@endphp
									@if(count($arr_other) > 0)
										@foreach($arr_other as $key => $arr)
											<div>Other Inapporiate Behavior - {{ $key }} - {{ $arr }} times</div>
										@endforeach
									@endif
								</div>
							</div>
						</div>
					</div>
				@endif
			</div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
var img;
@if($from_date != '' && $to_date != '' && count($form_details) > 0)
	var labels_over = [];
	var data_over = [];
	var labels_health = [];
	var data_health = [];
	var labels_routine = [];
	var data_routine = [];
	var labels_social = [];
	var data_social = [];
	var labels_behavior = [];
	var data_behavior = [];
	@foreach($form_details as $row)
		var label = "{{ date('Y-m-d', strtotime($row->date)) }}";
		var data = "{{ $row->total_overalle_score == 0 ? 0 : round(($row->score/$row->total_overalle_score) * 100) }}";
		var label_h = "{{ date('Y-m-d', strtotime($row->date)) }}";
		var data_h = "{{ $row->health_tot_score == 0 ? 0 : round(($row->health_score/$row->health_tot_score) * 100) }}";
		var label_r = "{{ date('Y-m-d', strtotime($row->date)) }}";
		var data_r = "{{ $row->routine_tot_score == 0 ? 0 : round(($row->routine_score/$row->routine_tot_score) * 100) }}";
		var label_s = "{{ date('Y-m-d', strtotime($row->date)) }}";
		var data_s = "{{ $row->social_tot_score == 0 ? 0 : round(($row->social_score/$row->social_tot_score) * 100) }}";
		var label_b = "{{ date('Y-m-d', strtotime($row->date)) }}";
		var data_b = "{{ $row->behavior_tot_score == 0 ? 0 : round(($row->tot_behavior_score/$row->behavior_tot_score) * 100) }}";
		labels_over.push(label);
		data_over.push(data);
		
		labels_health.push(label_h);
		data_health.push(data_h);
		
		labels_routine.push(label_r);
		data_routine.push(data_r);
		
		labels_social.push(label_s);
		data_social.push(data_s);
		
		labels_behavior.push(label_b);
		data_behavior.push(data_b);
	@endforeach
	// overall
	var areaChartData = {
      labels  : labels_over,
      datasets: [
        {
          label               : 'Overall Score',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(0,0,0,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : data_over
        }
      ]
    }
	var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
          },
		  ticks: {
			beginAtZero: true
		  }
        }]
      }
    }
	//-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#overallScoreChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    //lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    });
	lineChart.ctx.rect(0, 0, lineChart.width, lineChart.height);
	lineChart.ctx.fillStyle="#fff"; // Put your desired background color here
	lineChart.ctx.fill();
	
	
	// health
	var areaChartDatahealth = {
      labels  : labels_health,
      datasets: [
        {
          label               : 'Health Score',
          backgroundColor     : 'rgba(60,141,188,0.9)',
         borderColor         : 'rgba(0,0,0,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : data_health
        }
      ]
    }
	var areaChartOptionshealth = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
          },
		  ticks: {
			beginAtZero: true
		  }
        }]
      }
    }
	//-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvashealth = $('#healthScoreChart').get(0).getContext('2d')
    var lineChartOptionshealth = $.extend(true, {}, areaChartOptionshealth)
    var lineChartDatahealth = $.extend(true, {}, areaChartDatahealth)
    lineChartDatahealth.datasets[0].fill = false;
    //lineChartData.datasets[1].fill = false;
    lineChartOptionshealth.datasetFill = false

    var lineCharthealth = new Chart(lineChartCanvashealth, {
      type: 'line',
      data: lineChartDatahealth,
      options: lineChartOptionshealth
    });
	lineCharthealth.ctx.rect(0, 0, lineCharthealth.width, lineCharthealth.height);
	lineCharthealth.ctx.fillStyle="#fff"; // Put your desired background color here
	lineCharthealth.ctx.fill();
	// routine
	var areaChartDataroutine = {
      labels  : labels_routine,
      datasets: [
        {
          label               : 'Health Score',
          backgroundColor     : 'rgba(60,141,188,0.9)',
         borderColor         : 'rgba(0,0,0,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : data_routine
        }
      ]
    }
	var areaChartOptionsroutine = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
          },
		  ticks: {
			beginAtZero: true
		  }
        }]
      }
    }
	//-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvasroutine = $('#routineScoreChart').get(0).getContext('2d')
    var lineChartOptionsroutine = $.extend(true, {}, areaChartOptionsroutine)
    var lineChartDataroutine = $.extend(true, {}, areaChartDataroutine)
    lineChartDataroutine.datasets[0].fill = false;
    //lineChartData.datasets[1].fill = false;
    lineChartOptionsroutine.datasetFill = false

    var lineChartroutine = new Chart(lineChartCanvasroutine, {
      type: 'line',
      data: lineChartDataroutine,
      options: lineChartOptionsroutine
    });
	lineChartroutine.ctx.rect(0, 0, lineChartroutine.width, lineChartroutine.height);
	lineChartroutine.ctx.fillStyle="#fff"; // Put your desired background color here
	lineChartroutine.ctx.fill();
	// social
	var areaChartDatasocial = {
      labels  : labels_social,
      datasets: [
        {
          label               : 'Health Score',
          backgroundColor     : 'rgba(60,141,188,0.9)',
         borderColor         : 'rgba(0,0,0,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : data_social
        }
      ]
    }
	var areaChartOptionssocial = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
          },
		  ticks: {
			beginAtZero: true
		  }
        }]
      }
    }
	//-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvassocial = $('#socialScoreChart').get(0).getContext('2d')
    var lineChartOptionssocial = $.extend(true, {}, areaChartOptionssocial)
    var lineChartDatasocial = $.extend(true, {}, areaChartDatasocial)
    lineChartDatasocial.datasets[0].fill = false;
    //lineChartData.datasets[1].fill = false;
    lineChartOptionssocial.datasetFill = false

    var lineChartsocial = new Chart(lineChartCanvassocial, {
      type: 'line',
      data: lineChartDatasocial,
      options: lineChartOptionssocial
    });
	lineChartsocial.ctx.rect(0, 0, lineChartsocial.width, lineChartsocial.height);
	lineChartsocial.ctx.fillStyle="#fff"; // Put your desired background color here
	lineChartsocial.ctx.fill();
	// behavior
	var areaChartDatabehavior = {
      labels  : labels_behavior,
      datasets: [
        {
          label               : 'Health Score',
          backgroundColor     : 'rgba(60,141,188,0.9)',
         borderColor         : 'rgba(0,0,0,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : data_behavior
        }
      ]
    }
	var areaChartOptionsbehavior = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
          },
		  ticks: {
			beginAtZero: true
		  }
        }]
      }
    }
	//-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvasbehavior = $('#behaviorScoreChart').get(0).getContext('2d')
    var lineChartOptionsbehavior = $.extend(true, {}, areaChartOptionsbehavior)
    var lineChartDatabehavior = $.extend(true, {}, areaChartDatabehavior)
    lineChartDatabehavior.datasets[0].fill = false;
    //lineChartData.datasets[1].fill = false;
    lineChartOptionsbehavior.datasetFill = false

    var lineChartbehavior = new Chart(lineChartCanvasbehavior, {
      type: 'line',
      data: lineChartDatabehavior,
      options: lineChartOptionsbehavior
    });
	lineChartbehavior.ctx.rect(0, 0, lineChartbehavior.width, lineChartbehavior.height);
	lineChartbehavior.ctx.fillStyle="#fff"; // Put your desired background color here
	lineChartbehavior.ctx.fill();
@endif
	/*var ctx = document.getElementById("overallScoreChart").getContext("2d");
	var labels_q = [];
	var data_q = [];
	var backgroundColor_q = [];
	var borderColor_q = [];
	@foreach($form_details as $row)
		var label = "{{ $row['t'] }}";
		var data = {
			t: "{{ $row['t'] }}",
			y: "{{ $row['y'] }}"
		};
		var rgb1 = {{ rand(50,250) }};
		var rgb2 = {{ rand(50,250) }};
		var rgb3 = {{ rand(50,250) }};
		labels_q.push(label);
		data_q.push(data);
		backgroundColor_q.push('rgba('+rgb1+', '+rgb2+', '+rgb3+', 0.2)');
		borderColor_q.push('rgba('+rgb1+', '+rgb2+', '+rgb3+',1)');
	@endforeach
	var myChart = new Chart(ctx, {
	  type: 'line',
	  options: {
		scales: {
		  xAxes: [{
			type: 'time',
		  }]
		}
	  },
	  data: {
		labels: labels_q,
		datasets: [{
		  label: 'Package',
		  data: data_q,
		  backgroundColor: backgroundColor_q,
		  borderColor:borderColor_q,
		  fill: false,
		  borderWidth: 1
		}]
	  }
	});*/
	$("#filter_by").change(function(){
		var data = $(this).val();
		if(data != ''){
			$(".filter_disable").prop('disabled', true);
		}
		else{
			$(".filter_disable").prop('disabled', false);
		}
	});
	$("#exportPDF").click(function(){
		var client_id = '{{ request('client_id') }}';
		var filter_by = '{{ request('filter_by') }}';
		var from_date = '{{ request('from_date') }}';
		var to_date = '{{ request('to_date') }}';
		var overallScoreChart = lineChart.toBase64Image();//$('#overallScoreChart').get(0).toDataURL("image/jpeg");
		var healthScoreChart = lineCharthealth.toBase64Image();
		var routineScoreChart = lineChartroutine.toBase64Image();
		var socialScoreChart = lineChartsocial.toBase64Image();
		var behaviorScoreChart = lineChartbehavior.toBase64Image();
		//console.log(lineChart.toBase64Image());
		$.ajax({
			type : 'post',
			url  : "{{ route('employee.client.reportAjaxPDF')}}",
			data: {
				'client_id' : client_id,
				'filter_by' : filter_by,
				'from_date' : from_date,
				'to_date' : to_date,
				'overallScoreChart' : overallScoreChart,
				'healthScoreChart' : healthScoreChart,
				'routineScoreChart' : routineScoreChart,
				'socialScoreChart' : socialScoreChart,
				'behaviorScoreChart' : behaviorScoreChart,
				'_token':$('input[name=_token]').val()},
			datatype : 'html',
			success:function(data)
			{
				//console.log(data);
				var url = "{{ route('employee.client.reportPDF') }}";
				window.open(url, '_blank');
			} 
		});	
	});
	$("#exportPrint").click(function(){
		var client_id = '{{ request('client_id') }}';
		var filter_by = '{{ request('filter_by') }}';
		var from_date = '{{ request('from_date') }}';
		var to_date = '{{ request('to_date') }}';
		var overallScoreChart = lineChart.toBase64Image();//$('#overallScoreChart').get(0).toDataURL("image/jpeg");
		var healthScoreChart = lineCharthealth.toBase64Image();
		var routineScoreChart = lineChartroutine.toBase64Image();
		var socialScoreChart = lineChartsocial.toBase64Image();
		var behaviorScoreChart = lineChartbehavior.toBase64Image();
		
		$.ajax({
			type : 'post',
			url  : "{{ route('employee.client.reportAjaxPrint')}}",
			data: {
				'client_id' : client_id,
				'filter_by' : filter_by,
				'from_date' : from_date,
				'to_date' : to_date,
				'overallScoreChart' : overallScoreChart,
				'healthScoreChart' : healthScoreChart,
				'routineScoreChart' : routineScoreChart,
				'socialScoreChart' : socialScoreChart,
				'behaviorScoreChart' : behaviorScoreChart,
				'_token':$('input[name=_token]').val()},
			datatype : 'html',
			success:function(data)
			{
				//console.log(data);
				//$('#printDivHtml').html(data);
				//var printContents = document.getElementById(printDivHtml).innerHTML;
				//var originalContents = document.body.innerHTML;
			
				//document.body.innerHTML = printContents;
				//$(window.document.body).html(data);
				//window.print();
				//window.open(window.print(), '_blank');
				//window.print();
				w=window.open();
				w.document.write(data);
				w.print();
				w.close();
				//document.body.innerHTML = originalContents;
				//var url = "{{ route('employee.client.reportPDF') }}";
				//window.open(url, '_blank');
			} 
		});	
	});
	//Date picker
	$('#to_date').datetimepicker({
		format: 'L',
		format:'DD-MM-YYYY',
		minDate:'+{{ date("Y/m/d",strtotime($client_details->client_admission_date)) }}'
	});
	$('#from_date').datetimepicker({
		format: 'L',
		format:'DD-MM-YYYY',
		minDate:'+{{ date("Y/m/d",strtotime($client_details->client_admission_date)) }}'
	});
	// {{ $client_details->client_admission_date }}
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
  