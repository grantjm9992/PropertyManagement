<div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
      <div class="logo text-center">
        <img src="img/logo_colour.png" style="max-width: 80%; margin: 0 auto;" alt="">
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active  ">
            <a class="nav-link" href="{{ url('Admin') }}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link collapsed" data-toggle="collapse" href="#formsExamples">
              <i class="material-icons">assignment_ind</i>
              <p>Tasks</p>
            </a>
            <div class="collapse" id="formsExamples" style="">
              <ul class="nav">
                <li class="nav-item ">
                  <a class="nav-link" href="{{ url('Tasks') }}">
                    <span class="sidebar-normal">All tasks</span>
                  </a>
                </li>
                @foreach ( $types as $type )
                <li class="nav-item ">
                  <a class="nav-link" href="{{ url('Tasks') }}?id_type={{$type->id}}">
                    <span class="sidebar-normal">{{ $type->description }}</span>
                  </a>
                </li>
                @endforeach
              </ul>
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{ url('Notifications') }}">
              <i class="material-icons">notifications</i>
              <p>Notifications</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{ url('MyProfile') }}">
              <i class="material-icons">person</i>
              <p>User Profile</p>
            </a>
          </li>
          @if ( $user->role == "PO" )
          <li class="nav-item ">
            <a class="nav-link" href="{{ url('MyProperties') }}">
              <i class="material-icons">home</i>
              <p>My properties</p>
            </a>
          </li>
          @endif
          @if ( $user->role != "PO" )
          <li class="nav-item ">
            <a class="nav-link" href="{{ url('AdminProperties') }}">
              <i class="material-icons">home</i>
              <p>Properties</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{ url('Users') }}">
              <i class="material-icons">people</i>
              <p>Users</p>
            </a>
          </li>
          @endif
          @if( $user->role == "WA" || $user->role == "SA" )
          <li class="nav-item ">
            <a class="nav-link" href="{{ url('WebAdmin') }}">
              <i class="material-icons">developer_mode</i>
              <p>Website admin</p>
            </a>
          </li>
          @endif
        </ul>
      </div>
    </div>