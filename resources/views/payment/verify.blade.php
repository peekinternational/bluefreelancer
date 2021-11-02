@extends('layouts.app')
@section('content')
<!-- Title -->
<div class="bg-secondary text-center bg-cover py-5"
    style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
    <h1 class="h5 font-weight-bold text-white">PayPal Account Verification</h1>
</div>

<section class="container py-5 my-3 my-md-4">
    <div class="text-center">
        <h2 class="h3 font-weight-bold mb-3">Verify your PayPal account information</h2>
        <h5 class="h6 font-weight-bold mb-5">You can authenticate with your PayPal account information.</h5>

        <img class="mb-4" src="{{ url('assets/img/pages/verify-payment/01.png')}}" alt="Illustration">

        <h6 class="font-size-lg font-weight-bold">Secure payment system</h6>
        <p class="mb-4">All fees will be charged to you upon payment of PayPal.</p>

        <img class="mb-4" src="{{ url('assets/img/pages/verify-payment/02.png') }}" width="200" alt="Illustration">

        <div class="pt-2">
            @if (!auth()->user()->paypal_verified)
            <form action="{{ route('payment') }}" method="get">
                @csrf
                <input type="hidden" name="paypal_deposit_amt" value="1">
                <input type="submit" value="{{ __('RequireCertification') }}" class="btn btn-sm btn-info">
            </form>
            @else
                <button disabled="disabled" class="btn btn-success">Your payment method is already verified</button>
            @endif
        </div>
    </div>
</section>
@endsection