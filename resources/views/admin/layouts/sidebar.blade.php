
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
			@if(Auth::guard('admin')->check())
				<img src="{{ asset('adminlte/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="Admin">
			@elseif(Auth::guard('employee')->check())
				<img src="{{ Auth::guard('employee')->user()->employe_img != '' ? Auth::guard('employee')->user()->employe_img : asset('adminlte/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="{{ Auth::guard('employee')->user()->emp_fname.' '.Auth::guard('employee')->user()->emp_sname }}">
			@endif
          
        </div>
        <div class="info">
		  @if(Auth::guard('admin')->check())
          	<a href="{{ route('admin.dashboard') }}" class="d-block">PAR Hospital</a>
		  @elseif(Auth::guard('employee')->check())
		  	<a href="{{ route('employee.dashboard') }}" class="d-block">{{ Auth::guard('employee')->user()->emp_fname }} {{ Auth::guard('employee')->user()->emp_sname }}</a>
		  @endif
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if(Auth::guard('admin')->check())
		  	<li class="nav-item">
				<a href="{{ route('admin.dashboard') }}" class="nav-link">
				  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="layout-dashboard" icon-name="layout-dashboard" class="lucide lucide-layout-dashboard"><rect width="7" height="9" x="3" y="3" rx="1"></rect><rect width="7" height="5" x="14" y="3" rx="1"></rect><rect width="7" height="9" x="14" y="12" rx="1"></rect><rect width="7" height="5" x="3" y="16" rx="1"></rect></svg>&nbsp;&nbsp;
				  <p class="text">Dashboard</p>
				</a>
          	</li>
          	<li class="nav-item">
				<a href="#" class="nav-link">
				  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="settings" icon-name="settings" class="lucide lucide-settings"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path><circle cx="12" cy="12" r="3"></circle></svg>&nbsp;&nbsp;
				  <p>
					General
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">
				  <li class="nav-item">
					<a href="{{ route('admin.sites') }}" class="nav-link">
					  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="check-square" icon-name="check-square" class="lucide lucide-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>&nbsp;&nbsp;
					  <p>Departments</p>
					</a>
				  </li>
				  <!--<li class="nav-item">
					<a href="{{ route('admin.employees') }}" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Employees</p>
					</a>
				  </li>-->
				  
				</ul>
			</li>
			<li class="nav-item">
				<a href="{{ route('admin.employees') }}" class="nav-link">
				  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="users" icon-name="users" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>&nbsp;&nbsp;
				  <p class="text">Doctors</p>
				</a>
          	</li>
			<li class="nav-item">
				<a href="{{ route('admin.show.appointment') }}" class="nav-link">
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
					</svg>&nbsp;&nbsp;	 
					 <p class="text">Appointments</p>
				</a>
          	</li>
			<li class="nav-item">
				<a href="{{ route('admin.show.contact') }}" class="nav-link">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="sprout" icon-name="sprout" class="lucide lucide-sprout">
						<path d="M7 20h10"></path>
						<path d="M10 20c5.5-2.5.8-6.4 3-10"></path>
						<path
							d="M9.5 9.4c1.1.8 1.8 2.2 2.3 3.7-2 .4-3.5.4-4.8-.3-1.2-.6-2.3-1.9-3-4.2 2.8-.5 4.4 0 5.5.8z">
						</path>
						<path
							d="M14.1 6a7 7 0 0 0-1.1 4c1.9-.1 3.3-.6 4.3-1.4 1-1 1.6-2.3 1.7-4.6-2.7.1-4 1-4.9 2z">
						</path>
					</svg>&nbsp;&nbsp;
					<p class="text">Contacts</p>
				</a>
          	</li>
			  <li class="nav-item">
				<a href="{{ route('admin.show.subscriber') }}" class="nav-link">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell-plus"><path d="M19.3 14.8C20.1 16.4 21 17 21 17H3s3-2 3-9c0-3.3 2.7-6 6-6 1 0 1.9.2 2.8.7"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/><path d="M15 8h6"/><path d="M18 5v6"/></svg>&nbsp;&nbsp;
					<p class="text">Subscribers</p>
				</a>
          	</li>
		  @elseif(Auth::guard('employee')->check())
		  	<li class="nav-item">
				<a href="{{ route('employee.clients') }}" class="nav-link">
				  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="users" icon-name="users" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>&nbsp;&nbsp;
				  <p class="text">Patients</p>
				</a>
          	</li>
		  	
		  @endif
          @if(Auth::guard('admin')->check())
          <li class="nav-item">
            <a href="{{ route('admin.changePassword2') }}" class="nav-link">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="lock" icon-name="lock" class="lucide lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>&nbsp;&nbsp;
              <p class="text">Change Password</p>
            </a>
          </li>
		  @elseif(Auth::guard('employee')->check())
		  <li class="nav-item">
            <a href="{{ route('employee.changePassword') }}" class="nav-link">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="lock" icon-name="lock" class="lucide lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>&nbsp;&nbsp;
              <p class="text">Change Password</p>
            </a>
          </li>
		  @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>