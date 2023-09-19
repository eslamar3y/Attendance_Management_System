<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AMS | User</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <style>
    .container-fluid
    {
        height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            /* background-color: #292930; */
    }
    p#real-time-clock {
            font-size: 7em;
            font-weight: 900;
            font-family: math;
        }
  </style>
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

        @include('user.components.sidebar')

      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        @include('user.components.nav')
      </header>
      <!--  Header End -->
      @include('user.components.alert')
      <div class="container-fluid">
        <!--  Row 1 -->
        <p id="real-time-clock">{{ now() }}</p>


      </div>
    </div>

  </div>

<!-- Modal -->
<div class="modal fade" id="questionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="questionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title " id="questionModalLabel">Check attendence</h5>
        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
        <form method="post"  action={{route('check_answer')}}>
            @csrf
            <div>
                <h2 id="question"></h2>
            </div>
            <div>
                <label for="">answer</label>
                <input type="text" class="form-control" name="answer">
            </div>
            <div>
                <input type="text" style="display:none" id="Qid" class="form-control" name="Qid">
            </div>

        </div>
        <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
        <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
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
<script src="{{ 'assets/js/real-time-clock.js' }}"></script>
  <script src="../assets/js/real-time-clock.js"></script>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>

  <?php
// Generate random time between 9am and 5pm
$random_time1 = rand(9, 17) . ':' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT) . ':00';
$random_time2 = rand(9, 17) . ':' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT) . ':00';

?>


    <script>





    function showModel() {
        // get question first from endpoint: /api/questions/random and store the question
        fetch('/api/questions/random')
            .then(response => response.json())
            .then(data => {
                // Display the question in the modal
                document.getElementById('question').innerHTML = `
                    ${data[0]['question']}
                `;
                document.getElementById('Qid').value = data[0]['id'];


                // Show the modal
                $('#questionModal').modal('show');
            });
    }



        // Check if random times are already stored in local storage
        const storedTime1 = localStorage.getItem('random_time1');
        const storedTime2 = localStorage.getItem('random_time2');

        if (!storedTime1) {
            // Generate random time for Time 1 only if it's not already stored
            const randomTime1 = '<?php echo $random_time1; ?>';
            localStorage.setItem('random_time1', randomTime1);
        }

        if (!storedTime2) {
            // Generate random time for Time 2 only if it's not already stored
            const randomTime2 = '<?php echo $random_time2; ?>';
            localStorage.setItem('random_time2', randomTime2);
        }

        // check if the current time is equal to the random time stored in local storage
        // if yes, show the modal
        // if no, do nothing
        setInterval(function() {
            const storedTime1 = localStorage.getItem('random_time1');
            const storedTime2 = localStorage.getItem('random_time2');

            const currentTime = new Date().toLocaleTimeString('en-US', {
                hour12: false,
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric'
            });

            if (currentTime === storedTime1 || currentTime === storedTime2) {
                showModel();
            }

        }, 1000);


    </script>

</body>

</html>
