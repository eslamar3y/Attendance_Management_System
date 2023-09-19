<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AMS | Head</title>
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

        @include('head.components.sidebar')

      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        {{-- display success message and make it disappear after 3 seconds --}}
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
      <div class="container-fluid text-center">
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Head</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th >
                          <h6 class="fw-semibold mb-0">Id</h6>
                        </th>
                        <th >
                          <h6 class="fw-semibold mb-0">Name</h6>
                        </th>
                        <th >
                          <h6 class="fw-semibold mb-0">Email</h6>
                        </th>
                        <th >
                          <h6 class="fw-semibold mb-0">Department</h6>
                        </th>
                        <th >
                          <h6 class="fw-semibold mb-0">role</h6>
                        </th>
                        <th>
                            <h6 class="fw-semibold mb-0">Actions</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)
                        @if ($user->role == 'Head')
                        <tr>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$user->id}}</h6></td>
                            <td class="border-bottom-0">
                                <p class="fw-semibold mb-0">{{$user->name}}</p>
                            </td>
                            <td class="border-bottom-0">
                              <p class="mb-0 fw-normal">{{$user->email}}</p>
                            </td>
                            <td class="border-bottom-0">
                                <span class="badge bg-secondary rounded-3 fw-semibold">{{$user->department}}</span>

                            </td>
                            <td class="border-bottom-0">
                              <h6 class="fw-semibold mb-0 fs-4">{{$user->role}}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <a href="/head/edit/{{$user->id}}" style="font-size:25px;color:#539BFF;background: none;border: none;"><i class="ti ti-pencil"></i></a>

                            </td>
                          </tr>
                          @endif
                        @endforeach
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
                <h5 class="card-title fw-semibold mb-4"
                style="display: flex; justify-content: space-between; align-items: center;"
                >Members:
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add</button>
                </h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>
                              <h6 class="fw-semibold mb-0">Id</h6>
                            </th>
                            <th>
                              <h6 class="fw-semibold mb-0">Name</h6>
                            </th>
                            <th>
                              <h6 class="fw-semibold mb-0">Email</h6>
                            </th>
                            <th>
                              <h6 class="fw-semibold mb-0">Department</h6>
                            </th>
                            <th>
                              <h6 class="fw-semibold mb-0">role</h6>
                            </th>
                            <th>
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                          </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        @if ($user->role != 'Head')
                        <tr>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$user->id}}</h6></td>
                            <td class="border-bottom-0">
                                <p class="fw-semibold mb-0">{{$user->name}}</p>
                            </td>
                            <td class="border-bottom-0">
                              <p class="mb-0 fw-normal">{{$user->email}}</p>
                            </td>
                            <td class="border-bottom-0">
                                <span class="badge bg-secondary rounded-3 fw-semibold">{{$user->department}}</span>

                            </td>
                            <td class="border-bottom-0">
                              <h6 class="fw-semibold mb-0 fs-4">{{$user->role}}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <a href="/head/edit/{{$user->id}}" style="font-size:25px;color:#539BFF;background: none;border: none;"><i class="ti ti-pencil"></i></a>
                                <a href="{{ route('deleteUser', $user->id) }}" style="font-size:25px; color:red;background: none;border: none;" onclick="return confirm('Are you sure you want to delete this user?')"><i class="ti ti-trash"></i></a>
                                <a href="/head/profile/{{$user->id}}" style="font-size:25px;color:green;background: none;border: none;"><i class="ti ti-eye"></i></a>
                            </td>
                          </tr>
                          @endif
                        @endforeach
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
  {{-- modals --}}
  <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title " id="staticBackdropLabel">Add User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="post" enctype="multipart/form-data" action={{route('add_user')}}>
                @csrf
                <div>
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" >
                </div>
                <div>
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div>
                    <label for="department" >Department</label>
                    <input type="text" class="form-control" name="department" value={{$name}} readonly>
                </div>
                <div>
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="Member">Member</option>
                    </select>
                </div>
                <div>
                    <label for="image">Image</label>
                    <input name="image" id="image" type="file" class="form-control">
                </div>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
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
