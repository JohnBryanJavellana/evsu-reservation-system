<div>
	<nav class="main-header navbar navbar-expand navbar-danger border-0 elevation-1 navbar-dark">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
			</li>
		</ul>

		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link" data-widget="fullscreen" href="#" role="button">
					<i class="fas fa-expand-arrows-alt"></i>
				</a>
			</li>

			<li class="nav-item pt-1">
				<a class="btn btn-default btn-sm mx-2" href="/welcome/logout" role="button">
					Logout
					<i class="fas fa-sign-out-alt ml-1 text-danger"></i>
				</a>
			</li>
		</ul>
	</nav>

	<aside class="main-sidebar main-sidebar-custom elevation-1 sidebar-light-danger">
		<div class="border-bottom text-center w-100 p-3 small text-bold">
			<img src="{{ URL::asset('system-images/evsu-logo.png') }}" class="rounded-cirle mb-2" height="30" alt=""><br>
            Eastern Visayas State University Reservation Management System
        </div>

		<div class="sidebar" style="font-size: 13px">
			<div class="user-panel mt-2 pb-2 mb-3 d-flex border-0 bg-light p-2">
				<div class="image">
					<img src="{{ URL::asset('user-images/' . request()->user()->profile_picture) }}" class="rounded-circle elevation-1 mt-2" height="40" alt="User Image">
				</div>
				<div class="info">
					<a href="#" class="d-block text-overflow text-truncate">
						{{ request()->user()->firstname . ' ' .  request()->user()->middlename . ' ' . request()->user()->lastname . ' ' . request()->user()->suffix }}<br>
						<small class="text-bold">Patron</small>
					</a>
				</div>
			</div>

			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item">
						<a href="/welcome/patron/dashboard" class="nav-link d-flex align-items-center {{ strpos(url()->current(), 'welcome/patron/dashboard') ? 'active' : '' }}">
							<span class="nav-icon material-icons-outlined">dashboard</span>
							<p>Dashboard</p>
						</a>
					</li>

					<li class="nav-item {{ strpos(url()->current(), 'welcome/patron/reservation') ? 'menu-open' : '' }}">
						<a href="javascript:void(0);" class="nav-link d-flex align-items-center {{ strpos(url()->current(), 'welcome/patron/reservation') ? 'active' : '' }}">
							<span class="nav-icon material-icons-outlined">book</span>
							<p>
								Reservation
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>

						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="/welcome/patron/reservation/list" class="nav-link d-flex align-items-center {{ strpos(url()->current(), 'welcome/patron/reservation/list') ? 'active' : '' }}">
									<span class="nav-icon material-icons-outlined">list_alt</span>
									<p>Reservations</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="/welcome/patron/reservation/new" class="nav-link d-flex align-items-center {{ strpos(url()->current(), 'welcome/patron/reservation/new') ? 'active' : '' }}">
									<span class="nav-icon material-icons-outlined">add</span>
									<p>New Reservation</p>
								</a>
							</li>
						</ul>
					</li>

					<li class="nav-item">
						<a href="/welcome/patron/calendar" class="nav-link d-flex align-items-center {{ strpos(url()->current(), 'welcome/patron/calendar') ? 'active' : '' }}">
                            <span class="nav-icon material-icons-outlined">event</span>
							<p>Calendar of Events</p>
						</a>
					</li>

                    <li class="nav-item">
						<a href="/welcome/patron/account-history" class="nav-link d-flex align-items-center {{ strpos(url()->current(), 'welcome/patron/account-history') ? 'active' : '' }}">
                            <span class="nav-icon material-icons-outlined">history</span>
							<p>Account History</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="/welcome/patron/my-account" class="nav-link d-flex align-items-center {{ strpos(url()->current(), 'welcome/patron/my-account') ? 'active' : '' }}">
							<span class="nav-icon material-icons-outlined">manage_accounts</span>
							<p>My Account</p>
						</a>
					</li>
				</ul>
			</nav>
		</div>
  	</aside>
</div>