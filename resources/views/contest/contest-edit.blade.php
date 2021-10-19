@extends('layouts.app')
@section('content')
    <!-- Page Content -->
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
        <h1 class="h5 font-weight-bold text-white">{{ __('EditAndDelete') }}</h1>
    </div>

    <section class="container py-5">
        <div class="text-center mb-4">
            <h4 class="text-primary pb-2"><strong>{{ __('EditAndDelete') }}</strong></h4>

            <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="btn btn-primary btn-sm active mx-1" id="pills-edit-tab" data-toggle="pill" href="#pills-edit"
                        role="tab" aria-controls="pills-edit" aria-selected="true">
                        <i class="fa fa-edit mr-1"></i>
                        {{ __('editContest') }}
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('contest.destory', $contest->contest_id) }}" method="post">
                        @csrf
                        <input type="submit" value="{{ __('Delete') }}" class="btn btn-danger btn-sm mx-1">
                    </form>
                    {{-- <a class="btn btn-danger btn-sm mx-1" data-toggle="modal"
                        href="{{ route('contest.destory', $contest->contest_id) }}">
                        <i class="fa fa-trash-o mr-1"></i>
                        Delete
                    </a> --}}
                </li>
                <li class="nav-item">
                    <a class="btn btn-success btn-sm mx-1" id="pills-upgrade-tab" data-toggle="pill" href="#pills-upgrade"
                        role="tab" aria-controls="pills-upgrade" aria-selected="false">
                        <i class="fa fa-line-chart mr-1"></i>
                        {{ __('Upgrade') }}
                    </a>
                </li>
            </ul>
        </div>

        <div class="w-75 mx-auto">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-edit" role="tabpanel" aria-labelledby="pills-edit-tab">
                    <form action="{{ route('contest.update', $contest->contest_id) }}" method="post"
                        id="update_contest_form">
                        @csrf
                        <div class="card border-primary bg-transparent rounded-xl mb-4">
                            <div class="card-body">
                                <div class="d-flex font-size-sm">
                                    <label for="contestTitle"><strong>{{ __('title') }}:</strong></label>
                                    <div class="col-md-4 pl-md-0">
                                        <input type="text" class="form-control form-control-sm" name="contest_title"
                                            value="{{ $contest->title }}">
                                    </div>
                                </div>
                                <div class="font-size-sm">
                                    <label for="contestTitle"><strong>{{ __('Contents') }}:</strong></label>
                                    <div class="form-group bg-white">
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

                                            <div id="quill-editor">{!! $contest->description !!}</div>
                                        </div>
                                        <textarea style="display: none;" name="contest_description"
                                            id="update_contest_description"></textarea>
                                    </div>
                                </div>
                                <div class="d-flex font-size-sm">
                                    <label for="contestTitle"><strong>{{ __('term') }}:</strong></label>
                                    <div class="form-group ml-3">{{ $contest->days }} {{ __('days') }}</div>
                                </div>
                                <div class="d-flex font-size-sm">
                                    <label for="contestTitle"><strong>{{ __('Currency') }}:</strong></label>
                                    <div class="form-group ml-3">{{ $contest->currency }}</div>
                                </div>
                                <div class="d-flex font-size-sm">
                                    <label for="contestTitle"><strong>{{ __('ExpertiesSkills') }}: </strong></label>
                                    <ul class="list-inline">
                                        @foreach (Illuminate\Support\Str::of($contest->skills)->explode(',') as $skill)
                                            <li
                                                class="list-inline-item badge  font-size-ms font-weight-bold text-primary  border shadow-sm py-2 px-3">
                                                {{ App\Models\User::skillTitle($skill)->title }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                {{-- <div class="d-flex font-size-sm">
                                <label for="contestTitle"><strong>Applicants:</strong></label>
                                <div class="form-group ml-3">0</div>
                            </div> --}}
                                <div class="pt-2">
                                    <button class="btn btn-danger btn-sm mr-1">{{ __('Cancel') }}</button>
                                    {{-- <button class="btn btn-primary btn-sm">Complete</button> --}}
                                    <input type="submit" class="btn btn-primary btn-sm" value="{{ __('Save') }}">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="pills-upgrade" role="tabpanel" aria-labelledby="pills-upgrade-tab">
                    <div class="card card-bordered bg-transparent rounded-xl">
                        <div class="card-header py-4">
                            <h2 class="h5 font-weight-bold mb-0">{{ __('upgradingContest') }}</h2>
                        </div>
                        <div class="card-body pb-0">
                            <div class="form-group hoverable-rows">
                                <div class="row pt-4 pb-3">
                                    <div class="col-md-3 pr-md-0">
                                        <div class="custom-control custom-control-inline custom-checkbox align-middle">
                                            <input type="checkbox" class="custom-control-input" id="Chat">
                                            <label class="custom-control-label" for="Chat"></label>
                                        </div>
                                        <button
                                            class="btn btn-primary btn-sm btn-wider rounded-pill ml-n3">{{ __('chat') }}</button>
                                    </div>

                                    <div class="col-md-7">
                                        <h5 class="font-size-sm font-weight-bold">{{ __('chatHeading') }}</h5>
                                        <p class="font-size-ms">{{ __('chatDescription') }}<a href="#"
                                                class="btn btn-sm btn-danger font-size-xs py-1">{{ __('caution') }} <i
                                                    class="fa fa-caret-right ml-1"></i></a></p>
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

                                <div class="row pt-4 pb-3">
                                    <div class="col-md-3 pr-md-0">
                                        <div class="custom-control custom-control-inline custom-checkbox align-middle">
                                            <input type="checkbox" class="custom-control-input" id="imageVideo">
                                            <label class="custom-control-label" for="imageVideo"></label>
                                        </div>
                                        <button
                                            class="btn btn-primary btn-sm btn-wider rounded-pill ml-n3">{{ __('image') }}</button>
                                    </div>

                                    <div class="col-md-7">
                                        <h5 class="font-size-sm font-weight-bold">{{ __('confirmed') }}</h5>
                                        <p class="font-size-ms">{{ __('videDescription') }}<a href="#"
                                                class="btn btn-sm btn-info font-size-xs py-1">{{ __('introduction') }}
                                                <i class="fa fa-caret-right ml-1"></i></a></p>
                                    </div>

                                    <div class="col-md-2 text-md-right pl-md-0">
                                        <div class="font-size-md">
                                            <span class="ml-1">$0</span>
                                            <p>{{ __('freePurchase') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row pt-4 pb-3">
                                    <div class="col-md-3 pr-md-0">
                                        <div class="custom-control custom-control-inline custom-checkbox align-middle">
                                            <input type="checkbox" class="custom-control-input" id="private">
                                            <label class="custom-control-label" for="private"></label>
                                        </div>
                                        <button
                                            class="btn btn-primary btn-sm btn-wider rounded-pill disabled ml-n3">{{ __('private') }}</button>
                                    </div>

                                    <div class="col-md-7">
                                        <p class="font-size-ms">{{ __('privateServices') }} <a href="#"
                                                class="btn btn-sm btn-info font-size-xs py-1">{{ __('introduction') }}
                                                <i class="fa fa-caret-right ml-1"></i></a></p>
                                    </div>

                                    <div class="col-md-2 text-md-right pl-md-0">
                                        <div class="font-size-md">
                                            <span class="ml-1">$0</span>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row pt-4 pb-3">
                                    <div class="col-md-3 pr-md-0">
                                        <div class="custom-control custom-control-inline custom-checkbox align-middle">
                                            <input type="checkbox" class="custom-control-input" id="Sealed">
                                            <label class="custom-control-label" for="Sealed"></label>
                                        </div>
                                        <button
                                            class="btn btn-success btn-sm btn-wider rounded-pill disabled ml-n3">{{ __('sealed') }}</button>
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

                                <div class="row pt-4 pb-3">
                                    <div class="col-md-3 pr-md-0">
                                        <div class="custom-control custom-control-inline custom-checkbox align-middle">
                                            <input type="checkbox" class="custom-control-input" id="nda">
                                            <label class="custom-control-label" for="nda"></label>
                                        </div>
                                        <button
                                            class="btn btn-danger btn-sm btn-wider rounded-pill disabled ml-n3">{{ __('NDA') }}</button>
                                    </div>

                                    <div class="col-md-7">
                                        <h5 class="font-size-sm font-weight-bold">{{ __('NDAdescription') }}</h5>
                                        <p class="font-size-ms">{{ __('NdaDetails') }} <a href="#"
                                                class="btn btn-sm btn-danger font-size-xs py-1">{{ __('caution') }} <i
                                                    class="fa fa-caret-right ml-1"></i></a></p>
                                    </div>

                                    <div class="col-md-2 text-md-right pl-md-0">
                                        <div class="font-size-md">
                                            <span class="ml-1">$100</span>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row pt-4 pb-3">
                                    <div class="col-md-3 pr-md-0">
                                        <div class="custom-control custom-control-inline custom-checkbox align-middle">
                                            <input type="checkbox" class="custom-control-input" id="Urgent">
                                            <label class="custom-control-label" for="Urgent"></label>
                                        </div>
                                        <button
                                            class="btn btn-warning btn-sm btn-wider rounded-pill ml-n3">{{ __('urgent') }}</button>
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
                            </div>
                        </div>
                        <div class="card-footer d-block">
                            <div class="form-group">
                                <h5 class="font-weight-bold">{{ __('total') }}: $1</h5>
                            </div>
                            <button class="btn btn-danger btn-sm mr-1">{{ __('Cancel') }}</button>
                            <button class="btn btn-primary btn-sm">{{ __('Upgrade') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
