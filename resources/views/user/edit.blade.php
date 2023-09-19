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

          @include('user.components.sidebar')

        </div>
        <!-- End Sidebar scroll-->
      </aside>
      <!--  Sidebar End -->
      @include('user.components.alert')
    <!--  Main wrapper -->
    <div class="body-wrapper">

      <!--  Header Start -->
      <header class="app-header">
        @include('user.components.nav')
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4 text-center">Edit User</h5>
              <div class="card">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{route('update_current_user', $user->id)}}">
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
                                        <option value="{{$user->department}}" selected>{{$user->department}}</option>
                            </select>
                        </div>
                        <div>
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control">
                                    <option value="Member" selected>Member</option>
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
  <!-- Modal 2 -->
<div class="modal fade" id="leaveModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="leaveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title " id="leaveModalLabel">Leave Request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="post"  action={{route('request_leave')}}>
            @csrf
            <div>
                <label for="reason">Reason:</label>
                <input type="text" id="reason" class="form-control" name="reason">
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
  <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/js/sidebarmenu.js"></script>
  <script src="../../assets/js/app.min.js"></script>
  <script src="../../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>
