@extends('layouts.app')
@section('content')
    <div id="app">
        <messages :userdata="{{ auth()->user() }}"></messages>
    </div>
@endsection
