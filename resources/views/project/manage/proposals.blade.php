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
                        <a class="nav-link font-weight-bold active"
                            href="{{ route('project.manage.proposals', request()->route('id')) }}">Proposal</a>
                    </li>
                    <li class="nav-item mr-3" role="presentation">
                        <a class="nav-link font-weight-bold" id="pills-management-tab"
                            href="{{ route('project.manage.milestone', request()->route('id')) }}">Management</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link font-weight-bold" id="pills-modify-tab"
                            href="{{ route('project.manage.modify', request()->route('id')) }}">Modify / Delete Project</a>
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

        </div>
    </section>

@endsection
