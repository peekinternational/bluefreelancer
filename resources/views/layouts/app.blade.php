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
    <link rel="stylesheet" media="screen" href="{{ url('css/app.css') }}">
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="{{ url('assets/js/filepond.min.js') }}"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    {{-- <script src="{{ url('assets/js/quill.min.js') }}"></script> --}}
    <script src="{{ url('assets/js/script.js') }}"></script>
    <script src="{{ url('js/app.js') }}"></script>
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
</body>

</html>
