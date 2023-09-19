<!-- Sidebar navigation-->
<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
      <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">Home</span>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="/head/dashboard" aria-expanded="false">
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
              <li class="sidebar-item">
              <a class="sidebar-link" href="/head/{{$department}}" aria-expanded="false">
                  <span>
                      <i class="ti ti-article"></i>
                  </span>
                  <span class="hide-menu">{{$department}}</span>
              </a>
              </li>
      <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">Attendance</span>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="/head/users/available" aria-expanded="false">
          <span>
            <i class="ti ti-login"></i>
          </span>
          <span class="hide-menu">Available users</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="/head/users/attendance" aria-expanded="false">
          <span>
            <i class="ti ti-user-plus"></i>
          </span>
          <span class="hide-menu">Users Attendance</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="/head/users/leaving" aria-expanded="false">
          <span>
            <i class="ti ti-aperture"></i>
          </span>
          <span class="hide-menu">Leaving Requests</span>
        </a>
      </li>
    </ul>

  </nav>
  <!-- End Sidebar navigation -->
