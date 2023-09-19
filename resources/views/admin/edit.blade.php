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
              <h5 class="card-title fw-semibold mb-4 text-center">Edit User</h5>
              <div class="card">
                <div class="card-body">
                    {{-- <form method="post" enctype="multipart/form-data" action="{{route('edit_user', $user->id)}}"> --}}
                    <form method="post" enctype="multipart/form-data" action="{{route('update_user', $user->id)}}">
                        @csrf
                        <div>
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" value=" {{ $user->name }}">
                        </div>
                        <div>
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                        </div>
                        <div>
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div>
                            <label for="department" >Department</label>
                            <select name="department" class="form-control" id="department">
                                @foreach($departments as $department)
                                    @if($department == $user->department)
                                        <option value="{{$department}}" selected>{{$department}}</option>
                                        @else
                                        <option value="{{$department}}">{{$department}}</option>
                                    @endif


                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control">
                                @if($user->role == 'Head')
                                    <option value="Head" selected>Head</option>
                                    <option value="Member">Member</option>
                                @else
                                    <option value="Head">Head</option>
                                    <option value="Member" selected>Member</option>
                                @endif
                            </select>
                        </div>

                        <div style="margin:10px;display:flex;justify-content:center;">
                            @if($user->image)

                                <img src="{{asset('uploads/images/'.$user->image)}}" style="border-radius: 10px;" alt="user" class="m-1"  height="100">

                            @else

                                <img src="{{asset('uploads/images/default.jpg')}}" style="border-radius: 10px;" alt="user" class="m-1"  height="100">

                            @endif
                        </div>

                        <div >
                            <label for="image" class="mr-3">Image</label>
                            <input name="image" id="image" type="file" class="form-control">
                        </div>
                    <button type="submit" class="btn btn-primary m-2">Save</button>
                    </div>
                    </form>
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
