@extends('layouts.app')
@section('content')
    <div class="container jumbotron mt-4">
        <h1 class="display-4">Email Verification!</h1>
        <p class="lead">You will recieve a verification mail on your mail.</p>
        <hr class="my-4">
        <p>If somehow, you did not recieve the verification email.</p>
        <p class="lead">
        <form action="{{ route('verification.send') }}" method="post">
            @csrf
            <input type="submit" class="btn btn-primary btn-lg" value="RE-SEND Email">
        </form>
        </p>
    </div>
@endsection
