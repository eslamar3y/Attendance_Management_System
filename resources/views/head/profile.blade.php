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
              <h5 class="card-title fw-semibold mb-4 text-center">{{$user->name}} profile</h5>
              <div class="card">
                <div class="card-body">
                    <div class="d-flex" >
                        @if ($user->image)
                        <img src={{asset('uploads/images/'.$user->image)}} alt="" style="max-width:200px; border-radius:10px">
                        @else
                        <img src={{asset('uploads/images/default.jpg')}} alt="" style="max-width:200px; border-radius:10px">
                        @endif
                        <div class="content mx-5">
                            <h1>{{$user->name}}</h1>
                            <p>Department: {{$user->department}}</p>
                            <p>Role: {{$user->role}}</p>
                            <p>Email: {{$user->email}}</p>
                        </div>
                    </div>

                    <h3 class="mt-5 text-center">Leaving Requests</h3>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered my-3 text-center">
                            <thead>
                                <tr>
                                    <th>Request ID</th>
                                    <th>Request Day</th>
                                    <th>Request time</th>
                                    <th>Request Reason</th>
                                    <th>Request Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($leaving_requests) > 0)
                                @foreach ($leaving_requests as $leave)
                                    <tr>
                                        <td>{{$leave->id}}</td>
                                        <td>{{$leave->day}}</td>
                                        <td>{{$leave->request_time}}</td>
                                        <td>{{$leave->reason}}</td>
                                        @if ($leave->status == 'Pending')
                                        <td class="text-Secondary">{{$leave->status}}</td>
                                        @elseif($leave->status == 'Approved')
                                        <td class="text-success">{{$leave->status}}</td>
                                        @else
                                        <td class="text-danger">{{$leave->status}}</td>
                                        @endif
                                        <td>
                                            @if($leave->status == 'pending')
                                            <button class="btn btn-danger">
                                                <a href="{{route('reject_request', $leave->id)}}" class="text-decoration-none text-light">Reject</a>
                                            </button>
                                            <button class="btn btn-primary">
                                                <a href="{{route('approve_request', $leave->id)}}" class="text-decoration-none text-light" >Approve</a>
                                            </button>
                                            @else
                                            <button class="btn btn-danger disabled">
                                                <a href="{{route('reject_request', $leave->id)}}" class="text-decoration-none text-light">Reject</a>
                                            </button>
                                            <button class="btn btn-primary disabled">
                                                <a href="{{route('approve_request', $leave->id)}}" class="text-decoration-none text-light" >Approve</a>
                                            </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="6"> No leaving requests </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>

                </div>
              </div>
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
