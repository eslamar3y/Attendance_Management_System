<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
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
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                {{-- <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../assets/images/logos/dark-logo.svg" width="180" alt="">
                </a> --}}
                <p class="text-center">AMS | Register</p>
                <form method="POST" action={{route('register')}}>
                    @csrf
                  <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="textHelp">
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        {{-- make me a select for departments --}}
                        <label for="department" class="form-label">Department</label>
                        <br>
                        <select name="department" id="department" class="form-control">
                            <optgroup label="Manegrial">
                                <option value="Finance">Finance</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Sales">Sales</option>
                                <option value="P&R">P&R</option>
                                <option value="HR">HR</option>
                            </optgroup>
                            <optgroup label="Technical">
                                <option value="IT" >IT</option>
                                <option value="Operations">Operations</option>
                                <option value="Production">Production</option>
                            </optgroup>
                        </select>

                    </div>
                    {{-- img --}}
                    {{-- <div class="mb-3">
                        <label for="img" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" name="image" id="img" aria-describedby="imgHelp">
                    </div> --}}
                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Register</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                    <a class="text-primary fw-bold ms-2" href={{route('login')}}>Log In</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
