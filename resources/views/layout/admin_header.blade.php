
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="{{ $back }}">
              <i class="fas fa-arrow-left"></i> Back
            </a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form" style="height:0; overflow: hidden;">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav ml-0 ml-md-2">
            @isset( $_SESSION["actual_id"] )
              <li class="nav-item">
                <a class="nav-link" href="Admin.endViewAs">
                <i class="fas fa-user-secret" style="font-size: 1.25rem;"></i>
                  <p>End virtual session</p>
                </a>
              </li>
            @endisset
              <li class="nav-item">
                <div onclick="addTask()" title="Add task" style="margin-left: 15px;
    border-radius: 3px; cursor: pointer;
    color: #3C4858;
    padding-left: 10px;
    padding-right: 10px;
    text-transform: capitalize;
    font-size: 13px;
    padding: 10px 15px;">
                  <i class="material-icons">assignment_ind</i>
                  <p class="d-lg-none d-md-block">
                    Add task
                  </p>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="" id="navbarDropdownMenuMessages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">message</i>
                  <span class="notification">{{ $count_notifications }}</span>
                  <p class="d-lg-none d-md-block">
                    Messages
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuMessages">
                  @foreach ( $notifications as $row )
                  <span class="dropdown-item" href="{{ url('Notifications') }}">{!! $row->text !!}</span>
                  @endforeach
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ url('Messages') }}">View all messages</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">{{ $count_notifications }}</span>
                  <p class="d-lg-none d-md-block">
                    Notifications
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  @foreach ( $notifications as $row )
                  <span class="dropdown-item" href="{{ url('Notifications') }}">{!! $row->text !!}</span>
                  @endforeach
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ url('Notifications') }}">View all notifications</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="{{ url('MyProfile') }}">Profile</a>
                  <a class="dropdown-item" href="{{ url('Profile.settings') }}">Settings</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ url('Login.logout') }}">Log out</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>