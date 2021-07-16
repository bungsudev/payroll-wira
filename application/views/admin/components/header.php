<header class="main-header">
	<div class="d-flex align-items-center logo-box justify-content-between">
		<a href="#" class="waves-effect waves-light nav-link rounded d-none d-md-inline-block mx-10 push-btn"
			data-toggle="push-menu" role="button">
			<span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span
					class="path3"></span></span>
		</a>
		<!-- Logo -->
		<a href="index.html" class="logo">
			<!-- logo-->
			<div class="logo-lg">
				<!-- <span class="light-logo"><img src="<?= base_url() ?>assets/admin/images/logo-dark-text.png" alt="logo"></span>
				<span class="dark-logo"><img src="<?= base_url() ?>assets/admin/images/logo-light-text.png" alt="logo"></span> -->
			</div>
		</a>
	</div>
	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top pl-10">
		<!-- Sidebar toggle button-->
		<div class="app-menu">
			<ul class="header-megamenu nav">
				<li class="btn-group nav-item d-md-none">
					<a href="#" class="waves-effect waves-light nav-link rounded push-btn" data-toggle="push-menu"
						role="button">
						<span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span
								class="path3"></span></span>
					</a>
				</li>
				<li class="btn-group nav-item d-lg-inline-flex d-none">
					<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link rounded full-screen"
						title="Full Screen">
						<i class="icon-Expand-arrows"><span class="path1"></span><span class="path2"></span></i>
					</a>
				</li>
			</ul>
		</div>

		<div class="navbar-custom-menu r-side">
			<ul class="nav navbar-nav">
				<!-- Notifications -->
				<!--  -->

				<!-- User Account-->
				<li class="dropdown user user-menu">
					<a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown" title="User">
						<i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
					</a>
					<ul class="dropdown-menu animated flipInX">
						<li class="user-body">
							<a class="dropdown-item" href="#"><i class="ti-user text-muted mr-2"></i>
								Profile</a>
							<a class="dropdown-item" href="#"><i class="ti-settings text-muted mr-2"></i>
								Settings</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?= base_url();?>auth/logout"><i class="ti-lock text-muted mr-2"></i> Logout</a>
						</li>
					</ul>
				</li>

				<!-- Control Sidebar Toggle Button -->

			</ul>
		</div>
	</nav>
</header>