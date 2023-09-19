<!-- Sidebar navigation-->
<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
      <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">Home</span>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="/admin/dashboard" aria-expanded="false">
          <span>
            <i class="ti ti-layout-dashboard"></i>
          </span>
          <span class="hide-menu">Dashboard</span>
        </a>
      </li>
      <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">Departments</span>
      </li>
          @foreach($departments as $department)
              <li class="sidebar-item">
              <a class="sidebar-link" href="/admin/{{$department}}" aria-expanded="false">
                  <span>
                      <i class="ti ti-article"></i>
                  </span>
                  <span class="hide-menu">{{$department}}</span>
              </a>
              </li>
          @endforeach
      <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">Attendance</span>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="/admin/users/available" aria-expanded="false">
          <span>
            <i class="ti ti-login"></i>
          </span>
          <span class="hide-menu">Available users</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="/admin/users/attendance" aria-expanded="false">
          <span>
            <i class="ti ti-user-plus"></i>
          </span>
          <span class="hide-menu">Users Attendance</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="/admin/users/leaving" aria-expanded="false">
          <span>
            <i class="ti ti-aperture"></i>
          </span>
          <span class="hide-menu">Leaving Requests</span>
        </a>
      </li>
      <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">Requests</span>
      </li>

      <li class="sidebar-item">
        <a class="sidebar-link" href="/admin/users/register" aria-expanded="false">
          <span>
            <i class="ti ti-currency-dollar"></i>
          </span>
          <span class="hide-menu">Register Requests</span>
        </a>
      </li>

      {{-- <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">AUTH</span>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">
          <span>
            <i class="ti ti-login"></i>
          </span>
          <span class="hide-menu">Login</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
          <span>
            <i class="ti ti-user-plus"></i>
          </span>
          <span class="hide-menu">Register</span>
        </a>
      </li>
      <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">EXTRA</span>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
          <span>
            <i class="ti ti-mood-happy"></i>
          </span>
          <span class="hide-menu">Icons</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
          <span>
            <i class="ti ti-aperture"></i>
          </span>
          <span class="hide-menu">Sample Page</span>
        </a>
      </li> --}}
    </ul>

  </nav>
  <!-- End Sidebar navigation -->
