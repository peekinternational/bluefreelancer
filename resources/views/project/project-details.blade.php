@extends('layouts.app')
@section('content')
<!-- Page Content -->
<x-head-links></x-head-links>

<!-- Title -->
<div class="bg-secondary text-center bg-cover py-5"
    style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
    <h1 class="h5 font-weight-bold text-white">{{ __('ProjectDetails') }}</h1>
</div>

<section class="container pt-5 mt-3 mt-md-4">
    <div class="card card-bordered card-body rounded-xl mb-4">
        <h2 class="h4 font-weight-bold mb-4">{{ $project->title }}</h2>

        <div class="row justify-content-between mx-0">
            <div class="col-md-10 col-lg-8 col-xl-7 bg-light rounded-lg">
                <div class="d-md-flex">
                    <div class="text-center px-3 pt-4 pb-3">
                        <div class="h5 font-weight-bold mb-3">{{ __('Applicants') }}</div>
                        <div class="h5 font-weight-bold text-primary mb-3">
                            {{ App\Models\Bid::getBids($project->project_id)->count() }}</div>
                    </div>

                    <div class="text-center px-3 pt-4 pb-3">
                        <div class="h5 font-weight-bold mb-3">{{ __('bidamount') }}</div>
                        <div class="h5 font-weight-bold text-primary mb-3">
                            {{ $project->currency == 'USD' ? '$' : '₩' }}
                            {{ App\Models\Bid::getBidAvgAmt($project->project_id) ?
                            number_format((float)App\Models\Bid::getBidAvgAmt($project->project_id), 2, '.', '') : '0'
                            }}
                        </div>
                    </div>

                    <div class="text-center px-3 pt-4 pb-3">
                        <div class="h5 font-weight-bold mb-3">{{ __('ProjectBudget') }}</div>
                        <div class="h5 font-weight-bold text-primary mb-3">
                            @if ($project->min_budget && $project->max_budget)
                            {{ $project->currency == 'USD' ? '$' : '₩' }} {{ $project->min_budget }} -
                            {{ $project->currency == 'USD' ? '$' : '₩' }} {{ $project->max_budget }}
                            @else
                            @if ($project->rate_status == '1')
                            {{ $project->fixed_rate }}
                            @else
                            {{ $project->hourly_rate . '/' . __('hourly') }}
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 bg-light rounded-lg">
                <div class="d-flex align-items-center justify-content-center h-100 px-3 py-4">
                    @if ($project->status == 1)
                    <div class="h6 font-weight-bold text-info-alt mb-0">
                        {{ $project->created_at->addDays(15)->format('M d, Y') }}
                        <br>
                        {{ __('Open') }}
                    </div>
                    @elseif($project->status == 2)
                    <div class="h5 font-weight-bold text-success-alt mb-0">
                        {{ __('Awarded') }}
                    </div>
                    @elseif($project->status == 3)
                    <div class="h5 font-weight-bold text-success-alt mb-0">
                        {{ __('Completedstatus') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container">
    <div class="collapse" id="collapseBid">
        <div class="card card-bordered rounded-xl mb-4">
            <div class="card-body">
                <form action="{{ route('bid.store') }}" method="post" id="bidForm">
                    @csrf
                    <input type="hidden" value="{{ $project->project_id }}" name="project_id">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <h5 class="card-title mb-3">{{ __('BID') }}:</h5>

                            <div class="row mb-2">
                                <label class="col-md-6" for="bidPrice">{{ __('YourBid') }}:</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                {{ $project->currency == 'USD' ? '$' : '₩' }}</div>
                                        </div>
                                        <input type="number" class="form-control" id="bidPrice" placeholder="0"
                                            onkeyup="bidPriceFun()" name="budget" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                {{ $project->currency == 'USD' ? 'USD' : 'KRW' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-6" for="bidPrice">{{ __('Paidtoyour') }}:</label>
                                <div class="col-md-6">
                                    <div class="input-group align-items-center">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-transparent border-0">
                                                {{ $project->currency == 'USD' ? '$' : '₩' }}</div>
                                        </div>
                                        <span id="bidPriceAmt">0</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-6" for="proposal">{{ __('ProposalTab') }}:</label>
                                <div class="col-md-6 input-group">
                                    <textarea class="form-control" name="proposal" id="proposal" cols="30" rows="10"
                                        placeholder="{{ __('ProposalDescription') }}" required
                                        value="{{ old('proposal') }}"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <div class="row justify-content-between mb-2">
                                <div class="col-md-6">
                                    <h5 class="card-title mb-3">{{ __('Deliverin') }}:</h5>

                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" placeholder="3" name="days" required
                                            value="{{ old('days') }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">{{__('days')}}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex justify-content-center border rounded-lg py-4"
                                        style="border-width: .25rem !important;">
                                        <span class="h2 text-heading mb-0" data-annual="0" data-monthly="0">{{
                                            auth()->user()->bids }}</span>
                                        <span class="align-self-end">
                                            /&nbsp;300
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-between mb-2">
                                <div class="col-md-6">
                                    <h5 class="card-title mb-3">{{ __('ProjectMilestone') }}:</h5>
                                </div>
                            </div>
                            <div class="row container">
                                <h6>{{ __('TotalMilestoneAmount') }}:
                                    {{ $project->currency == 'USD' ? '$' : '₩' }}
                                    <b><span id="milestoneAmt"></span></b>
                                </h6>
                            </div>
                            <div class="row container">
                                <span class="text-danger" id="milestoneError"></span>
                            </div>
                            <div class="row justify-content-between mb-2" id="milestoneInputBlock">
                                <div class="row col-md-12 mb-2">
                                    <div class="col-md-6">
                                        <input type="text" placeholder="{{ __('ProjectMil') }}" name="milestone_name[]"
                                            id="" class="form-control">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="number" class="form-control bidAmtItems" name="milestone_amt[]"
                                            id="milestone_amt" min="3" placeholder="For" onchange="addMilestoneAmt()">
                                    </div>
                                    <div class="col-md-1">
                                        <a href="javascript:void(0)" onclick="addMilestoneRow()" class="text-dark"><i
                                                class="fa fa-plus-circle"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block w-md-auto" value="{{ __('PlaceaBid') }}">
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card card-bordered card-body rounded-xl mb-4">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="font-weight-bold mb-3">{{ __('Description') }}</h5>
                        <div class="pt-1 mb-3">
                            <p class="mb-4">
                                {!! $project->description !!}
                            </p>
                            <span class="badge bg-success-alt text-white">{{ __('featured') }}</span>
                        </div>
                    </div>

                    <div class="col-md-4 text-md-right">
                        @if ($project->user_id != auth()->id())
                        @if (App\Models\Bid::isBidAvailable(auth()->id(), $project->project_id))
                        <button class="btn btn-info btn-sm mb-2 disabled">{{ __('AlreadyBid') }}</button>
                        @else
                        <button class="btn btn-primary mb-2" data-toggle="collapse" data-target="#collapseBid">{{
                            __('BidThisProject') }}</button>
                        @endif
                        @endif
                    </div>
                </div>

                <hr class="mb-4">

                <h5 class="font-weight-bold mb-3">{{ __('Skillsrequired') }}</h5>

                <div class="pt-1">
                    <ul class="list-inline">
                        @if ($project->skills)
                        @foreach (Illuminate\Support\Str::of($project->skills)->explode(',') as $skill)
                        <li
                            class="list-inline-item badge font-size-ms font-weight-bold text-primary border shadow-sm py-2 px-3">
                            {{ App\Models\User::skillTitle($skill)->title }}
                        </li>
                        @endforeach
                        @else
                        <li><span class="text-danger">{{ __('notFound') }}</span></li>
                        @endif
                    </ul>
                </div>
                @if ($project->image)
                <hr class="mb-4">
                <h5 class="font-weight-bold mb-3">{{ __('Fileattached') }}</h5>
                <div class="pt-1">
                    <a href="{{ url('uploads/project/images/' . $project->image) }}">{{ $project->image }}</a>
                </div>
                @endif
                <hr class="my-4">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('post-project') }}" class="btn btn-secondary mb-3">{{
                            __('PostProjectlikethis') }}</a>
                    </div>

                    <div class="col-md-6 text-md-right">
                        <h6 class="font-weight-bold mb-3">{{ __('ProjectID') }}: {{ $project->project_id }}</h6>
                        <div class="pt-1">
                            <a href="#" class="text-danger">{{ __('ReportProject') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-bordered rounded-xl mb-4">
                <div class="card-header text-center">
                    <h5 class="font-weight-bold">{{ __('ClientInformation') }}</h5>
                </div>

                <div class="media p-4">
                    <img class="avatar-bordered rounded-circle shadow-lg"
                        src="{{ $project->user->img == '' ? url('assets/img/pages/default.png') : url('uploads/users/' . $project->user->id . '/images/' . $project->user->img) }}"
                        width="128" alt="User thumbnail">

                    <div class="media-body ml-3">
                        <h6 class="card-title mt-3 mb-2">{{ $project->user->username }}</h6>
                        <div class="card-text mb-3">
                            <strong class="text-dark">{{ __('MemberSince') }}</strong>
                            {{ $project->user->created_at->format('Y') }}
                        </div>
                        <div class="pb-3 mb-1">
                            <div class="d-flex align-items-center mb-3">
                                <span
                                    class="badge bg-warning text-white mr-2">{{App\Models\User::find($project->user->id)->rating
                                    ? App\Models\User::find($project->user->id)->rating : '0.00'}}</span>
                                @php
                                $stars =
                                Illuminate\Support\Str::of(App\Models\User::find($project->user->id)->rating)->explode('.');
                                @endphp
                                <div class="ratings">
                                    @for ($i = 0; $i < 5; $i++) @if ($i < $stars[0]) <i class="fa fa-star active mr-1">
                                        </i>
                                        @else
                                        <i class="fa fa-star-o mr-1"></i>
                                        @endif
                                        @endfor
                                </div>
                            </div>
                            <div class="font-size-sm">{{App\Models\Feedback::reviews($project->user->id)}} Reviews</div>
                        </div>
                    </div>
                </div>

                <div class="text-center px-4 pb-4">
                    <div class="icon mx-1">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <div class="icon mx-1">
                        <i class="fa fa-asterisk"></i>
                    </div>
                    <div class="icon mx-1">
                        <i class="fa fa-phone"></i>
                    </div>
                    @if ($project->user->email_verified_at)
                    <div class="icon border-info text-info mx-1">
                        <i class="fa text-info fa-envelope"></i>
                    </div>
                    @else
                    <div class="icon mx-1">
                        <i class="fa fa-envelope"></i>
                    </div>
                    @endif

                </div>
            </div>

            <p class="font-size-sm font-weight-bold text-danger">
                <i class="fa fa-warning mr-2"></i>
                {{ __('SubjecttoSanctions') }}
            </p>
        </div>
    </div>
</section>

<section class="container pb-5 mb-3 mb-md-4">
    <div class="card mb-4">
        <div class="card-header bg-gray-800 border-dark">
            <div class="font-weight-bold text-white d-md-none">{{ __('ProjectAward') }}</div>

            <div class="row">
                <div class="col-md-6 d-none d-md-block">
                    <div class="font-weight-bold text-white">{{ __('ProjectSelection') }}
                        {{-- ({{ $bidsSeleProjCount }}) --}}
                    </div>
                </div>

                <div class="col-md-3 d-none d-md-block">
                    <div class="font-weight-bold text-white">{{ __('Reputation') }}</div>
                </div>

                <div class="col-md-3 d-none d-md-block text-md-center">
                    <div class="font-weight-bold text-white">{{ __('Supportbidamount') }}</div>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if ($bidsSeleProjCount->count())
            @foreach ($bidsOnProject as $item)
            @if ($item->status > 1)
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="media">
                        <img class="rounded-xl mr-1"
                            src="{{ $item->user->img == '' ? url('assets/img/pages/default.png') : url('uploads/users/' . $item->user->id . '/images/' . $item->user->img) }}"
                            width="64" alt="{{ $item->user->username }}">
                        <div class="media-body pl-3">
                            <h6 class="font-weight-bold mb-1">
                                <a href="#">{{ $item->user->username }}</a>
                            </h6>
                            <p class="font-size-ms mb-0">{{ $item->user->created_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-warning text-white mr-2">{{App\Models\User::find($item->user->id)->rating
                            ?
                            App\Models\User::find($item->user->id)->rating : '0.00'}}</span>
                        @php
                        $stars =
                        Illuminate\Support\Str::of(App\Models\User::find($item->user->id)->rating)->explode('.');
                        @endphp
                        <div class="ratings">
                            @for ($i = 0; $i < 5; $i++) @if ($i < $stars[0]) <i class="fa fa-star active mr-1"></i>
                                @else
                                <i class="fa fa-star-o mr-1"></i>
                                @endif
                                @endfor
                        </div>
                    </div>
                    <div class="font-size-sm">{{App\Models\Feedback::reviews($item->user->id)}} Reviews</div>
                </div>

                <div class="col-md-3 text-md-center" id="projectSeleLastCol">
                    <h6 class="font-weight-bold">{{ $project->currency == 'USD' ? '$' : '₩' }}
                        {{ $item->budget }}</h6>
                    <p class="font-size-ms mb-0">{{ $item->day }} Days</p>
                    @if ($item->user->id === auth()->id())
                    @if ($item->status == 2)
                    <input type="hidden" id="proposal_id" value="{{ $item->id }}">
                    <ul class="list-inline" id="proposalOptionRow">
                        <li class="list-inline-item">
                            <button type="submit" class="btn btn-sm btn-success mx-2" id="proposalAppBtn">{{
                                __('Approve') }}</button>
                        </li>
                        <li class="list-inline-item">
                            <button type="submit" class="btn btn-sm btn-danger mx-2" id="proposalRejBtn">{{ __('Reject')
                                }}</button>
                        </li>
                    </ul>
                    @elseif($item->status == 3)
                    <button class="btn btn-sm btn-info mx-2 disabled">{{ __('UApprovedIt') }}</button>
                    @elseif($item->status == 0)
                    <button class="btn btn-sm btn-danger mx-2 disabled">{{ __('URejectedIt') }}</button>
                    @endif
                    @endif
                </div>
            </div>
            {{-- <div class="row"> --}}

                @if ($project->status == 3 && $item->user_id == auth()->id())
                @if (!App\Models\Feedback::isExist(auth()->id(), 2, $project->project_id))
                <a href="{{route('project.feedback', ['id' => $project->project_id, 'user' => $project->user_id, 'type' => 2])}}"
                    class="btn btn-info btn-sm my-3">Give Feedback to Client</a>

                @else
                <span class="btn btn-success btn-sm disabled my-3">Feedback Submitted</span>
                @endif
                @endif
                @if ($item->milestones->count())
                @if ($item->user_id == auth()->id())
                <h5><strong>Milestones:</strong></h5>
                <div class="row">
                    <div class="col-md-4">
                        <h6><strong>{{ __('fileName') }}</strong></h6>
                    </div>
                    <div class="col-md-2">
                        <h6><strong>{{ __('Amount') }}</strong></h6>
                    </div>
                    <div class="col-md-2">
                        <h6><strong>{{ __('Status') }}</strong></h6>
                    </div>
                    <div class="col-md-4">
                        <h6><strong>{{ __('Action') }}</strong></h6>
                    </div>
                </div>
                @foreach ($item->milestones as $milestone)
                <div class="row">
                    <div class="col-md-4">
                        <span>{{ $milestone->name }}</span>
                    </div>
                    <div class="col-md-2">
                        <span>{{ $milestone->amount }}</span>
                    </div>
                    <div class="col-md-2">
                        <span>
                            @if ($milestone->status == 1)
                            {{ __('RequestRelease') }}
                            @elseif($milestone->status == 2)
                            {{ __('Deposit') }}
                            @elseif($milestone->status == 3)
                            {{ __('RejectedByProjectOwner') }}
                            @elseif($milestone->status == 4)
                            {{ __('Paid') }}
                            @endif
                        </span>
                    </div>
                    <div class="col-md-4 row">
                        @if ($milestone->status == 1)
                        <form action="{{ route('milestone.destory', $milestone->id) }}" method="post">
                            @csrf
                            <input type="submit" value="{{ __('Cancel') }}" class="btn btn-dark mx-2"
                                onclick="return confirm('Are you sure you want to cancel this milestone?')">
                        </form>
                        @elseif ($milestone->status == 2)
                        <form action="{{ route('milestone.rrd',  $milestone->id)}}" method="POST">
                            @csrf
                            <input type="submit" value="{{ __('Dispute') }}" class="btn btn-danger mx-2">
                        </form>
                        @elseif ($milestone->status == 4)
                        <form action="{{ route('milestone.rrd',  $milestone->id)}}" method="POST">
                            @csrf
                            <input type="submit" name="refund" value="{{ __('Refund') }}" class="btn btn-dark mx-2"
                                onclick="return confirm('Are you sure you want to refund this milestone?')">
                            <input type="hidden" name="project_id" value="{{ request()->route('id') }}">
                            {{-- <input type="submit" value="{{ __('Dispute') }}" class="btn btn-danger mx-2"> --}}
                        </form>
                        @endif

                    </div>
                </div>
                <hr>
                @endforeach
                @endif
                @else
                <span class="text-danger">{{ __('notFound') }}</span>
                @endif
                {{--
            </div> --}}
            @endif
            @endforeach
            @else
            <span class="text-danger">{{ __('projSelecExist') }}</span>
            @endif
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header bg-gray-800 border-dark">
            <div class="font-weight-bold text-white d-md-none">{{ __('BidThisProject') }}</div>

            <div class="row">
                <div class="col-md-6 d-none d-md-block">
                    <div class="font-weight-bold text-white">{{ __('BidThisProject') }} ({{ $bidsOnProjCount }})
                    </div>
                </div>

                <div class="col-md-3 d-none d-md-block">
                    <div class="font-weight-bold text-white">{{ __('Reputation') }}</div>
                </div>

                <div class="col-md-3 d-none d-md-block text-md-center">
                    <div class="font-weight-bold text-white">{{ __('Supportbidamount') }}</div>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if ($bidsOnProject->count())
            @foreach ($bidsOnProject as $item)
            @if ($item->status == 1)
            <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="media">
                        <img class="rounded-xl mr-1"
                            src="{{ $item->user->img == '' ? url('assets/img/pages/default.png') : url('uploads/users/' . $item->user->id . '/images/' . $item->user->img) }}"
                            width="64" alt="user">
                        <div class="media-body pl-3">
                            <h6 class="font-weight-bold mb-1">
                                <a href="#">{{ $item->user->username }}</a>
                            </h6>
                            <p class="font-size-ms mb-0">
                                {{ $item->user->created_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-warning text-white mr-2">{{App\Models\User::find($item->user->id)->rating
                            ?
                            App\Models\User::find($item->user->id)->rating : '0.00'}}</span>
                        @php
                        $stars =
                        Illuminate\Support\Str::of(App\Models\User::find($item->user->id)->rating)->explode('.');
                        @endphp
                        <div class="ratings">
                            @for ($i = 0; $i < 5; $i++) @if ($i < $stars[0]) <i class="fa fa-star active mr-1"></i>
                                @else
                                <i class="fa fa-star-o mr-1"></i>
                                @endif
                                @endfor
                        </div>
                    </div>
                    <div class="font-size-sm">{{App\Models\Feedback::reviews($item->user->id)}} Reviews</div>
                </div>

                <div class="col-md-3 text-md-center">
                    <h6 class="font-weight-bold">{{ $project->currency == 'USD' ? '$' : '₩' }}
                        {{ $item->budget }}</h6>
                    <p class="font-size-ms mb-0">{{ $item->day }} {{ __('days') }}</p>
                    @if ($item->user->id === auth()->id())
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="{{ route('bid.show', $item->id) }}"
                                class="btn btn-sm btn-info mx-2">{{ __('Edit') }}</a></li>
                        <li class="list-inline-item">
                            <form action="{{ route('bid.destory', $item->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button onclick="return confirm('Are you Sure?')" type="submit"
                                    class="btn btn-sm btn-danger mx-2">{{ __('Delete') }}</button>
                            </form>
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
            @endif
            @endforeach
            @else
            <div class="row">
                <span class="text-danger">{{ __('projBidExist') }}</span>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection