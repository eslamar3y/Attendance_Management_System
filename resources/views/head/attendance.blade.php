<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AMS | Head</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../../assets/css/styles.min.css" />
  </head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
          <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/admin/dashboard" class="text-nowrap logo-img">
              <img src="../../assets/images/logos/dark-logo.svg" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
              <i class="ti ti-x fs-8"></i>
            </div>
          </div>

          @include('head.components.sidebar')

        </div>
        <!-- End Sidebar scroll-->
      </aside>
      <!--  Sidebar End -->
      @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show fixed-top" style="width: 450px; left:2%; top:2%" role="alert">
          <strong>Success!</strong> {{session()->get('success')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <script>
          setTimeout(function(){
              $('.alert').alert('close');
          }, 3000);
      </script>
      @endif
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href={{route('logout')}} class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4 text-center">
                {{-- get month --}}
                @php
                    $month = date('F');
                    $year = date('Y');
                @endphp
                {{$month}} &nbsp;
                {{$year}}
              </h5>

                    {{-- <h3 class="mt-5 text-center">Leaving Requests</h3> --}}

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered my-3 text-center">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>Attendance days</th>
                                    <th>Absent days</th>
                                    <th>Absent hours</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($users_att)
                                    @foreach($users_att as $user)
                                        <tr>
                                            <td>{{$user['user']->id}}</td>
                                            <td>{{$user['user']->name}}</td>
                                            <td>{{$user['user']->department}}</td>
                                            <td>{{$user['user']->role}}</td>
                                            <td>{{$user['attendence_days']}}</td>
                                            <td>{{$user['absent_days']}}</td>
                                            <?php
                                                $absent_hours_decimal = $user['absent_hours']; // Replace this with your actual decimal value

                                                // Convert decimal hours to hours and minutes
                                                $absent_hours = floor($absent_hours_decimal);
                                                $absent_minutes_decimal = ($absent_hours_decimal - $absent_hours) * 60;
                                                $absent_minutes = round($absent_minutes_decimal);

                                                // Format the result
                                                $absent_hours_minutes = sprintf('%02d:%02d', $absent_hours, $absent_minutes);
                                            ?>
                                            <td>{{$absent_hours_minutes}} h</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">No attendance data</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>

                </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/js/sidebarmenu.js"></script>
  <script src="../../assets/js/app.min.js"></script>
  <script src="../../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>
