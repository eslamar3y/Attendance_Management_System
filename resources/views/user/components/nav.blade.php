<nav class="navbar navbar-expand-lg navbar-light">

    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
      <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
            aria-expanded="false">
            <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
            <div class="message-body">

                {{-- check if the current time between 9am and 5pm make a link is request to leave else make it leave  --}}
                @if (date('H') >= 9 && date('H') <= 17)
                    @if($leaving_request_status)
                        @if ($leaving_request_status == 'pending')
                            <button type="button" class="btn btn-outline-primary mx-3 mt-2 d-block" disabled>
                                Request to leave
                            </button>
                        @elseif($leaving_request_status == 'Approved')
                            <a href={{route('leave')}} class="btn btn-outline-primary mx-3 mt-2 d-block">Leave</a>
                        @else
                            <button type="button" class="btn btn-outline-primary mx-3 mt-2 d-block" data-bs-toggle="modal" data-bs-target="#leaveModal">
                                Request to leave
                            </button>
                        @endif
                    @else
                        <button type="button" class="btn btn-outline-primary mx-3 mt-2 d-block" data-bs-toggle="modal" data-bs-target="#leaveModal">
                            Request to leave
                        </button>
                    @endif
                @else
                    <a href={{route('leave')}} class="btn btn-outline-primary mx-3 mt-2 d-block">Leave</a>
                @endif

              {{-- <a href={{route('logout')}} class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a> --}}
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>
