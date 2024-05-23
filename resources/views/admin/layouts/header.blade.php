@if(Auth::guard('employee')->check())
<style>
/* body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .content-wrapper, body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-footer, body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-header {
    transition: margin-left .3s ease-in-out;
    margin-left: 0px;
} */
</style>
@endif
<!-- Preloader -->
  <!--<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>-->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        @if(!Auth::guard('employee')->check())
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		@endif
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
	  	@if(Auth::guard('admin')->check())
          	<a class="nav-link" data-controlsidebar-slide="true" href="{{ route('admin.logout2') }}">
          		<i class="fas fa-power-off"></i>
        	</a>
		@elseif(Auth::guard('employee')->check())
		  	<a class="nav-link" data-controlsidebar-slide="true" href="{{ route('employee.logout') }}">
          		<i class="fas fa-power-off"></i>
        	</a>
		@endif
        
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->