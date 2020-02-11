<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/Admin') }}" class="brand-link">
      <img src="{{ $logo }}" style="max-width: 80%; margin: 0 auto;" alt="">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ $user->name }} {{ $user->surname }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('/Admin') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Tasks
                <i class="fas fa-angle-left right"></i>
                @if ( (int)$count_tasks > 0 )
                <span class="badge badge-info right">{{ $count_tasks }}</span>
                @endif
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Tasks" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All tasks</p>
                </a>
              </li>
              @foreach ( $types as $type )
              <li class="nav-item">
                <a href="Tasks?id_type={{ $type->id }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ $type->description }}</p>
                </a>
              </li>
              @endforeach
            </ul>
          </li>
          <li class="nav-item">
            <a href="Notifications" class="nav-link">
              <i class="nav-icon fas fa-bell"></i>
              <p>
                Notifications
                @if ( (int)$count_notifications > 0 )
                <span class="badge badge-info right">{{ $count_notifications }}</span>
                @endif
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="MyProfile" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User profile
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="AdminProperties" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Properties
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Contacts" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Contacts
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Messages" class="nav-link">
              <i class="nav-icon fas fa-comment"></i>
              <p>
                Messages
              </p>
            </a>
          </li>
          <li class="nav-header">
            <i class="nav-icon fas fa-code"></i>
            WEBSITE ADMIN
          </li>
          <li class="nav-item">
            <a href="Users" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Resorts" class="nav-link">
              <i class="nav-icon fas fa-umbrella-beach"></i>
              <p>
                Resorts
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="TaskCategories" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Task categories
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="AdminCompanies" class="nav-link">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Companies
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Pages" class="nav-link">
              <i class="nav-icon fas fa-window-restore"></i>
              <p>
                Pages
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="AdminCompanies.skins" class="nav-link">
              <i class="nav-icon fas fa-palette"></i>
              <p>
                Skins
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="AdminCompanies.contactInformation" class="nav-link">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                Contact information
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
