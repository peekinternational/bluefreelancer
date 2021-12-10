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
                        <a class="nav-link py-2 active" href="#">Stage Two</a>
                        <a class="nav-link py-2" href="#">Stage Three</a>
                        <a class="nav-link py-2" href="#">Stage Four</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex">
        {{-- Notify --}}
        <div class="p-3 mt-4" style="background: #faff9d;border: 1px solid black;border-radius: 5px;width:100%">
            <h3><b>Stage 2 - Negotiations</b></h3>
            <ul>
                <li>Freelancer strongly recommends you communicate clearly with the other party to resolve the matter.
                </li>
                <li>After 3 days either party may elect to move the dispute to arbitration at a fee of $25 USD where the
                    dispute will escalate to Stage 3. The other party will then have 3 days also during this stage to
                    agree to pay and for both parties to submit any final evidence. The arbitration fee will then be
                    refunded to the winner of the dispute.</li>
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
                <form action="{{route('dispute.conversation.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="dispute_id" value="{{$dispute->id}}">
                    <div class="d-flex">
                        <h5 class="font-weight-bold">Respond to other party:</h5>
                    </div>
                    @error('dispute_cmnt')
                    <div class="d-flex">
                        <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                    <div class="d-flex mb-3">
                        <textarea name="dispute_cmnt" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="d-flex">
                        <h6 class="font-weight-bold">You may attach documentation to support your case:</h6>
                    </div>
                    <div class="d-flex">
                        <input type="file" name="dispute_two_file">
                    </div>
                    <div class="d-flex mb-3">
                        <small class="text-danger"><b>Note:</b> You can only upload the docx, doc and zip file. And size
                            is
                            2MB</small>
                    </div>
                    <div class="d-flex">
                        <input type="submit" name="submit" value="Reply" class="btn btn-warning">
                    </div>
                </form>
            </div>
            <div class="col-md-4 mx-2 p-2 mb-auto" style="background:#c3efff;border-radius:5px;">
                <div class="p-2">
                    @if ($dispute->status == 2)
                    <div class="d-flex justify-content-center">
                        <a href="{{route('dispute.arbitration.store', $dispute->id)}}" class="btn btn-info btn-sm">Proceed to Arbitration</a>
                    </div>
                    @elseif($dispute->status == 3)
                    <div class="d-flex justify-content-center">
                        <span class="text-success font-weight-bold"> Dispute has been resolved </span>
                    </div>
                    @else
                    <div class="d-flex justify-content-center">
                        <h4><b>{{ Carbon\Carbon::parse($dispute->created_at->addDays(4))->diffInDays(now()) }} Days
                                left</b></h4>
                    </div>
                    <div class="d-flex justify-content-center">
                        <span>for {{App\Models\User::where('id',
                            $dispute->to)->first()->username}} to respond</span>
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
                        @if ($dispute->client_id == auth()->id() && $dispute->freelancer_offer_amt)
                        <form action="{{route('dispute.offer-accept')}}" method="POST">
                            @csrf
                            <input type="hidden" name="accept_offer_amt" value="{{$dispute->freelancer_offer_amt}}">
                            <input type="hidden" name="dispute_id" value="{{$dispute->id}}">
                            <input type="submit" class="btn btn-success btn-sm" value="Accept Offer"
                                onclick="return confirm('are you sure you want to accept?')">
                        </form>
                        @endif
                    </div>
                    <div class="col-6">
                        <h6>Client ({{App\Models\User::where('id', $dispute->client_id)->first()->username}})
                            Wants to pay: <b>${{ $dispute->client_offer_amt ? $dispute->client_offer_amt :
                                0}}</b></h6>
                        @if ($dispute->freelancer_id == auth()->id() && $dispute->client_offer_amt)
                        <form action="{{route('dispute.offer-accept')}}" method="POST">
                            @csrf
                            <input type="hidden" name="accept_offer_amt" value="{{$dispute->client_offer_amt}}">
                            <input type="hidden" name="dispute_id" value="{{$dispute->id}}">
                            <input type="submit" class="btn btn-success btn-sm" value="Accept Offer"
                                onclick="return confirm('are you sure you want to accept?')">
                        </form>
                        @endif
                    </div>
                </div>
                <hr class="mx-4">
                <div class="d-flex justify-content-center">
                    @if ($dispute->client_id == auth()->id())
                    <span>New Offer you wish to pay</span>
                    @else
                    <span>New Offer you wish to receive</span>
                    @endif
                </div>
                <form action="{{route('dispute.new-offer')}}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <span><b>$</b></span>
                        &nbsp;
                        <input type="number" name="dispute_new_offer_amt" style="width:30%">
                        <input type="hidden" name="dispute_id" value="{{$dispute->id}}">
                        &nbsp;
                        <input type="submit" value="Submit" class="btn btn-sm btn-primary">
                    </div>
                </form>
                <div class="d-flex justify-content-center">
                    <span><b>Please enter an amount between $1 and ${{$dispute->offer_amt}}</b></span>
                </div>
                @if ($dispute->from == auth()->id() && $dispute->status == 2)
                <hr class="mx-4">
                <div class="d-flex justify-content-center">
                    <form action="{{ route('dispute.cancel', $dispute->id) }}" method="POST">
                        @csrf
                        <input type="submit" name="dispute_cancel" value="Cancel Dispute" class="btn btn-info btn-md">
                    </form>
                </div>
                @endif
            </div>
        </div>

    </div>
</section>
@endsection