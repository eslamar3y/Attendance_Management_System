<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AMS | Admin</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
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
            <img src="../assets/images/logos/dark-logo.svg" width="180" alt="" />
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
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">

          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              {{-- <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a> --}}
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
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
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <!-- Monthly Earnings -->
                    <div class="card">
                      <div class="card-body">
                        <div class="row alig n-items-start">
                          <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold"> Number Of Users </h5>
                            <h4 class="fw-semibold mb-3">{{$users->count()}}</h4>
                            <div class="d-flex align-items-center pb-1">
                              <span
                                class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                <i class="ti ti-arrow-up-right text-success"></i>
                              </span>
                              {{-- <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                              <p class="fs-3 mb-0">last year</p> --}}
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="d-flex justify-content-end">
                              <div
                                class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                <i class="ti ti-users fs-6"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="earning"></div>
                    </div>
                  </div>
              <div class="col-lg-4">
                <!-- Monthly Earnings -->
                <div class="card">
                  <div class="card-body">
                    <div class="row alig n-items-start">
                      <div class="col-8">
                        <h5 class="card-title mb-9 fw-semibold"> Available Users </h5>
                        <h4 class="fw-semibold mb-3">{{
                        count($availableUsers)
                        }}</h4>
                        <div class="d-flex align-items-center pb-1">
                          <span
                            class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                            <i class="ti ti-arrow-right text-danger"></i>
                          </span>
                          {{-- <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                          <p class="fs-3 mb-0">last year</p> --}}
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-end">
                          <div
                            class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                            <i class="ti ti-pencil fs-6"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="earning"></div>
                </div>
              </div>
              <div class="col-lg-4">
                <!-- Monthly Earnings -->
                <div class="card">
                  <div class="card-body">
                    <div class="row alig n-items-start">
                      <div class="col-8">
                        <h5 class="card-title mb-9 fw-semibold"> Leaving Requests </h5>
                        <h4 class="fw-semibold mb-3">{{$leaving_requests->count()}}</h4>
                        <div class="d-flex align-items-center pb-1">
                          <span
                            class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                            <i class="ti ti-arrow-up text-danger"></i>
                          </span>
                          {{-- <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                          <p class="fs-3 mb-0">last year</p> --}}
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-end">
                          <div
                            class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                            <i class="ti ti-walk fs-6"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="earning"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Recent Leaving Requests</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered my-3 text-center">
                        <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>Request Day</th>
                                <th>Request time</th>
                                <th>Request Reason</th>
                                <th>Request Status</th>
                                <th>Details</th>
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
                                        <button class="btn btn-danger">
                                            <a href="/admin/users/leaving" class="text-decoration-none text-light">Details</a>
                                        </button>

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
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Recent Users</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle text-center">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Id</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Name</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Email</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Department</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Image</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                        {{-- display only 4 users --}}
                        @if (count($users) > 0)

                        @foreach ($users as $user)
                        <tr>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$user->id}}</h6></td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1">{{$user->name}}</h6>
                                <span class="fw-normal">{{$user->role}}</span>
                            </td>
                            <td class="border-bottom-0">
                              <p class="mb-0 fw-normal">{{$user->email}}</p>
                            </td>
                            <td class="border-bottom-0">
                                <span class="badge bg-primary rounded-3 fw-semibold">{{$user->department}}</span>

                            </td>
                            <td class="border-bottom-0">
                                @if ($user->image)
                        <h6 class="fw-semibold mb-0 fs-4"><img src={{asset('uploads/images/'.$user->image)}} style="border-radius:5px;" alt="profile" width="50" height="50"></h6>
                        @else
                        <h6 class="fw-semibold mb-0 fs-4"><img src={{asset('uploads/images/default.jpg')}} style="border-radius:5px;" alt="profile" width="50" height="50"></h6>
                        @endif
                            </td>
                          </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5"> No users </td>
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
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
</body>

</html>
