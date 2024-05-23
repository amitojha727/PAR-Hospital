<header>
	<div class="header-top-bar">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<ul class="top-bar-info list-inline-item pl-0 mb-0">
						<li class="list-inline-item"><a href="mailto:support@gmail.com"><i class="icofont-support-faq mr-2"></i>support@par.com</a></li>
						<li class="list-inline-item"><i class="icofont-location-pin mr-2"></i>Address Barol-Malimpur, Rajhat, Hooghly, West Bengal.</li>
					</ul>
				</div>
				<div class="col-lg-6">
					<div class="text-lg-right top-right-bar mt-2 mt-lg-0">
						<a href="tel:+23-345-67890" >
							<span>Call Now : </span>
							<span class="h4">083-3607-0583</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg navigation" id="navbar">
		<div class="container">
		 	 <a class="navbar-brand" href="{{ route('home') }}">
			  	<img src="{{ asset('website/images/logo.png') }}" alt="" class="img-fluid">
			  </a>

		  	<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
			<span class="icofont-navigation-menu"></span>
		  </button>
	  
		  <div class="collapse navbar-collapse" id="navbarmain">
			<ul class="navbar-nav ml-auto">
			  <li class="nav-item active">
				<a class="nav-link" href="{{ route('home') }}">Home</a>
			  </li>
			   <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
			    <li class="nav-item"><a class="nav-link" href="{{ route('service') }}">Services</a></li>

			    <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="{{ route('department') }}" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Department <i class="icofont-thin-down"></i></a>
					<ul class="dropdown-menu" aria-labelledby="dropdown02">
						<li><a class="dropdown-item" href="{{ route('department') }}">Departments</a></li>
					</ul>
			  	</li>

			  	<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="{{ route('doctor') }}" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Doctors <i class="icofont-thin-down"></i></a>
					<ul class="dropdown-menu" aria-labelledby="dropdown03">
						<li><a class="dropdown-item" href="{{ route('doctor') }}">Doctors</a></li>
						<li><a class="dropdown-item" href="{{ route('appoinment') }}">Appoinment</a></li>
					</ul>
			  	</li>
			   	<li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
				<li class="nav-item"><a class="nav-link" href="{{ route('employee.login') }}">Login</a></li>
			</ul>
		  </div>
		</div>
	</nav>
</header>
    <!--<div class="offcanvas-menu-overlay"></div>
    <div class="canvas-open" style="background-color:#FFFFFF;">
        <i class="icon_menu"></i>
    </div>
    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <i class="icon_close"></i>
        </div>
        
        <nav class="mainmenu mobile-menu">
            <ul>
                <li class="active"><a href="{{ route('home') }}">Home</a></li>
				<li><a href="{{ route('admin.login') }}">CRM</a></li>
				<li><a href="{{ route('employee.login') }}">Employee</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        
    </div>
	

    <header class="header-section header-normal">
        
        <div class="menu-item">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="logo" style="padding:5px 0px;">
                            <img src="{{ asset('website/img/logo.png') }}" alt="" style=" width:70%;">
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="nav-menu">
                            <nav class="mainmenu">
                                <ul>
                                    <li class="active"><a href="{{ route('home') }}">Home</a></li>
									
									<li><a href="{{ route('admin.login') }}">CRM</a></li>
									<li><a href="{{ route('employee.login') }}">Employee</a></li>
                                </ul>
                            </nav>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>-->
