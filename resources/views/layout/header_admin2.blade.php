
<nav class="navbar navbar-dark navbar-expand-md bg-admin justify-content-md-center justify-content-start">
    <button class="navbar-toggler ml-1" type="button" data-toggle="collapse" data-target="#collapsingNavbar2">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse justify-content-between align-items-center w-100" id="collapsingNavbar2">
        <ul class="navbar-nav mx-auto text-md-center text-left">
			<li class="nav-item active">
				<a class="nav-link" title="Dashboard" href="Admin">
					<i class="fas fa-tachometer-alt"></i>
					<span class="d-md-none">Dashboard</span>
				</a>
			</li>
			@if ( in_array($user->role, ["SA", "AA", "M"] ) )
			<li class="nav-item active">
				<a class="nav-link" title="Properties" href="AdminProperties">
					<i class="fas fa-home"></i>
					<span class="d-md-none">Properties</span>
				</a>
			</li>
			@endif
			<li class="nav-item active">
				<a class="nav-link" title="Contacts" href="Contacts">
					<i class="fas fa-address-book"></i>
					<span class="d-md-none">Contacts</span>
				</a>
			</li>
			@if ( 1 === 1 )
			<li class="nav-item active">
				<a class="nav-link" title="Notifications" href="Notifications">
					<i class="fas fa-star"></i>
					<span class="d-md-none">Notifications</span>
				</a>
			</li>
			@endif
			<li class="nav-item active">
				<a class="nav-link" title="Tasks" href="Tasks">
					<i class="fas fa-calendar"></i>
					<span class="d-md-none">Tasks</span>
				</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" title="Messages" href="Messages">
					<i class="fas fa-envelope"></i>
					<span class="d-md-none">Messages</span>
				</a>
			</li>
			@if ( in_array($user->role, ["SA", "WA", "AA" ]) )
			<li class="nav-item active">
				<a class="nav-link" title="Website Style" href="AdminCompanies.skins">
					<i class="fas fa-palette"></i>
					<span class="d-md-none">Website style</span>
				</a>
			</li>
			@endif
			@if ( in_array($user->role, ["SA", "WA"]) )
			<li class="nav-item active">
				<a class="nav-link" title="Pages" href="Pages">
					<i class="fas fa-sticky-note"></i>
					<span class="d-md-none">Pages</span>
				</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" title="Information Sections" href="AdminInfoSections">
					<i class="fas fa-info-circle"></i>
					<span class="d-md-none">Information sections</span>
				</a>
			</li>
			@endif
			@if ( in_array($user->role, ["SA", "WA", "AA" ]) )
			<li class="nav-item active">
				<a class="nav-link" title="Analytics" href="Analytics">
					<i class="fas fa-chart-line"></i>
					<span class="d-md-none">Analytics</span>
				</a>
			</li>
			@endif
			@if ( $user->role != "PO" )
			<li class="nav-item active">
				<a class="nav-link" title="Users" href="Users">
					<i class="fas fa-users"></i>
					<span class="d-md-none">Users</span>
				</a>
			</li>
			@endif
			@if ( $user->role == "SA" )
			<li class="nav-item active">
				<a class="nav-link" title="Companies" href="AdminCompanies">
					<i class="fas fa-briefcase"></i>
					<span class="d-md-none">Companies</span>
				</a>
			</li>
			@endif
			@if ( $user->role != "PO" && !isset( $_SESSION['actual_id'] ) )
			<li class="nav-item active">
				<a class="nav-link" title="Start virtual session" href="Admin.viewAs">
					<i class="fas fa-user-secret"></i>
					<span class="d-md-none">Start virtual session</span>
				</a>
			</li>
			@endif
			@if ( isset( $_SESSION['actual_id'] ) && $_SESSION['actual_id'] != "" )
			<li class="nav-item active">
				<a class="nav-link" title="End virtual session" href="Admin.endViewAs">
					<i class="fas fa-user-slash"></i>
					<span class="d-md-none">End virtual session</span>
				</a>
			</li>	
			@endif		
        </ul>
        <ul class="nav navbar-nav flex-row justify-content-md-center justify-content-around flex-nowrap">
			<li class="nav-item">
				<a href="MyProfile" class="nav-link">
					<i class="fas fa-user-cog"></i> <span class="d-md-none">My profile</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="Login.logout" class="nav-link">
					<i class="fas fa-sign-out-alt"></i> <span class="d-md-none">Sign out</span>
				</a>
			</li>
        </ul>
    </div>
</nav>