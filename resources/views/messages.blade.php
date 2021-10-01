@extends('layouts.app')
<link rel="stylesheet" media="screen" href="{{ url('css/app.css') }}">
@section('content')
    <link rel="stylesheet" media="screen" href="{{ url('css/app.css') }}">
    <div id="app">
        <router-view :userdata="{{ auth()->user() }}"></router-view>
        <!-- <Profile :userdata="{{ auth()->user() }}"></Profile> -->
    </div>
    <script src="{{ url('js/app.js') }}"></script>
@endsection
