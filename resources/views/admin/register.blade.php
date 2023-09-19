<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AMS | Admin</title>
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

          @include('admin.components.sidebar')

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
                    <h3 class="mt-3 text-center">Register Requests</h3>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered my-3 text-center" style="vertical-align: middle;">
                            <thead>
                                <tr>
                                    <th>Request ID</th>
                                    <th>User name</th>
                                    <th>User email</th>
                                    <th>User department</th>
                                    <th>User role</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($register_requests) > 0)
                                @foreach ($register_requests as $RegReq)
                                    <tr>
                                        <td>{{$RegReq->id}}</td>
                                        <td>{{$RegReq->name}}</td>
                                        <td>{{$RegReq->email}}</td>
                                        <td>{{$RegReq->department}}</td>
                                        <td>{{$RegReq->role}}</td>
                                        <td>
                                            @if ($RegReq->img)
                                                <img src={{asset('uploads/images/'.$RegReq->img)}} alt="" style="width:50px; height:50px">
                                            @else
                                                <img src={{asset('uploads/images/default.jpg')}} alt="" style="width:50px; height:50px">
                                            @endif
                                        </td>
                                        @if ($RegReq->status == 'pending')
                                        <td class="text-Secondary">{{$RegReq->status}}</td>
                                        @elseif($RegReq->status == 'Approved')
                                        <td class="text-success">{{$RegReq->status}}</td>
                                        @else
                                        <td class="text-danger">{{$RegReq->status}}</td>
                                        @endif
                                        <td>
                                            @if($RegReq->status == 'pending')
                                            <button class="btn btn-danger">
                                                <a href="{{route('reject_register_request', $RegReq->id)}}" class="text-decoration-none text-light">Reject</a>
                                            </button>
                                            <button class="btn btn-primary">
                                                <a href="{{route('approve_register_request', $RegReq->id)}}" class="text-decoration-none text-light" >Approve</a>
                                            </button>

                                            @else
                                            <button class="btn btn-info disabled">
                                                <a href="#" class="text-decoration-none text-light" >{{$RegReq->status}}</a>
                                            </button>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="8"> No Register requests </td>
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
