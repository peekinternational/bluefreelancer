@extends('layouts.app')
@section('content')
    <div id="app">
    	 <router-view :userdata="{{ auth()->user() }}"></router-view>
        <!-- <Profile :userdata="{{ auth()->user() }}"></Profile> -->
    </div>
@endsection
