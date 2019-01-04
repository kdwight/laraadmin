<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
	<div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
		<a class="navbar-brand brand-logo" href="/pages">
			<strong class="text-primary">Carbon Digital</strong>
		</a>
		<a class="navbar-brand brand-logo-mini" href="/pages">
			<strong class="text-primary">CMS</strong>
		</a>
	</div>
	<div class="navbar-menu-wrapper d-flex align-items-center">
		<ul class="navbar-nav navbar-nav-right">
			<li class="nav-item dropdown d-none d-xl-inline-block">
				<a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
					<span class="profile-text">Welcome!</span>
					<img class="img-xs rounded-circle" src="{{ asset('staradmin/images/pic-1.png') }}" alt="Profile image">
				</a>
				<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
					<a href="users/{{ auth()->id() }}/change-password"  class="dropdown-item mt-2">
					Change Password
					</a>
					<a class="dropdown-item" href="/admin_logout">
					Sign Out
					</a>
				</div>
			</li>
		</ul>
		<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
			<span class="fa fa-reorder"></span>
		</button>
	</div>
</nav>