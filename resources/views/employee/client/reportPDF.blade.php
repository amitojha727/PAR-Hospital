<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<span style="font-weight:600;">Patient Report</span>
			<div><span style="font-weight:600;">Name:</span> {{ $client_details->client_fname }} {{ $client_details->client_sname }}</div>
			<div><span style="font-weight:600;">Date Range:</span> {{ date('F jS Y', strtotime($from_date)) }} - {{ date('F jS Y', strtotime($to_date)) }}</div>
			<div><span style="font-weight:600;">Overall Score:</span> {{ $form_details->sum('total_overalle_score') == 0 ? 0 : round(($form_details->sum('score')/$form_details->sum('total_overalle_score')) * 100) }} %</div>
			<div>
				<img src="{{ session('overallScoreChart') }}" style="height:300px; width:100%;" />
			</div>
			<div style="margin-top:15px;"><span style="font-weight:600;">Health Score:</span> {{ $form_details->sum('health_tot_score') == 0 ? 0 : round(($form_details->sum('health_score')/$form_details->sum('health_tot_score')) * 100) }} %</div>
			<div>
				<img src="{{ session('healthScoreChart') }}" style="height:300px; width:100%;" />
			</div>
			<div style="margin-top:15px;"><span style="font-weight:600;">Daily Routine Score:</span> {{ $form_details->sum('routine_tot_score') == 0 ? 0 : round(($form_details->sum('routine_score')/$form_details->sum('routine_tot_score')) * 100) }} %</div>
			<div>
				<img src="{{ session('routineScoreChart') }}" style="height:300px; width:100%;" />
			</div>
			<div style="margin-top:15px;"><span style="font-weight:600;">Social Wellbeing Score:</span> {{ $form_details->sum('social_tot_score') == 0 ? 0 : round(($form_details->sum('social_score')/$form_details->sum('social_tot_score')) * 100) }} %</div>
			<div>
				<img src="{{ session('socialScoreChart') }}" style="height:300px; width:100%;" />
			</div>
			<div style="margin-top:15px;"><span style="font-weight:600;">Behavior Score:</span> {{ $form_details->sum('behavior_tot_score') == 0 ? 0 : round(($form_details->sum('tot_behavior_score')/$form_details->sum('behavior_tot_score')) * 100) }} %</div>
			<div>
				<img src="{{ session('behaviorScoreChart') }}" style="height:300px; width:100%;" />
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