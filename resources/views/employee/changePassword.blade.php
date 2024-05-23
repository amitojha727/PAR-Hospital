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
		<h1 class="m-0">Change Password</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
		  <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Dashboard</a></li>
		  <li class="breadcrumb-item">Change Password</li>
		</ol>
	</div>
@endsection
@section('content')
	<div class="container-fluid">
	  <div class="row">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="15%">&nbsp;</td>
				<td width="70%"><div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <form method="POST" action="{{ route('employee.changePasswordStore') }}">
                    @csrf
                   
                    <div class="form-group">       
                      <label>New password :</label>
                      <input type="password" placeholder="Enter password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                      @if ($errors->has('password'))
                         <div class="text-danger">
                              {{ $errors->first('password') }}
                         </div>
                      @endif
                    </div>
                    <div class="form-group">       
                      <label>Confirm new password:</label>
                      <input type="password" id="password-confirm" placeholder="Enter password for confirmation" class="form-control" name="password_confirmation">
                    </div>
                   
                    <div class="form-group">       
                      <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </div></td>
				<td width="15%">&nbsp;</td>
			  </tr>
			</table>
            
            
            
            
	  </div>
	</div>
@endsection
@section('model')
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