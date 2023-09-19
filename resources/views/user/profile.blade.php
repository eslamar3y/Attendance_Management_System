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
              <h5 class="card-title fw-semibold mb-4 text-center">{{$user->name}} profile</h5>
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
              </div>
              <a href="/user/edit" class="btn btn-primary">Edit</a>
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
