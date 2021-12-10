@extends('layouts.app')
@section('content')
<x-head-links></x-head-links>

<!-- Title -->
<div class="bg-secondary text-center bg-cover py-5"
    style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
    <h1 class="h5 font-weight-bold text-white">Dispute</h1>
</div>

<section class="container pb-5 mt-3 mb-3 mb-md-4">
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-freelancer" role="tabpanel"
            aria-labelledby="pills-freelancer-tab">
            <div class="card rounded-xl overflow-hidden">
                <div class="card-header bg-secondary">
                    <div class="nav nav-pills nav-pills-light nav-fill flex-column flex-md-row mb-md-n2" id="nav-tabs"
                        role="tablist">
                        <a class="nav-link py-2" href="#" disabled>Stage One</a>
                        <a class="nav-link py-2" href="#">Stage Two</a>
                        <a class="nav-link py-2" href="#">Stage Three</a>
                        <a class="nav-link py-2 active" href="#">Stage Four</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex">
        {{-- Notify --}}
        <div class="p-3 mt-4" style="background: #faff9d;border: 1px solid black;border-radius: 5px;width:100%">
            <h3><b>Stage 4 - Arbitration</b></h3>
            <ul>
                <li>If arbitration is agreed upon in the second stage bilateral consultation, move to the next stage.
                </li>
                <li>In step 3, both parties propose a final proposal for arbitration resolution, and the outsourced OK
                    arbitration resolution team makes decision based on the parties' demands.</li>
            </ul>
        </div>
    </div>

    <div>
        {{-- Main Content --}}

        <div class="d-flex m-4">
            <h2 class="text-success mx-auto">In Progress</h2>
        </div>

        {{-- <div class="d-flex my-3">
            <h4 class="font-weight-bold">Negotiation:</h4>
        </div>

        <div class="d-flex">
            <div class="col-md-8">
                <div class="d-flex">
                    <ul class="list-unstyled" style="width: 100%">
                        <li class="mb-2">
                            <div class="d-flex">
                                <div class="col-md-2">
                                    <img src="/assets/img/pages/default.png" alt=""
                                        style="max-width: 60px;border-radius: 30px;">
                                </div>
                                <div class="col-md-10 p-2" style="background:#d6d9db;border-radius:5px;">
                                    <div class="d-flex justify-content-between">
                                        <h6><b>username</b></h6>
                                        <span>1 Dec, 2021</span>
                                    </div>
                                    <hr class="m-0">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </div>
                            </div>
                        </li>
                        <li class="mb-2">
                            <div class="d-flex">
                                <div class="col-md-2">
                                    <img src="/assets/img/pages/default.png" alt=""
                                        style="max-width: 60px;border-radius: 30px;">
                                </div>
                                <div class="col-md-10 p-2" style="background:#d6d9db;border-radius:5px;">
                                    <div class="d-flex justify-content-between">
                                        <h6><b>username</b></h6>
                                        <span>1 Dec, 2021</span>
                                    </div>
                                    <hr class="m-0">
                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                        when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book.
                                        It has survived not only five centuries, but also the leap into electronic
                                        typesetting, remaining essentially unchanged.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 mx-2 p-2 mb-auto" style="background:#c3efff;border-radius:5px;">
                <div class="p-2">
                    <div class="d-flex justify-content-center">
                        <span>Total amount disputed: </span>
                        <h5><b>$10</b></h5>
                    </div>
                </div>
                <hr class="mx-4">
                <div class="d-flex justify-content-center">
                    <div class="col-6" style="border-right:1px solid rgba(0,0,0,0.1)">
                        <h6>Freelancer (YOU) Wants to receive: <b>$10</b></h6>
                    </div>
                    <div class="col-6">
                        <h6>Employer (username) wants to pay you: <b>$0</b></h6>
                    </div>
                </div>
                <hr class="mx-4">
                <div class="d-flex justify-content-center">
                    <span><b>Result: </b>$0 paid</span>
                </div>
                <div class="d-flex justify-content-center">
                    <span class="text-danger"><b>RESOLVED. DISPUTE CLOSED</b></span>
                </div>
            </div>
        </div> --}}

    </div>
</section>
@endsection