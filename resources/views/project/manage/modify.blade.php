@extends('layouts.app')
@section('content')
    <div class="bg-secondary py-4">
        <div class="container pt-2 pb-3">
            <div class="d-flex flex-column flex-md-row align-items-center">
                <a href="/project-listing"
                    class="btn btn-block bg-gray-800 text-white w-md-auto mt-2 mr-md-2">{{ __('browseProject') }}</a>
                <a href="/contest-listing"
                    class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">{{ __('browseContest') }}</a>
                <a href="/browse/category"
                    class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">{{ __('browseCategories') }}</a>
                <a href="/showcases"
                    class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">{{ __('showcase') }}</a>
                <a href="/post-contest" class="btn btn-block btn-primary w-md-auto ml-auto">{{ __('startContest') }}</a>
            </div>
        </div>
    </div>

    <!-- Title -->
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
        <h1 class="h5 font-weight-bold text-white">{{ __('ProjectStatus') }}</h1>
    </div>

    <section class="container py-5">
        <h2 class="font-weight-bold text-center pb-4"><span
                class="badge text-white bg-success-alt">{{ __('project') }}</span>
            {{ $project->title }} </h2>

        <div class="card border-0 bg-primary mb-5">
            <div class="card-header">
                <ul class="nav nav-wider nav-pills nav-pills-light justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link font-weight-bold "
                            href="{{ route('project.manage.proposals', request()->route('id')) }}">{{ __('ProposalTab') }}</a>
                    </li>
                    <li class="nav-item mr-3" role="presentation">
                        <a class="nav-link font-weight-bold" id="pills-management-tab"
                            href="{{ route('project.manage.milestone', request()->route('id')) }}">{{ __('MangementTab') }}</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link font-weight-bold active" id="pills-modify-tab"
                            href="{{ route('project.manage.modify', request()->route('id')) }}">{{ __('ModifyDelTab') }}</a>
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
                            aria-controls="pills-description" aria-selected="true">{{ __('Description') }}</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link btn btn-primary font-size-lg text-white rounded-left-0" id="pills-upgrade-tab"
                            data-toggle="pill" href="#pills-upgrade" role="tab" aria-controls="pills-upgrade"
                            aria-selected="false">{{ __('Upgrade') }}</a>
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
                                        <h4 class="mb-4 pb-2"><strong>{{ __('Descrition') }}</strong></h4>

                                        <div class="d-flex align-items-center mb-3">
                                            <h6 class="font-size-sm flex-shrink-0 mb-0 mr-3"><strong>{{ __('titlePro') }}
                                                    :</strong>
                                            </h6>
                                            <div class="col-md-4 pl-md-0">
                                                <input type="text" class="form-control form-control-sm" name="project_title"
                                                    value="{{ $project->title }}">
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <h6 class="font-size-sm flex-shrink-0 mb-0 mr-3">
                                                <strong>{{ __('ProjectCategory') }}
                                                    :</strong>
                                            </h6>
                                            <div class="font-size-sm">
                                                {{ $project->main_category ? App\Models\Category::find($project->main_category)->title : 'No Category' }}
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <h6 class="font-size-sm flex-shrink-0 mb-0 mr-3">
                                                <strong>{{ __('ProjectSubCategory') }}
                                                    :</strong>
                                            </h6>
                                            <div class="font-size-sm">
                                                {{ $project->sub_category ? App\Models\SubCategory::find($project->sub_category)->title : 'No Sub Category' }}
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <h6 class="font-size-sm flex-shrink-0 mb-0 mr-3">
                                                <strong>{{ __('ProjectCurrency') }}
                                                    :</strong>
                                            </h6>
                                            <div class="font-size-sm">
                                                {{ $project->currency == 'USD' ? 'USD' : 'KRW' }}
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <h6 class="font-size-sm flex-shrink-0 mb-0 mr-3">
                                                <strong>{{ __('ProjectBudget') }}
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
                                                        {{ $project->hourly_rate . '/' . __('hourly') }}
                                                    @endif
                                                @endif
                                            </div>
                                        </div>

                                        <div>
                                            <h6 class="font-size-sm mb-3"><strong>{{ __('Description') }} :</strong></h6>

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
                                            <a href="#" class="btn btn-secondary">{{ __('Cancel') }}</a>
                                            <input class="btn btn-primary" type="submit" value="{{ __('Save') }}">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-3">
                                <div class="card card-bordered card-body rounded-xl">
                                    <div class="card-header text-center mb-4">
                                        <h5><strong>{{ __('ProjectUpgrade') }}</strong></h5>
                                    </div>
                                    <p class="font-size-sm py-4">{{ __('IncreaseTheBids') }}</p>
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
                                            {{ __('notice') }}
                                        </p>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-3 pr-md-0">
                                                <div
                                                    class="custom-control custom-control-inline custom-checkbox align-middle">
                                                    <input type="checkbox" class="custom-control-input" id="Chat">
                                                    <label class="custom-control-label" for="Chat"></label>
                                                </div>
                                                <button
                                                    class="btn btn-primary btn-sm px-4 ml-n3">{{ __('chat') }}</button>
                                            </div>

                                            <div class="col-md-7">
                                                <h5 class="font-size-sm font-weight-bold">{{ __('chatHeading') }}</h5>
                                                <p class="font-size-ms">{{ __('chatDescription') }} <a href="#"
                                                        class="btn btn-sm btn-danger font-size-xs py-1">{{ __('caution') }}
                                                        <i class="fa fa-caret-right ml-1"></i></a></p>
                                                <p class="font-size-ms text-muted">{{ __('freeEvent') }}</p>
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
                                                <button
                                                    class="btn btn-primary btn-sm px-4 ml-n3">{{ __('private') }}</button>
                                            </div>

                                            <div class="col-md-7">
                                                <p class="font-size-ms">{{ __('privateServices') }}
                                                    <a href="#"
                                                        class="btn btn-sm btn-info font-size-xs py-1">{{ __('introduction') }}
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
                                                <button
                                                    class="btn btn-success btn-sm px-4 ml-n3">{{ __('sealed') }}</button>
                                            </div>

                                            <div class="col-md-7">
                                                <p class="font-size-ms">{{ __('sealedDescription') }}</p>
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
                                                <button
                                                    class="btn btn-danger btn-sm px-4 ml-n3">{{ __('NDA') }}</button>
                                            </div>

                                            <div class="col-md-7">
                                                <h5 class="font-size-sm font-weight-bold">{{ __('NDAdescription') }}
                                                </h5>
                                                <p class="font-size-ms">{{ __('NdaDetails') }} <a href="#"
                                                        class="btn btn-sm btn-danger font-size-xs py-1">{{ __('caution') }}
                                                        <i class="fa fa-caret-right ml-1"></i></a></p>
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
                                                <button
                                                    class="btn btn-warning btn-sm px-4 ml-n3">{{ __('urgent') }}</button>
                                            </div>

                                            <div class="col-md-7">
                                                <p class="font-size-ms">{{ __('urgentDescription') }}</p>
                                            </div>

                                            <div class="col-md-2 text-md-right pl-md-0">
                                                <div class="font-size-md">
                                                    <span class="ml-1">$100</span>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="pt-4">
                                            <h6 class="mb-4"><strong>{{ __('total') }} : $0 </strong></h6>
                                            <input class="btn btn-primary" type="submit" value="Payment">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card card-bordered card-body rounded-xl">
                                    <div class="card-header text-center mb-4">
                                        <h5><strong>{{ __('ProjectUpgrade') }}</strong></h5>
                                    </div>
                                    <p class="font-size-sm py-4">{{ __('IncreaseTheBids') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
