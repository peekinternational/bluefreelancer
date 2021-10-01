@extends('layouts.app')
@section('content')
    <!-- Page Content -->
    <div class="bg-secondary py-4">
        <div class="container pt-2 pb-3">
            <div class="d-flex flex-column flex-md-row align-items-center">
                <a href="/project-listing" class="btn btn-block bg-gray-800 text-white w-md-auto mt-2 mr-md-2">Browse
                    Projects</a>
                <a href="/contest-listing" class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">Browse
                    Contests</a>
                <a href="/browse/category" class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">Browse
                    Categories</a>
                <a href="/showcases" class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">Showcase</a>
                <a href="/post-contest" class="btn btn-block btn-primary w-md-auto ml-auto">Start a Contest</a>
            </div>
        </div>
    </div>

    <!-- Title -->
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
        <h1 class="h5 font-weight-bold text-white">Project Details</h1>
    </div>

    <section class="container pt-5 mt-3 mt-md-4">
        <div class="card card-bordered card-body rounded-xl mb-4">
            <h2 class="h4 font-weight-bold mb-4">{{ $project->title }}</h2>

            <div class="row justify-content-between mx-0">
                <div class="col-md-10 col-lg-8 col-xl-7 bg-light rounded-lg">
                    <div class="d-md-flex">
                        <div class="text-center px-3 pt-4 pb-3">
                            <div class="h5 font-weight-bold mb-3">Applicants</div>
                            <div class="h5 font-weight-bold text-primary mb-3">
                                {{ App\Models\Bid::getBids($project->project_id)->count() }}</div>
                        </div>

                        <div class="text-center px-3 pt-4 pb-3">
                            <div class="h5 font-weight-bold mb-3">Average Bid Amount</div>
                            <div class="h5 font-weight-bold text-primary mb-3">
                                {{ $project->currency == 'USD' ? '$' : '₩' }}
                                {{ App\Models\Bid::getBidAvgAmt($project->project_id) ? App\Models\Bid::getBidAvgAmt($project->project_id) : '0' }}
                            </div>
                        </div>

                        <div class="text-center px-3 pt-4 pb-3">
                            <div class="h5 font-weight-bold mb-3">Project Budget</div>
                            <div class="h5 font-weight-bold text-primary mb-3">
                                @if ($project->min_budget && $project->max_budget)
                                    {{ $project->currency == 'USD' ? '$' : '₩' }} {{ $project->min_budget }} -
                                    {{ $project->currency == 'USD' ? '$' : '₩' }} {{ $project->max_budget }}
                                @else
                                    @if ($project->rate_status == '1')
                                        {{ $project->fixed_rate }}
                                    @else
                                        {{ $project->hourly_rate . '/Hourly' }}
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
                                Open
                            </div>
                        @elseif($project->status == 2)
                            <div class="h5 font-weight-bold text-success-alt mb-0">
                                Awarded
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
                                <h5 class="card-title mb-3">Bid:</h5>

                                <div class="row mb-2">
                                    <label class="col-md-6" for="bidPrice">Paid to you:</label>

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
                                    <label class="col-md-6" for="bidPrice">Your Bid:</label>
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
                                    <label class="col-md-6" for="proposal">Proposal:</label>
                                    <div class="col-md-6 input-group">
                                        <textarea class="form-control" name="proposal" id="proposal" cols="30" rows="10"
                                            placeholder="Write You Project Proposal Description" required value="{{ old('proposal') }}"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <div class="row justify-content-between mb-2">
                                    <div class="col-md-6">
                                        <h5 class="card-title mb-3">Deliver In:</h5>

                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" placeholder="3" name="days" required
                                                value="{{ old('days') }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">Days</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center border rounded-lg py-4"
                                            style="border-width: .25rem !important;">
                                            <span class="h2 text-heading mb-0" data-annual="0"
                                                data-monthly="0">{{ auth()->user()->bids }}</span>
                                            <span class="align-self-end">
                                                /&nbsp;300
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between mb-2">
                                    <div class="col-md-6">
                                        <h5 class="card-title mb-3">Milstone:
                                            <a href="javascript:void(0)" onclick="addMilestoneRow()"><i
                                                    class="fa fa-plus-circle"></i></a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row container">
                                    <h6>Total Milestone Amount:
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
                                            <input type="text" placeholder="Project Milestone" name="milestone_name[]" id=""
                                                class="form-control">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="number" class="form-control bidAmtItems" name="milestone_amt[]"
                                                id="milestone_amt" min="3" placeholder="For" onchange="addMilestoneAmt()">
                                        </div>
                                        <div class="col-md-1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary btn-block w-md-auto" value="Place Bid">
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card card-bordered card-body rounded-xl mb-4">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="font-weight-bold mb-3">Description</h5>
                            <div class="pt-1 mb-3">
                                <p class="mb-4">
                                    {!! $project->description !!}
                                </p>
                                <span class="badge bg-success-alt text-white">Featured</span>
                            </div>
                        </div>

                        <div class="col-md-4 text-md-right">
                            @if ($project->user_id != auth()->id())
                                @if (App\Models\Bid::isBidAvailable(auth()->id(), $project->project_id))
                                    <button class="btn btn-info btn-sm mb-2 disabled">Already Bid on this Project</button>
                                @else
                                    <button class="btn btn-primary mb-2" data-toggle="collapse"
                                        data-target="#collapseBid">Bid
                                        on
                                        This Project</button>
                                @endif
                            @endif
                        </div>
                    </div>

                    <hr class="mb-4">

                    <h5 class="font-weight-bold mb-3">Skills Required</h5>

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
                                <li><span class="text-danger">No Skills Found!.</span></li>
                            @endif
                        </ul>
                    </div>
                    @if ($project->image)
                        <hr class="mb-4">
                        <h5 class="font-weight-bold mb-3">File Attached</h5>
                        <div class="pt-1">
                            <a href="{{ url('uploads/project/images/' . $project->image) }}">{{ $project->image }}</a>
                        </div>
                    @endif
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('post-project') }}" class="btn btn-secondary mb-3">Post a Project Like
                                This</a>
                        </div>

                        <div class="col-md-6 text-md-right">
                            <h6 class="font-weight-bold mb-3">Project ID: {{ $project->project_id }}</h6>
                            <div class="pt-1">
                                <a href="#" class="text-danger">Report Project</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card card-bordered rounded-xl mb-4">
                    <div class="card-header text-center">
                        <h5 class="font-weight-bold">Client Information</h5>
                    </div>

                    <div class="media p-4">
                        <img class="avatar-bordered rounded-circle shadow-lg"
                            src="{{ $project->user->img == '' ? url('assets/img/pages/default.png') : url('uploads/users/' . $project->user->id . '/images/' . $project->user->img) }}"
                            width="128" alt="User thumbnail">

                        <div class="media-body ml-3">
                            <h6 class="card-title mt-3 mb-2">{{ $project->user->username }}</h6>
                            <div class="card-text mb-3">
                                <strong class="text-dark">Member Since:</strong>
                                {{ $project->user->created_at->format('Y') }}
                            </div>
                            <div class="pb-3 mb-1">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="badge bg-warning text-white mr-2">0.0</span>
                                    <div class="ratings">
                                        <i class="fa fa-star-o mr-1"></i>
                                        <i class="fa fa-star-o mr-1"></i>
                                        <i class="fa fa-star-o mr-1"></i>
                                        <i class="fa fa-star-o mr-1"></i>
                                        <i class="fa fa-star-o mr-1"></i>
                                    </div>
                                </div>
                                <div class="font-size-sm">0 Reviews</div>
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
                    Freelancers who apply for the project may be subject to sanctions if they post direct transactions by
                    posting e-mails, wire / wireless numbers, etc.
                </p>
            </div>
        </div>
    </section>

    <section class="container pb-5 mb-3 mb-md-4">
        <div class="card mb-4">
            <div class="card-header bg-gray-800 border-dark">
                <div class="font-weight-bold text-white d-md-none">Project Awarded</div>

                <div class="row">
                    <div class="col-md-6 d-none d-md-block">
                        <div class="font-weight-bold text-white">Project selection by type
                            {{-- ({{ $bidsSeleProjCount }}) --}}
                        </div>
                    </div>

                    <div class="col-md-3 d-none d-md-block">
                        <div class="font-weight-bold text-white">Reputation</div>
                    </div>

                    <div class="col-md-3 d-none d-md-block text-md-center">
                        <div class="font-weight-bold text-white">Support / bid amount</div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($bidsOnProject->count())
                    @foreach ($bidsOnProject as $item)
                        @if ($item->status == 2 || $item->status == 3 || $item->status == 0)
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
                                        <span class="badge bg-warning text-white mr-2">0.0</span>
                                        <div class="ratings">
                                            <i class="fa fa-star-o mr-1"></i>
                                            <i class="fa fa-star-o mr-1"></i>
                                            <i class="fa fa-star-o mr-1"></i>
                                            <i class="fa fa-star-o mr-1"></i>
                                            <i class="fa fa-star-o mr-1"></i>
                                        </div>
                                    </div>

                                    <div class="font-size-sm">0 Reviews</div>
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
                                                    <button type="submit" class="btn btn-sm btn-success mx-2"
                                                        id="proposalAppBtn">Approve</button>
                                                </li>
                                                <li class="list-inline-item">
                                                    <button type="submit" class="btn btn-sm btn-danger mx-2"
                                                        id="proposalRejBtn">Reject</button>
                                                </li>
                                            </ul>
                                        @elseif($item->status == 3)
                                            <button class="btn btn-sm btn-info mx-2 disabled">You Approved
                                                it!</button>
                                        @elseif($item->status == 0)
                                            <button class="btn btn-sm btn-danger mx-2 disabled">You Rejected
                                                it!</button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="row"> --}}

                            @if ($item->milestones->count())
                                @if ($item->user_id == auth()->id())
                                    <h5><strong>Milestones:</strong></h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6><strong>Name</strong></h6>
                                        </div>
                                        <div class="col-md-2">
                                            <h6><strong>Amount</strong></h6>
                                        </div>
                                        <div class="col-md-2">
                                            <h6><strong>Status</strong></h6>
                                        </div>
                                        <div class="col-md-4">
                                            <h6><strong>Actions</strong></h6>
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
                                                        Requested
                                                    @elseif($milestone->status == 2)
                                                        Deposit
                                                    @elseif($milestone->status == 3)
                                                        Rejected By Project Owner
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="col-md-4 row">
                                                <form action="{{ route('milestone.destory', $milestone->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="submit" value="Cancel" class="btn btn-dark mx-2"
                                                        onclick="return confirm('Are you sure you want to cancel this milestone?')">
                                                </form>
                                                @if ($milestone->status == 2)
                                                    <form action="#">
                                                        <input type="submit" value="Dispute" class="btn btn-danger mx-2">
                                                    </form>
                                                @endif

                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                @endif
                            @else
                                <span class="text-danger">Ops! no milestone found...</span>
                            @endif
                            {{-- </div> --}}
                        @endif
                    @endforeach
                @else
                    <span class="text-danger">Ops 404 not Found!</span>
                @endif
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header bg-gray-800 border-dark">
                <div class="font-weight-bold text-white d-md-none">Bids on This Project</div>

                <div class="row">
                    <div class="col-md-6 d-none d-md-block">
                        <div class="font-weight-bold text-white">Bid on This Project ({{ $bidsOnProjCount }})
                        </div>
                    </div>

                    <div class="col-md-3 d-none d-md-block">
                        <div class="font-weight-bold text-white">Reputation</div>
                    </div>

                    <div class="col-md-3 d-none d-md-block text-md-center">
                        <div class="font-weight-bold text-white">Support / bid amount</div>
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
                                            <p class="font-size-ms mb-0">{{ $item->user->created_at->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3 mb-md-0">
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="badge bg-warning text-white mr-2">0.0</span>
                                        <div class="ratings">
                                            <i class="fa fa-star-o mr-1"></i>
                                            <i class="fa fa-star-o mr-1"></i>
                                            <i class="fa fa-star-o mr-1"></i>
                                            <i class="fa fa-star-o mr-1"></i>
                                            <i class="fa fa-star-o mr-1"></i>
                                        </div>
                                    </div>

                                    <div class="font-size-sm">0 Reviews</div>
                                </div>

                                <div class="col-md-3 text-md-center">
                                    <h6 class="font-weight-bold">{{ $project->currency == 'USD' ? '$' : '₩' }}
                                        {{ $item->budget }}</h6>
                                    <p class="font-size-ms mb-0">{{ $item->day }} Days</p>
                                    @if ($item->user->id === auth()->id())
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><a href="{{ route('bid.show', $item->id) }}"
                                                    class="btn btn-sm btn-info mx-2">Edit</a></li>
                                            <li class="list-inline-item">
                                                <form action="{{ route('bid.destory', $item->id) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button onclick="return confirm('Are you Sure?')" type="submit"
                                                        class="btn btn-sm btn-danger mx-2">Delete</button>
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
                        <span class="text-danger">Ops 404 not Found!</span>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
