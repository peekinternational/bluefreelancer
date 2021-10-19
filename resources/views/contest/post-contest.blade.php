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
        <h1 class="h5 font-weight-bold text-white">{{ __('contestPost') }}</h1>
    </div>

    <section class="container py-5">
        <h2 class="h4 font-weight-bold mb-4">
            <i class="fa fa-desktop mr-2"></i>
            {{ __('StartRegistrationOfContest') }}
        </h2>
        <p class="font-size-sm font-weight-bold mb-4 pl-4 ml-3 pb-1">
            <i class="fa fa-warning text-danger mr-2"></i> {{ __('Below') }} <span
                class="icon icon-sm bg-secondary text-white mx-1">1</span> {{ __('From') }} <span
                class="icon icon-sm bg-secondary text-white mx-1">5</span> {{ __('RequiredItemsMustFilloutInTheOrder') }}
        </p>

        <div class="row">
            <div class="col-md-9">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('contest.store') }}" method="post" id="post_contest_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card card-bordered rounded-xl shadow p-md-4 mb-4">
                        <div class="card-body px-5">
                            <div class="form-group mb-4">
                                <div class="font-size-sm font-weight-bold mb-3">
                                    <div class="icon bg-secondary text-white mr-2">1</div>
                                    {{ __('SelectContestType') }}
                                </div>
                                <select class="form-control" data-toggle="select" id="contest_select_category"
                                    name="main_category" required>
                                    <option value="">Select Contest Category |
                                        콘테스트 카테고리 선택</option>
                                    {{-- Coming Option From Ajax.js (AJAX CALL) --}}
                                </select>
                                <br>
                                <select style="display: none;" class="form-control" data-toggle="select"
                                    id="contest_select_subcategory" name="sub_category" required>
                                    {{-- Coming Option From Ajax.js (AJAX CALL) --}}
                                </select>
                            </div>

                            <div class="form-group mb-4 pt-2">
                                <div class="font-size-sm font-weight-bold mb-3">
                                    <div class="icon bg-secondary text-white mr-2">2</div>
                                    {{ __('EnterTitleContest') }}
                                </div>

                                <label class="font-size-ms font-weight-bold mb-2" for="projectTitle">
                                    {{ __('ContestTitle') }}
                                    <div class="icon icon-sm ml-2" data-toggle="popover" data-trigger="hover"
                                        data-placement="top" title="Popover title"
                                        data-content="And here's some amazing content. It's very engaging. Right?">
                                        <i class="fa fa-question"></i>
                                    </div>
                                </label>
                                <input type="text" class="form-control" id="projectTitle"
                                    placeholder="Enter Contest name | 대회명 입력" name="title">
                            </div>

                            <div class="form-group mb-4">
                                <div class="font-size-sm font-weight-bold mb-3">
                                    <div class="icon bg-secondary text-white mr-2">3</div>
                                    {{ __('FillContest') }}
                                </div>

                                <label class="font-size-ms font-weight-bold mb-2">
                                    {{ __('ExpertiesRequired') }}
                                    <div class="icon icon-sm ml-2" data-toggle="popover" data-trigger="hover"
                                        data-placement="top" title="Popover title"
                                        data-content="And here's some amazing content. It's very engaging. Right?">
                                        <i class="fa fa-question"></i>
                                    </div>
                                </label>

                                <select class="custom-select" data-toggle="select" id="post_contest_skills" multiple>
                                    {{-- Coming Option From Ajax.js (AJAX CALL) --}}
                                </select>
                                <input type="hidden" name="contest_skills" id="selected_post_contest_skills" required>
                            </div>

                            <div class="form-group mb-4">
                                <label class="font-size-ms font-weight-bold mb-2" for="projectTitle">
                                    {{ __('ContentsOfContest') }}
                                    <div class="icon icon-sm ml-2" data-toggle="popover" data-trigger="hover"
                                        data-placement="top" title="Popover title"
                                        data-content="And here's some amazing content. It's very engaging. Right?">
                                        <i class="fa fa-question"></i>
                                    </div>
                                </label>

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
                                        {{-- <span class="ql-formats">
                                        <button class="ql-link"></button>
                                        <button class="ql-image"></button>
                                        <button class="ql-video"></button>
                                    </span> --}}
                                        <span class="ql-formats">
                                            <button class="ql-clean"></button>
                                        </span>
                                    </div>

                                    <div id="quill-editor"></div>
                                    <textarea style="display: none;" name="contest_description"
                                        id="contest_description"></textarea>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <label class="font-size-ms font-weight-bold mb-2">
                                            <i class="fa fa-warning text-danger mr-2"></i> {{ __('AttachmentSize') }}
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="file" name="file" data-max-file-size="1MB">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <div class="font-size-sm font-weight-bold mb-3">
                                    <div class="icon bg-secondary text-white mr-2">4</div>
                                    {{ __('ContentExpenditure') }}
                                </div>
                                <p class="font-size-sm"><i class="fa fa-warning text-danger mr-2"></i>
                                    <span>{{ __('RecomendedStartingPrizeValue') }}</span>
                                    <span>{{ __('PrizeMoneyOver100Million') }}</span>
                                </p>

                                <div class="card card-body px-5 rounded-xl">
                                    <div class="range-slider"
                                        data-range-options='{"start": 0, "pips": {"mode": "count", "values": 2}, "tooltips": true, "range": {"min": 0, "max": 10000}}'>
                                        <div class="range-slider-ui my-5"></div>

                                        <div class="row pt-2">
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    {{-- <div class="input-group-prepend"><span class="input-group-text">$</span>
                                                </div> --}}
                                                    <input class="form-control range-slider-value-min" name="budget"
                                                        type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control" name="currency" data-toggle="select">
                                                    <option value="USD">US Dollar (USD $)</option>
                                                    <option value="KRW">Korean Yen (KRW ₩)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4 pt-2">
                                <div class="font-size-sm font-weight-bold mb-3">
                                    <div class="icon bg-secondary text-white mr-2">5</div>
                                    {{ __('ConatestPeriod') }}
                                </div>

                                <p class="font-size-sm"><i class="fa fa-warning text-danger mr-2"></i>
                                    {{ __('IfWinnerNotSelected') }}
                                </p>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            {{ __('WorkDays') }}
                                        </div>
                                    </div>
                                    <input type="number" name="days" class="form-control"
                                        placeholder="{{ __('ContestDuration') }}">
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <div class="font-size-sm font-weight-bold mb-3">
                                    <div class="icon bg-secondary text-white mr-2">6</div>
                                    {{ __('optional') }}
                                </div>

                                <p class="font-size-ms">
                                    <i class="fa fa-warning text-danger mr-2"></i>
                                    {{ __('notice') }}
                                </p>

                                <hr>

                                <div class="row">
                                    <div class="col-md-3 pr-md-0">
                                        <div class="custom-control custom-control-inline custom-checkbox align-middle">
                                            <input type="checkbox" class="custom-control-input" id="Chat">
                                            <label class="custom-control-label" for="Chat"></label>
                                        </div>
                                        <button class="btn btn-primary btn-sm px-4 ml-n3">{{ __('chat') }}</button>
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

                                <div class="row">
                                    <div class="col-md-3 pr-md-0">
                                        <div class="custom-control custom-control-inline custom-checkbox align-middle">
                                            <input type="checkbox" class="custom-control-input" id="imageVideo">
                                            <label class="custom-control-label" for="imageVideo"></label>
                                        </div>
                                        <button class="btn btn-primary btn-sm px-4 ml-n3">{{ __('image') }}</button>
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

                                <div class="row">
                                    <div class="col-md-3 pr-md-0">
                                        <div class="custom-control custom-control-inline custom-checkbox align-middle">
                                            <input type="checkbox" class="custom-control-input" id="private">
                                            <label class="custom-control-label" for="private"></label>
                                        </div>
                                        <button
                                            class="btn btn-primary btn-sm disabled px-4 ml-n3">{{ __('private') }}</button>
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

                                <div class="row">
                                    <div class="col-md-3 pr-md-0">
                                        <div class="custom-control custom-control-inline custom-checkbox align-middle">
                                            <input type="checkbox" class="custom-control-input" id="Sealed">
                                            <label class="custom-control-label" for="Sealed"></label>
                                        </div>
                                        <button
                                            class="btn btn-success btn-sm disabled px-4 ml-n3">{{ __('sealed') }}</button>
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
                                        <div class="custom-control custom-control-inline custom-checkbox align-middle">
                                            <input type="checkbox" class="custom-control-input" id="nda">
                                            <label class="custom-control-label" for="nda"></label>
                                        </div>
                                        <button
                                            class="btn btn-danger btn-sm disabled px-4 ml-n3">{{ __('NDA') }}</button>
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

                                <div class="row">
                                    <div class="col-md-3 pr-md-0">
                                        <div class="custom-control custom-control-inline custom-checkbox align-middle">
                                            <input type="checkbox" class="custom-control-input" id="Urgent">
                                            <label class="custom-control-label" for="Urgent"></label>
                                        </div>
                                        <button class="btn btn-warning btn-sm px-4 ml-n3">{{ __('urgent') }}</button>
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

                            <div class="form-group mb-4">
                                <h5 class="font-weight-bold">{{ __('total') }}: $0</h5>
                            </div>

                            <p class="font-size-sm mb-0"><i class="fa fa-warning text-danger mr-2"></i>
                                {{ __('endDetail') }}</p>
                        </div>
                    </div>
                    <input type="submit" value="{{__('PostContest')}}" class="btn btn-primary">
                </form>
            </div>

            <div class="col-md-3">
                <img src="{{ url('assets/img/pages/home/illustration-1.png') }}" alt="Illustration"
                    class="img-fluid mb-4">

                <div class="card card-bordered rounded-xl shadow mb-4">
                    <div class="card-header text-center py-4">
                        <h6 class="font-size-sm font-weight-bold">{{ __('postProjectFree') }}</h6>
                        <p class="font-size-sm font-weight-bold mb-0">
                            <i class="fa fa-paper-plane mr-1"></i>
                            {{ __('projectFreeRegister') }}
                        </p>
                    </div>

                    <div class="card-body">
                        <ul class="list-unstyled font-size-ms">
                            <li class="d-flex mb-2"><i class="fa fa-check text-secondary mt-1 mr-1"></i>
                                {{ __('conciseNameofYourProject') }}</li>
                            <li class="d-flex mb-2"><i class="fa fa-check text-secondary mt-1 mr-1"></i>
                                {{ __('DetailDescriptionofYourProject') }}</li>
                            <li class="d-flex mb-2"><i class="fa fa-check text-secondary mt-1 mr-1"></i>
                                {{ __('ProvideImagesorPDFWithSpecificationOfYourProject') }}</li>
                            <li class="d-flex mb-2"><i class="fa fa-check text-secondary mt-1 mr-1"></i>
                                {{ __('FeelFreetoPostTheProject') }}</li>
                            <li class="d-flex">
                                <i class="fa fa-check text-secondary mt-1 mr-1"></i>
                                <span>{{ __('TheProjectRegistrationOrderIs') }} <b
                                        class="text-info">{{ __('HowTheProjectWorks') }}</b>
                                    &gt;
                                    <b class="text-info">{{ __('CurrentStatusOftTheProject') }}</b> &gt; <b
                                        class="text-info">{{ __('DetailedBusinessContents') }}</b> &gt; <b
                                        class="text-info">{{ __('ReferencesAndNotes') }}</b>
                                    {{ __('ReferToTheExampleInOrder') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card card-bordered rounded-xl shadow mb-4">
                    <div class="card-header text-center py-4">
                        <h6 class="font-size-sm font-weight-bold">{{ __('ContestWithoutRealTimePublicForumisPast') }}
                        </h6>
                        <p class="font-size-sm font-weight-bold mb-0">
                            <i class="fa fa-forumbee mr-1"></i>
                            {{ __('SimultaneousInterviewsWithApplicants') }}
                        </p>
                    </div>

                    <div class="card-body">
                        <ul class="list-unstyled font-size-ms">
                            <li class="d-flex mb-2"><i class="fa fa-check text-secondary mt-1 mr-1"></i>
                                {{ __('SetAcontestPrizeAndOpenArealTimePublicForum') }}</li>
                            <li class="d-flex mb-2"><i class="fa fa-check text-secondary mt-1 mr-1"></i>
                                {{ __('applicantsSelectedByTheClient') }}</li>
                            <li class="d-flex mb-2"><i class="fa fa-check text-secondary mt-1 mr-1"></i>
                                {{ __('selectedFreelancerAndClientCanSaveTime') }}</li>
                            <li class="d-flex mb-2"><i class="fa fa-check text-secondary mt-1 mr-1"></i>
                                {{ __('UnlimitedUseAnyTimebyRegistration') }}</li>
                            <li class="d-flex"><i class="fa fa-check text-secondary mt-1 mr-1"></i>
                                {{ __('UseGoogleChromeforSecurity') }}</li>
                        </ul>

                        <div class="text-center">
                            <button class="btn btn-secondary btn-sm">{{ __('ContestFreeRegistration') }}</button>
                        </div>
                    </div>
                </div>

                <div class="card card-bordered rounded-xl shadow mb-4">
                    <div class="card-header text-center py-4">
                        <h6 class="font-size-sm font-weight-bold">{{ __('HowToWriteProjectContents') }}</h6>
                        <p class="font-size-sm font-weight-bold mb-0">
                            {{ __('ExampleProjectContent') }}
                            <span class="badge badge-secondary">{{ __('seeExample') }}</span>
                        </p>
                    </div>

                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
