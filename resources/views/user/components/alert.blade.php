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
