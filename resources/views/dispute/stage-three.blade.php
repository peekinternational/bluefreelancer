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
                        <a class="nav-link py-2 active" href="#">Stage Three</a>
                        <a class="nav-link py-2" href="{{route('dispute.stage-four')}}">Stage Four</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex">
        {{-- Notify --}}
        <div class="p-3 mt-4" style="background: #faff9d;border: 1px solid black;border-radius: 5px;width:100%">
            <h3><b>Stage 3 - Final Offer/Evidence</b></h3>
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
        <div class="d-flex my-3">
            <h4 class="font-weight-bold">Negotiation:</h4>
        </div>

        <div class="d-flex">
            <div class="col-md-8">
                <div class="d-flex">
                    <ul class="list-unstyled" style="width: 100%">
                        @if ($disputeConversation->count())
                        @foreach ($disputeConversation as $item)
                        <li class="mb-2">
                            <div class="d-flex">
                                <div class="col-md-2">
                                    <img src="/uploads/users/{{$item->user_id}}/images/{{App\Models\User::where('id', $item->user_id)->first()->img}}"
                                        alt="" style="max-width: 60px;">
                                </div>
                                <div class="col-md-10 p-2" style="background:#d6d9db;border-radius:5px;">
                                    <div class="d-flex justify-content-between">
                                        <h6><b>{{App\Models\User::where('id', $item->user_id)->first()->username}}</b>
                                        </h6>
                                        <span>{{ $item->created_at->format('d M, Y') }}</span>
                                    </div>
                                    <hr class="m-0">
                                    <p>{{$item->message}}</p>
                                    @if ($item->file)
                                    <a href="/uploads/dispute/{{$item->file}}" download>{{$item->file}}</a>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @endforeach
                        @else
                        <li><span class="text-danger">No Negotiation yet!</span></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-4 mx-2 p-2 mb-auto" style="background:#c3efff;border-radius:5px;">
                <div class="p-2">
                    @if ($disputeArbitration->user_id != auth()->id() && ! App\Models\DisputeArbitration::count($dispute->id))
                    <div class="d-flex justify-content-center">
                        <a href="{{route('dispute.arbitration.store', $dispute->id)}}"
                            class="btn btn-info btn-sm">Proceed to Arbitration</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <span class="text-danger text-center">You have only {{
                            Carbon\Carbon::parse($disputeArbitration->created_at->addDays(4))->diffInDays(now()) }} Days
                            left for respond</span>
                    </div>
                    @endif

                    <div class="d-flex justify-content-center">
                        <span>Total amount disputed: </span>
                        <h5><b>${{$dispute->offer_amt}}</b></h5>
                    </div>
                </div>
                <hr class="mx-4">
                <div class="d-flex justify-content-center">
                    <div class="col-6" style="border-right:1px solid rgba(0,0,0,0.1)">
                        <h6>Freelancer ({{App\Models\User::where('id', $dispute->freelancer_id)->first()->username}})
                            Wants to receive: <b>${{ $dispute->freelancer_offer_amt ? $dispute->freelancer_offer_amt :
                                0}}</b></h6>
                    </div>
                    <div class="col-6">
                        <h6>Client ({{App\Models\User::where('id', $dispute->client_id)->first()->username}})
                            Wants to pay: <b>${{ $dispute->client_offer_amt ? $dispute->client_offer_amt :
                                0}}</b></h6>
                    </div>
                </div>
                <hr class="mx-4">
                <div class="d-flex justify-content-center">
                    {{-- <span><b>Result: </b>$0 paid</span> --}}
                </div>
                <div class="d-flex justify-content-center">
                    <span class="text-danger"><b>IN ARBITRATION</b></span>
                    {{-- <span class="text-danger"><b>RESOLVED. DISPUTE CLOSED</b></span> --}}
                </div>
            </div>
        </div>

    </div>
</section>
@endsection