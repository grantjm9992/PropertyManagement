<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ $url }}" class="nav-link">
        <i class="fas fa-arrow-left"></i> Back
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('') }}" class="nav-link">Home</a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="Messages">
          <i class="far fa-comments"></i>
          @if ( (int)$count_messages > 0 )
          <span class="badge badge-danger navbar-badge">{{ $count_messages }}</span>
          @endif
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Notifications">
          <i class="far fa-bell"></i>
          @if ( (int)$count_notifications > 0 )
          <span class="badge badge-warning navbar-badge">{{ $count_notifications }}</span>
          @endif
        </a>
      </li>
			@if ( isset( $_SESSION['actual_id'] ) && $_SESSION['actual_id'] != "" )
			<li class="nav-item">
				<a class="nav-link" title="End virtual session" href="Admin.endViewAs">
					<i class="fas fa-user-slash"></i>
					<span class="d-md-none">End virtual session</span>
				</a>
			</li>	
			@endif		
    </ul>
  </nav>