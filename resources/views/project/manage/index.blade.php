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
        <h1 class="h5 font-weight-bold text-white">My Project Status</h1>
    </div>

    <section class="container py-5">
        <h2 class="font-weight-bold text-center pb-4"><span class="badge text-white bg-success-alt">Project</span>
            {{ $project->title }} </h2>

        <div class="card border-0 bg-primary mb-5">
            <div class="card-header">
                <ul class="nav nav-wider nav-pills nav-pills-light justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link font-weight-bold active" id="pills-proposal-tab" data-toggle="pill"
                            href="#pills-proposal" role="tab" aria-controls="pills-proposal"
                            aria-selected="true">Proposal</a>
                    </li>
                    <li class="nav-item mr-3" role="presentation">
                        <a class="nav-link font-weight-bold" id="pills-management-tab" data-toggle="pill"
                            href="#pills-management" role="tab" aria-controls="pills-management"
                            aria-selected="false">Management</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link font-weight-bold" id="pills-modify-tab" data-toggle="pill" href="#pills-modify"
                            role="tab" aria-controls="pills-modify" aria-selected="false">Modify / Delete Project</a>
                    </li>
                </ul>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active" id="pills-proposal" role="tabpanel" aria-labelledby="pills-proposal-tab">
                <div class="col-md-9 px-0 mx-auto">
                    <ul class="list-unstyled">
                        @if ($proposals->count())
                            @foreach ($proposals as $item)
                                <li class="mb-4">
                                    <div class="card card-bordered rounded-xl">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-3 col-md-2">
                                                    <img class="img-fluid"
                                                        src="{{ $item->user->img == '' ? url('assets/img/pages/default.png') : url('uploads/users/' . $item->user->id . '/images/' . $item->user->img) }}"
                                                        width="96">
                                                </div>
                                                <div class="col-xs-10 col-md-6">
                                                    <h4 class="font-size-lg text-primary pb-2">
                                                        <a href="#">{{ $item->user->username }}</a>
                                                    </h4>
                                                    <div class="d-lg-none">
                                                        <div class="text-left">
                                                            <p><strong
                                                                    class="ng-binding">{{ $project->currency == 'USD' ? '$' : '₩' }}
                                                                    {{ $item->budget }}</strong></p>
                                                        </div>
                                                        <div class="mr-2 mb-3">
                                                            <span
                                                                class="badge bg-success-alt text-white mr-2 px-2 py-1">5.0</span>
                                                            <span class="ratings">
                                                                <i class="fa fa-star active"></i>
                                                                <i class="fa fa-star active"></i>
                                                                <i class="fa fa-star active"></i>
                                                                <i class="fa fa-star active"></i>
                                                                <i class="fa fa-star active"></i>
                                                            </span>
                                                        </div>
                                                        <h5 class="h6 text-muted">1 Review</h5>
                                                    </div>
                                                    <p>Completed within {{ $item->day }} days</p>
                                                    @if ($item->status == 1)
                                                        <form
                                                            action="{{ route('my-project.send-request', request()->route('id')) }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="submit" value="Send Request"
                                                                class="btn btn-info btn-sm">
                                                            <input type="hidden" name="proposal_project_id"
                                                                value="{{ request()->route('id') }}">
                                                            <input type="hidden" name="proposal_user_id"
                                                                value="{{ $item->user->id }}">
                                                        </form>
                                                    @elseif($item->status == 2 || $item->status == 3)
                                                        <button class="disabled btn btn-success btn-sm">Approved</button>
                                                    @elseif($item->status == 0)
                                                        <button class="disabled btn btn-danger btn-sm">Rejected</button>
                                                    @endif
                                                    <a href="#" class="btn btn-secondary">화상 채팅</a>
                                                </div>
                                                <div class="col-xs-6 col-md-4 d-none d-lg-block">
                                                    <p><strong
                                                            class="ng-binding">{{ $project->currency == 'USD' ? '$' : '₩' }}
                                                            {{ $item->budget }}</strong></p>
                                                    <div class="mr-2 mb-3">
                                                        <span
                                                            class="badge bg-success-alt text-white mr-2 px-2 py-1">5.0</span>
                                                        <span class="ratings">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="h6 text-muted">1 Review</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-block">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6><strong>Description:</strong></h6>
                                                    <p class="font-size-sm mb-0">
                                                        {{ $item->proposal != '' ? $item->proposal : 'No Description' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    @if ($item->milestones->count())
                                                        <h6><strong>Milestones:</strong></h6>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <h6><strong>Name</strong></h6>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h6><strong>Amount</strong></h6>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h6><strong>Status</strong></h6>
                                                            </div>
                                                        </div>
                                                        @foreach ($item->milestones as $milestone)
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <span>{{ $milestone->name }}</span>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <span>{{ $milestone->amount }}</span>
                                                                </div>
                                                                <div class="col-md-4">
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
                                                            </div>
                                                            <hr>
                                                        @endforeach
                                                    @else
                                                        <span class="text-danger">Ops! no milestone found...</span>
                                                    @endif

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <span class="text-danger">Ops! 404 not Found</span>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-management" role="tabpanel" aria-labelledby="pills-management-tab">
                <div class="row">
                    <div class="col-lg-8">
                        <ul class="list-unstyled">
                            @if ($proposals->count())
                                @foreach ($proposals as $item)
                                    @if ($item->status == 2 || $item->status == 3)
                                        <li class="mb-4">
                                            <div class="card card-bordered card-body rounded-xl">
                                                <div class="row mb-4">
                                                    <div class="col-3 col-md-2">
                                                        <img class="img-fluid"
                                                            src="{{ $item->user->img == '' ? url('assets/img/pages/default.png') : url('uploads/users/' . $item->user->id . '/images/' . $item->user->img) }}"
                                                            width="96">
                                                    </div>
                                                    <div class="col-10">
                                                        <h4 class="font-size-lg text-primary pb-2">
                                                            <a href="#">{{ $item->user->username }}</a>
                                                        </h4>
                                                        <div class="d-flex">
                                                            <p class="pr-5 text-success">Approved</p>
                                                            <p>Completed in
                                                                {{ $project->currency == 'USD' ? '$' : '₩' }}{{ $item->budget }}
                                                                within {{ $item->day }} days</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <form action="{{ route('milestone.deposit') }}" method="post"
                                                    class="my-4">
                                                    @csrf
                                                    <input type="hidden" name="deposit_project_id"
                                                        value="{{ request()->route('id') }}">
                                                    <input type="hidden" name="deposit_user_id"
                                                        value="{{ $item->user->id }}">
                                                    <input type="hidden" name="deposit_bid_id" value="{{ $item->id }}">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <input type="text" name="deposit_name" id=""
                                                                class="form-control" placeholder="Deposit Description">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" name="deposit_amount"
                                                                placeholder="Deposit Amount" class="form-control">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="submit" name="milestone-deposit"
                                                                value="Deposit Milestone" class="btn btn-primary">
                                                        </div>
                                                    </div>
                                                </form>

                                                <div class="card border-0 bg-primary mb-4">
                                                    <div class="card-header">
                                                        <ul class="nav nav-pills nav-pills-light">
                                                            <li class="nav-item"><a class="nav-link active"
                                                                    href="#">Milestone</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                @if ($item->milestones->count())
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Amount Requested</th>
                                                                <th scope="col">Contents</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php($total = 0)
                                                            @foreach ($item->milestones as $milestone)
                                                            @if ($milestone->status == 2 || $milestone->status == 1)
                                                                @php($total += $milestone->amount)
                                                            @endif
                                                                
                                                                <tr>
                                                                    <td>
                                                                        {{ $project->currency == 'USD' ? '$' : '₩' }}{{ $milestone->amount }}
                                                                    </td>
                                                                    <td>{{ $milestone->name }}</td>
                                                                    <td>
                                                                        @if ($milestone->status == 1)
                                                                            Requested
                                                                        @elseif($milestone->status == 2)
                                                                            Deposit
                                                                        @elseif($milestone->status == 3)
                                                                            Rejected By Project Owner
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($milestone->status == 1)
                                                                            <form
                                                                                action="{{ route('milestone.depositOrReject', $milestone->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                <input type="hidden" name="project_id"
                                                                                    value="{{ request()->route('id') }}">
                                                                                <input type="submit"
                                                                                    class="btn btn-success bt-xs"
                                                                                    name="deposit" value="Deposit">
                                                                                <input type="submit"
                                                                                    class="btn btn-danger bt-xs"
                                                                                    name="reject" value="Reject">
                                                                            </form>
                                                                        @elseif($milestone->status == 2)
                                                                            <form
                                                                                action="#"
                                                                                method="post">
                                                                                @csrf
                                                                                <input type="hidden" name="project_id"
                                                                                    value="{{ request()->route('id') }}">
                                                                                <input type="submit"
                                                                                    class="btn btn-success bt-xs"
                                                                                    name="amount_release"
                                                                                    value="Amount Release">
                                                                                <input type="submit"
                                                                                    class="btn btn-danger bt-xs"
                                                                                    name="dispute" value="Dispute">
                                                                            </form>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <p>
                                                        <strong>Total:
                                                            {{ $project->currency == 'USD' ? '$' : '₩' }}{{ $total }}</strong>
                                                    </p>
                                                @else
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <span class="text-danger">Ops! no milestone
                                                                    found...</span>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                @endif
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>

                    <div class="col-lg-4">
                        <div class="card card-bordered card-body rounded-xl">
                            <h5 class="font-size-lg mb-4"><strong>What are the Milestone payments</strong></h5>
                            <h5 class="font-size-lg mb-3"><strong>Milestone are :</strong></h5>
                            <ul class="list-unstyled lh-3">
                                <li>
                                    <div class="icon border-info mx-1">
                                        <i class="fa fa-check text-info"></i>
                                    </div>
                                    <span class="text-info"><strong>Safe & Secure :</strong></span>
                                    <span>We hild your milestone until you decide to release them.</span>
                                </li>

                                <li>
                                    <div class="icon border-info mx-1">
                                        <i class="fa fa-check text-info"></i>
                                    </div>
                                    <span class="text-info"><strong>Refundable :</strong></span>
                                    <span>If you are dissatisfied or the JCM does not accept.</span>
                                </li>

                                <li>
                                    <div class="icon border-info mx-1">
                                        <i class="fa fa-check text-info"></i>
                                    </div>
                                    <span class="text-info"><strong>Controlled By you :</strong></span>
                                    <span>Release them only if you are 100% satisfied.</span>
                                </li>

                                <li>
                                    <div class="icon border-danger mx-1">
                                        <i class="fa fa-check text-danger"></i>
                                    </div>
                                    <span class="text-info"><strong>Please note that if you request a direct money
                                            transfer
                                            from a freelancer to avoid a fee, the client is at a considerable
                                            risk.</strong></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-modify" role="tabpanel" aria-labelledby="pills-modify-tab">
                <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-primary font-size-lg text-white rounded-right-0 active"
                            id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab"
                            aria-controls="pills-description" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-primary font-size-lg text-white rounded-left-0" id="pills-upgrade-tab"
                            data-toggle="pill" href="#pills-upgrade" role="tab" aria-controls="pills-upgrade"
                            aria-selected="false">Upgrade</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-description" role="tabpanel"
                        aria-labelledby="pills-description-tab">
                        <div class="row">
                            <div class="col-md-9">
                                <form action="{{ route('project.update', $project->project_id) }}"
                                    id="update_project_form" method="post">
                                    @csrf
                                    <div class="card card-bordered card-body rounded-xl p-lg-5">
                                        <h4 class="mb-4 pb-2"><strong>Description</strong></h4>

                                        <div class="d-flex align-items-center mb-3">
                                            <h6 class="font-size-sm flex-shrink-0 mb-0 mr-3"><strong>Project Title
                                                    :</strong>
                                            </h6>
                                            <div class="col-md-4 pl-md-0">
                                                <input type="text" class="form-control form-control-sm"
                                                    name="project_title" value="{{ $project->title }}">
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <h6 class="font-size-sm flex-shrink-0 mb-0 mr-3"><strong>Project Category
                                                    :</strong>
                                            </h6>
                                            <div class="font-size-sm">
                                                {{ $project->main_category ? App\Models\Category::find($project->main_category)->title : 'No Category' }}
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <h6 class="font-size-sm flex-shrink-0 mb-0 mr-3"><strong>Project Sub Category
                                                    :</strong></h6>
                                            <div class="font-size-sm">
                                                {{ $project->sub_category ? App\Models\SubCategory::find($project->sub_category)->title : 'No Sub Category' }}
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <h6 class="font-size-sm flex-shrink-0 mb-0 mr-3"><strong>Project Currency
                                                    :</strong>
                                            </h6>
                                            <div class="font-size-sm">
                                                {{ $project->currency == 'USD' ? 'USD' : 'KRW' }}
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <h6 class="font-size-sm flex-shrink-0 mb-0 mr-3"><strong>Project Budget
                                                    :</strong>
                                            </h6>
                                            <div class="font-size-sm">
                                                @if ($project->min_budget && $project->max_budget)
                                                    {{ $project->currency == 'USD' ? '$' : '₩' }}
                                                    {{ $project->min_budget }} -
                                                    {{ $project->currency == 'USD' ? '$' : '₩' }}
                                                    {{ $project->max_budget }}
                                                @else
                                                    @if ($project->rate_status == '1')
                                                        {{ $project->fixed_rate }}
                                                    @else
                                                        {{ $project->hourly_rate . '/Hourly' }}
                                                    @endif
                                                @endif
                                            </div>
                                        </div>

                                        <div>
                                            <h6 class="font-size-sm mb-3"><strong>Description :</strong></h6>

                                            <div class="quill-editor">
                                                <div id="quill-toolbar">
                                                    <span class="ql-formats">
                                                        <button class="ql-bold"></button>
                                                        <button class="ql-italic"></button>
                                                        <button class="ql-underline"></button>
                                                    </span>
                                                    <span class="ql-formats">
                                                        <select class="ql-color"></select>
                                                        <select class="ql-background"></select>
                                                    </span>
                                                    <span class="ql-formats">
                                                        <button class="ql-script" value="sub"></button>
                                                        <button class="ql-script" value="super"></button>
                                                    </span>
                                                    <span class="ql-formats">
                                                        <button class="ql-header" value="1"></button>
                                                        <button class="ql-header" value="2"></button>
                                                    </span>
                                                    <span class="ql-formats">
                                                        <button class="ql-list" value="ordered"></button>
                                                        <button class="ql-list" value="bullet"></button>
                                                        <button class="ql-indent" value="-1"></button>
                                                        <button class="ql-indent" value="+1"></button>
                                                    </span>
                                                    <span class="ql-formats">
                                                        <select class="ql-align"></select>
                                                    </span>
                                                    <span class="ql-formats">
                                                        <button class="ql-clean"></button>
                                                    </span>
                                                </div>

                                                <div id="quill-editor">{!! $project->description !!}</div>
                                            </div>
                                        </div>

                                        <textarea style="display: none;" name="project_description"
                                            id="update_project_description"></textarea>

                                        <div class="text-right pt-4">
                                            <a href="#" class="btn btn-secondary">Cancel</a>
                                            <input class="btn btn-primary" type="submit" value="Save">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-3">
                                <div class="card card-bordered card-body rounded-xl">
                                    <div class="card-header text-center mb-4">
                                        <h5><strong>Project Upgrade</strong></h5>
                                    </div>
                                    <p class="font-size-sm py-4">Upgrading your project will help you to increase the bids
                                        you get or the features that you have available</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-upgrade" role="tabpanel" aria-labelledby="pills-upgrade-tab">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="card card-bordered card-body rounded-xl">
                                    <div class="form-group mb-4">
                                        <p class="font-size-ms">
                                            <i class="fa fa-warning text-danger mr-2"></i>
                                            Note: When using Bluefreelancer service, you will not be charged cancellation or
                                            refund for each registration fee.
                                        </p>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-3 pr-md-0">
                                                <div
                                                    class="custom-control custom-control-inline custom-checkbox align-middle">
                                                    <input type="checkbox" class="custom-control-input" id="Chat">
                                                    <label class="custom-control-label" for="Chat"></label>
                                                </div>
                                                <button class="btn btn-primary btn-sm px-4 ml-n3">Chat</button>
                                            </div>

                                            <div class="col-md-7">
                                                <h5 class="font-size-sm font-weight-bold">Using chat is an indicator of the
                                                    high success of the project. Unlimited chats by registration</h5>
                                                <p class="font-size-ms">You can use unlimited chat anytime and anywhere
                                                    until the project is completed. <a href="#"
                                                        class="btn btn-sm btn-danger font-size-xs py-1">Caution <i
                                                            class="fa fa-caret-right ml-1"></i></a></p>
                                                <p class="font-size-ms text-muted">Free Event Event [Until June 30]</p>
                                            </div>

                                            <div class="col-md-2 text-md-right pl-md-0">
                                                <div class="font-size-md">
                                                    <del class="text-muted">$500</del>
                                                    <span class="ml-1">$0</span>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-3 pr-md-0">
                                                <div
                                                    class="custom-control custom-control-inline custom-checkbox align-middle">
                                                    <input type="checkbox" class="custom-control-input" id="private">
                                                    <label class="custom-control-label" for="private"></label>
                                                </div>
                                                <button class="btn btn-primary btn-sm px-4 ml-n3">Private</button>
                                            </div>

                                            <div class="col-md-7">
                                                <p class="font-size-ms">Private services are effective when looking for
                                                    professional freelancers to develop core projects that require security.
                                                    <a href="#" class="btn btn-sm btn-info font-size-xs py-1">Introduction
                                                        <i class="fa fa-caret-right ml-1"></i></a>
                                                </p>
                                            </div>

                                            <div class="col-md-2 text-md-right pl-md-0">
                                                <div class="font-size-md">
                                                    <span class="ml-1">$0</span>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-3 pr-md-0">
                                                <div
                                                    class="custom-control custom-control-inline custom-checkbox align-middle">
                                                    <input type="checkbox" class="custom-control-input" id="Sealed">
                                                    <label class="custom-control-label" for="Sealed"></label>
                                                </div>
                                                <button class="btn btn-success btn-sm px-4 ml-n3">Sealed</button>
                                            </div>

                                            <div class="col-md-7">
                                                <p class="font-size-ms">If you do not register your project, the
                                                    freelancers
                                                    you support will not be able to see the amount and content of other
                                                    freelancers.</p>
                                            </div>

                                            <div class="col-md-2 text-md-right pl-md-0">
                                                <div class="font-size-md">
                                                    <span class="ml-1">$100</span>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-3 pr-md-0">
                                                <div
                                                    class="custom-control custom-control-inline custom-checkbox align-middle">
                                                    <input type="checkbox" class="custom-control-input" id="nda">
                                                    <label class="custom-control-label" for="nda"></label>
                                                </div>
                                                <button class="btn btn-danger btn-sm px-4 ml-n3">(NDA)</button>
                                            </div>

                                            <div class="col-md-7">
                                                <h5 class="font-size-sm font-weight-bold">Using chat is an indicator of the
                                                    high success of the project. Unlimited chats by registration</h5>
                                                <p class="font-size-ms">A confidentiality agreement is a contract between
                                                    a
                                                    client and a freelancer to maintain the confidential information
                                                    required to perform the project work. <a href="#"
                                                        class="btn btn-sm btn-danger font-size-xs py-1">Caution <i
                                                            class="fa fa-caret-right ml-1"></i></a></p>
                                            </div>

                                            <div class="col-md-2 text-md-right pl-md-0">
                                                <div class="font-size-md">
                                                    <span class="ml-1">$100</span>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-3 pr-md-0">
                                                <div
                                                    class="custom-control custom-control-inline custom-checkbox align-middle">
                                                    <input type="checkbox" class="custom-control-input" id="Urgent">
                                                    <label class="custom-control-label" for="Urgent"></label>
                                                </div>
                                                <button class="btn btn-warning btn-sm px-4 ml-n3">Urgent</button>
                                            </div>

                                            <div class="col-md-7">
                                                <p class="font-size-ms">This service is a service that allows freelancers
                                                    to
                                                    quickly process your project, including quick response of your project,
                                                    urgent project, error (bug), change, updates.</p>
                                            </div>

                                            <div class="col-md-2 text-md-right pl-md-0">
                                                <div class="font-size-md">
                                                    <span class="ml-1">$100</span>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="pt-4">
                                            <h6 class="mb-4"><strong>Total : $0 Dollars</strong></h6>
                                            <input class="btn btn-primary" type="submit" value="Payment">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card card-bordered card-body rounded-xl">
                                    <div class="card-header text-center mb-4">
                                        <h5><strong>Project Upgrade</strong></h5>
                                    </div>
                                    <p class="font-size-sm py-4">Upgrading your project will help you to increase the bids
                                        you get or the features that you have available</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
