@inject('translator', 'App\Providers\TranslationProvider')
<div id="menu" class="menu">
	<div>
	<a href="Admin">
		<i class="fas fa-tachometer-alt"></i> Dashboard
	</a>
	<!--
		Property admin
	-->
	@if ( in_array($user->role, ["SA", "AA", "M"] ) )
	<a href="AdminProperties">
		<i class="fas fa-home"></i> Properties
	</a>
	@endif
	<a href="Contacts">
		<i class="fas fa-address-book"></i> Contacts
	</a>
	@if ( 1 === 1 )
	<a href="Notifications">
		<i class="fas fa-star"></i> Notifications
	</a>
	@endif
	<!--
		Agenda
	-->
	<a href="Tasks">
		<i class="fas fa-calendar"></i> Tasks
	</a>
	<a href="Messages">
		<i class="fas fa-envelope"></i> Messages
	</a>
	
	<!--
		Website layout
	-->
	@if ( in_array($user->role, ["SA", "WA", "AA" ]) )
	<a href="AdminCompanies.skins">
		<i class="fas fa-palette"></i> Website style
	</a>
	@endif
	@if ( in_array($user->role, ["SA", "WA"]) )
	<a href="Pages">
		<i class="fas fa-sticky-note"></i> Pages
	</a>
	<a href="AdminInfoSections">
		<i class="fas fa-info-circle"></i> Information sections
	</a>
	@endif
	<!--
		Analytics
	-->
	@if ( in_array(3, $permissions ) || in_array(2, $permissions) )
	<a href="Analytics">
		<i class="fas fa-chart-line"></i> Analytics
	</a>
	@endif
	<!--
		Website Admin
	-->
	@if ( $user->role != "PO" )
	<a href="Users">
		<i class="fas fa-users"></i> Users
	</a>
	@endif
	@if ( $user->role == "SA" )
	<a href="AdminCompanies">
		<i class="fas fa-briefcase"></i> Companies
	</a>
	@endif
	<!--
		SUPER DUPER ADMIN SHIT
	-->
	@if ( $user->role != "PO" && !isset( $_SESSION['actual_id'] ) )
	<a href="Admin.viewAs">
		<i class="fas fa-user-secret"></i> Start virtual session
	</a>
	@endif
	@if ( isset( $_SESSION['actual_id'] ) && $_SESSION['actual_id'] != "" )
	<a href="Admin.endViewAs">
		<i class="fas fa-user-slash"></i> End virtual session
	</a>
	@endif
	</div>
</div>