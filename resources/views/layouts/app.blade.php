<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- SEO meta tags -->
    <meta name="author" content="Sarfaraz Nawaz">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap + Vendor CSS -->
    <link rel="stylesheet" media="screen" href="{{ url('assets/css/style.min.css') }}">
    
    <link rel="stylesheet" media="screen" href="{{ url('assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" type="text/css">
    <!-- Title -->
    <title>Bluefreelancer | Home</title>
</head>

<body class="bg-light">

    {{ View::make('layouts.header') }}
    @yield('content')
    {{ View::make('layouts.footer') }}

    <!-- JavaScript -->
    <audio id="messagetone" muted>
        <source src="{{ asset('bell.mp3')}}" type="audio/ogg">
        <source src="{{ asset('bell.mp3')}}" type="audio/mpeg">
      </audio>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="{{ url('assets/js/filepond.min.js') }}"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="{{ url('assets/js/nouislider.min.js') }}"></script>
    <script src="{{ url('assets/js/script.js') }}"></script>
    
    <script src="{{ url('assets/js/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ url('assets/js/ajax.js') }}"></script>
    <script src="{{ url('assets/js/custom-script.js') }}"></script>
    
    <script>
        @if (Session::has('message'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    <script src="https://peekvideochat.com:22000/socket.io/socket.io.js"></script>
    @if(auth()->user())
    <script type="text/javascript">
        const socket = io.connect('https://peekvideochat.com:22000');
        var user_id = "{{auth()->user()->id}}";
        // alert(user_id);
        socket.on('birdsreceivemsg', function(data) {
          // console.log(data);
          if( user_id == data.message_receiver){
            var messagetone = document.getElementById("messagetone");
            messagetone.play();
            messagetone.muted = false;
             $.ajax({
                  url: "/messsageCount/"+user_id,
                  type: "GET"
                }).then(function(res) {
                  $('.messageCount').html(res);
                })

          }

        });
    </script>
    @endif
</body>

</html>
