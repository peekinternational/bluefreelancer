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
                        <a class="nav-link font-weight-bold "
                            href="{{ route('project.manage.proposals', request()->route('id')) }}">Proposal</a>
                    </li>
                    <li class="nav-item mr-3" role="presentation">
                        <a class="nav-link font-weight-bold" id="pills-management-tab"
                            href="{{ route('project.manage.milestone', request()->route('id')) }}">Management</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link font-weight-bold active" id="pills-modify-tab"
                            href="{{ route('project.manage.modify', request()->route('id')) }}">Modify / Delete
                            Project</a>
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

            <div class="tab-pane fade show active" id="pills-modify" role="tabpanel" aria-labelledby="pills-modify-tab">
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
                                                <input type="text" class="form-control form-control-sm" name="project_title"
                                                    value="{{ $project->title }}">
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
