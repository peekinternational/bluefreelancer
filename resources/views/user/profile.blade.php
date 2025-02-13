@extends('layouts.app')
@section('content')
<style>
    .editable-btn {
        color: #fff;
        border: 1px solid #fff;
        border-radius: 10px;
        padding: 10px;
    }

    .editable-btn-dark {
        color: black;
        border: 1px solid black;
        border-radius: 10px;
        padding: 5px;
        font-size: 10px;
    }

    .added-btn-dark {
        color: black;
        border: 1px solid black;
        border-radius: 10px;
        padding: 5px;
        font-size: 10px;
    }

    form label {
        padding-top: 5px;
    }

    .select2-selection__choice {
        margin-top: 0px !important;
    }
</style>
<div class="bg-secondary text-center bg-cover py-5"
    style="height: 380px; background-image: url({{ $user->cover_img == '' ? url('assets/img/pages/directory/banner-1.png') : url('uploads/users/' . $user->id . '/images/' . $user->cover_img) }});">
    @if (request()->has('edit_profile'))
    @error('cover_img')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <form action="{{ route('/profile/coverImg') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="file btn btn-lg btn-primary" style="position: relative;overflow: hidden;font-size:15px;">
            Upload Cover Image
            <input type="file" name="cover_img" id="cover_img"
                style=" position: absolute;font-size: 50px;opacity: 0;right: 0;top: 0;" onchange="uploadBtn()" />
        </div>
        <input type="submit" value="Upload" class="btn btn-success" style="display: none;" id="upload-cover-img-btn">
    </form>
    @endif

</div>

<section class="bg-gray-800 pt-4">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-2 text-center mb-4">
                <h2 class="font-weight-bold text-white">0%</h2>
                <p class="font-weight-bold text-white mb-0">{{ __('Completionrate') }}</p>
            </div>

            <div class="col-md-2 text-center mb-4">
                <h2 class="font-weight-bold text-white">{{$user->on_budget ?
                    Illuminate\Support\Str::of($user->on_budget)->before('.'): '0'}}%</h2>
                <p class="font-weight-bold text-white mb-0">{{ __('BudgetCompletionRate') }}</p>
            </div>

            <div class="col-md-2 text-center mb-4">
                <h2 class="font-weight-bold text-white">{{ $user->on_time ?
                    Illuminate\Support\Str::of($user->on_time)->before('.'): '0' }}%</h2>
                <p class="font-weight-bold text-white mb-0">{{ __('WorkingPeriodCompRate') }}</p>
            </div>

            <div class="col-md-2 text-center mb-4">
                <h2 class="font-weight-bold text-white">0%</h2>
                <p class="font-weight-bold text-white mb-0">{{ __('RefundRate') }}</p>
            </div>

            <div class="col-md-2 text-center mb-4">
                <h2 class="font-weight-bold text-white">
                    {{ $user->hourly_rate ? $user->hourly_rate : '00' }}</h2>
                <p class="font-weight-bold text-white mb-0">{{ __('CostperHour') }}</p>
                @if (request()->has('edit_profile'))
                <a class="fa fa-pencil editable-btn" data-toggle="modal" data-target="#hourly_modal"></a>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-bordered card-body rounded-xl mb-4">
                <div class="row">
                    <div class="col-md-5 mb-4 mb-md-0">
                        <div class="card text-center">
                            <div class="pt-4 mx-auto">
                                <img class="avatar-bordered rounded-circle shadow-lg"
                                    src="{{ $user->img == '' ? url('assets/img/pages/default.png') : url('uploads/users/' . $user->id . '/images/' . $user->img) }}"
                                    alt="User thumbnail" id="profile_img" style="width: 10rem; height:10rem;">

                                @if (request()->has('edit_profile'))
                                @error('img')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <form action="{{ route('/profile/profileImg') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="file btn btn-sm btn-primary" id="custom_prof_btn"
                                        style="position: relative;overflow: hidden;font-size:10px;top:-35px;">
                                        <i class="fa fa-camera"></i>
                                        <input type="file" name="img" id="img"
                                            style=" position: absolute;font-size: 50px;opacity: 0;right: 0;top: 0;"
                                            onchange="uploadProfBtn()" />
                                    </div>
                                    <br>
                                    <input type="submit" value="Upload" class="btn btn-sm btn-success"
                                        style="display: none;" id="upload-profile-img-btn">
                                </form>
                                @endif

                            </div>

                            <div class="card-body">
                                <p class="card-text mb-2">{{ '@' . $user->username }}</p>
                                <div class="d-flex justify-content-between align-items-center pb-3 mb-1">
                                    <div class="mr-2">
                                        <span
                                            class="badge bg-success-alt text-white mr-2">{{App\Models\User::find($user->id)->rating
                                            ?
                                            App\Models\User::find($user->id)->rating : '0.00'}}</span>
                                        @php
                                        $stars =
                                        Illuminate\Support\Str::of(App\Models\User::find($user->id)->rating)->explode('.');
                                        @endphp
                                        <div class="ratings mr-3">
                                            @for ($i = 0; $i < 5; $i++) @if ($i < $stars[0]) <i
                                                class="fa fa-star active mr-1">
                                                </i>
                                                @else
                                                <i class="fa fa-star-o mr-1"></i>
                                                @endif
                                                @endfor
                                        </div>
                                    </div>
                                    <span class="font-size-sm">{{App\Models\Feedback::reviews($user->id)}}
                                        Reviews</span>
                                </div>
                                <div class="font-size-sm text-center mb-2">
                                    {{ $user->created_at->format('M d, Y') }}</div>
                                <div class="text-center">
                                    {{-- <div class="icon text-info border-info mx-1">
                                        <i class="fa fa-map-marker"></i>
                                    </div> --}}
                                    <div class="icon mx-1">
                                        <i class="fa fa-asterisk"></i>
                                    </div>
                                    <div class="icon text-info border-info mx-1">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    @if (!$user->email_verified_at)
                                    <div class="icon border-info mx-1">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    @else
                                    <div class="icon text-info border-info mx-1">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7 pl-md-2">
                        <h2 class="h5 font-weight-bold pt-3 pb-2">{{ $user->companyname }}</h2>
                        <h6 class="font-weight-bold">
                            {{ $user->prof_headline ? $user->prof_headline : 'Write Your Professional Headline' }}
                            @if (request()->has('edit_profile'))
                            <a class="fa fa-pencil editable-btn-dark" data-toggle="modal"
                                data-target="#profession_headline_modal"></a>
                            @endif
                        </h6>
                        <div class="row border mx-0 mb-2">
                            <div class="col-md-6 bg-light">
                                <p class="my-2">{{ __('CompanyRegistrationNumber') }}</p>
                                {{-- <p class="my-2">Number</p> --}}
                            </div>

                            <div class="col-md-6">
                                <p class="my-2">{{ $user->business_reg_num }}</p>
                            </div>
                        </div>

                        <h2 class="h5 font-weight-bold pt-3 pb-2">{{ __('CompanyIntroduction') }}
                            @if (request()->has('edit_profile'))
                            <a class="fa fa-pencil editable-btn-dark" data-toggle="modal"
                                data-target="#description_modal"></a>
                            @endif
                        </h2>
                        <p class="card-text">
                            {{ $user->description ? $user->description : 'Please Write Your Company
                            Introduction/Description' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="card card-bordered rounded-xl mb-4">
                <div class="card-header py-4">
                    <h2 class="h5 font-weight-bold mb-0">{{ __('CareerIntroductionandReviews') }} -
                        ({{$feedbacks->count()}})</h2>
                </div>

                <div class="card-body">
                    @if ($feedbacks->count())
                    <ul class="list-inline">
                        @foreach ($feedbacks as $item)
                        @if (App\Models\Feedback::isBothExist($item->project_id))
                        <li class="list-inline-item" style="width:100%">
                            <h5 class="text-bold">{{$item->project->title}}</h5>
                            <p class="p-0">{{$item->comments}}</p>
                            <h6>From: {{App\Models\User::find($item->user_from)->username}}</h6>
                            <h6>
                                @if ($item->project->min_budget && $item->project->max_budget)
                                {{ $item->project->currency == 'USD' ? '$' : '₩' }} {{ $item->project->min_budget }} -
                                {{ $item->project->currency == 'USD' ? '$' : '₩' }} {{ $item->project->max_budget }}
                                @else
                                @if ($item->project->rate_status == '1')
                                {{ $item->project->fixed_rate }}
                                @else
                                {{ $item->project->hourly_rate . '/' . __('hourly') }}
                                @endif
                                @endif
                            </h6>
                            <div>
                                @php
                                $totalRating = ($item->professionalism +
                                $item->communication + $item->payment + $item->clarity_spec + $item->emp) /
                                5;
                                $stars =
                                Illuminate\Support\Str::of($totalRating)->explode('.');
                                @endphp
                                <span class="badge bg-warning text-white mr-2">{{$totalRating}}</span>

                                <div class="ratings">
                                    @for ($i = 0; $i < 5; $i++) @if ($i < $stars[0]) <i class="fa fa-star active mr-1">
                                        </i>
                                        @else
                                        <i class="fa fa-star-o mr-1"></i>
                                        @endif
                                        @endfor
                                </div>
                            </div>
                            <hr class="px-4">
                        </li>
                        @endif

                        @endforeach
                    </ul>
                    @else
                    {{__('feedbackNotExist')}}
                    @endif

                </div>
            </div>

            <div class="card card-bordered rounded-xl mb-4">
                <div class="card-header py-4">
                    <h2 class="h5 font-weight-bold mb-0">{{ __('Portfolio') }}
                        @if (request()->has('edit_profile'))
                        <a class="btn fa fa-plus added-btn-dark float-right" data-toggle="modal"
                            data-target="#portfolio_modal"> {{ __('CreatePortfolio') }}</a>
                        @endif
                    </h2>
                </div>

                <div class="card-body">
                    <ul class="list-inline">
                        @if ($portfolios->count())
                        @foreach ($portfolios as $port)
                        <li class="list-inline-item" style="width: 300px;">
                            @if (request()->has('edit_profile'))
                            <a class="btn fa fa-pencil editable-btn-dark mb-2" id="port_UpModal_btn" data-toggle="modal"
                                data-id="{{ $port->id }}"> Edit Portfolio</a>
                            @endif
                            <img src="{{ url('uploads/users/' . $user->id . '/images/portfolio/' . $port->image) }}"
                                alt="" srcset="" width="100%"
                                style="border-radius:15px; max-width:300px; max-height:300px;">
                        </li>
                        @endforeach
                        @else
                        <li> <span>{{ __('portfolioNotExist') }}</span>
                        </li>
                        @endif

                    </ul>
                </div>
            </div>

            <div class="card card-bordered rounded-xl mb-4">
                <div class="card-header py-4">
                    <h2 class="h5 font-weight-bold mb-0">{{ __('Career') }}
                        @if (request()->has('edit_profile'))
                        <a class="fa fa-plus added-btn-dark" data-toggle="modal" data-target="#experience_modal"
                            style="float: right"></a>
                        @endif
                    </h2>
                </div>
                @if ($experiences->count())
                @foreach ($experiences as $exp)
                <x-user_experience :exp="$exp" />
                @endforeach
                @else
                <span class="p-4">{{ __('expNotExist') }}</span>
                @endif
            </div>

            <div class="card card-bordered rounded-xl mb-4">
                <div class="card-header py-4">
                    <h2 class="h5 font-weight-bold mb-0">{{ __('Education') }}
                        @if (request()->has('edit_profile'))
                        <a class="fa fa-plus added-btn-dark" data-toggle="modal" data-target="#education_modal"
                            style="float: right"></a>
                        @endif
                    </h2>
                </div>
                @if ($education->count())
                @foreach ($education as $edu)
                <x-user_education :edu="$edu" />
                @endforeach
                @else
                <span class="p-4">{{ __('eduNotExist') }}</span>
                @endif
            </div>

            <div class="card card-bordered rounded-xl mb-4">
                <div class="card-header py-4">
                    <h2 class="h5 font-weight-bold mb-0">{{ __('CertificationsDiplomasorAwards') }}
                        @if (request()->has('edit_profile'))
                        <a class="fa fa-plus added-btn-dark" data-toggle="modal" data-target="#certification_modal"
                            style="float: right"></a>
                        @endif
                    </h2>
                </div>
                @if ($certifications->count())
                @foreach ($certifications as $cert)
                <x-user_certification :cert="$cert" />
                @endforeach
                @else
                <span class="p-4">{{ __('certNotExist') }}</span>
                @endif
            </div>

            <div class="card card-bordered rounded-xl mb-4">
                <div class="card-header py-4">
                    <h2 class="h5 font-weight-bold mb-0">{{ __('PromoteYourArticles') }}
                        @if (request()->has('edit_profile'))
                        <a class="fa fa-plus added-btn-dark" data-toggle="modal" data-target="#publication_modal"
                            style="float: right"></a>
                        @endif
                    </h2>
                </div>
                @if ($publications->count())
                @foreach ($publications as $pub)
                <x-user_publication :pub="$pub" />
                @endforeach
                @else
                <span class="p-4">{{ __('pubNotExist') }}</span>
                @endif
            </div>


        </div>
        {{-- Project Offer Milestone Modal --}}
        <div class="modal fade" id="projectOfferMilestoneModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('DepositPayment') }}</h5>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> --}}
                    </div>
                    <form method="post" action="{{ route('project-offer.milestone-deposit') }}"
                        id="projectOfferMilestoneForm">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="projOfferMsProjectId" id="projOfferMilestoneProjectId">
                            <input type="hidden" name="projOfferMsUserId" id="projOfferMilestoneUserId">
                            <input type="hidden" name="projOfferMsBidId" id="projOfferMilestoneBidId">
                            <label class="font-size-ms font-weight-bold" for="projOfferMilestoneAmount">{{
                                __('DepositAmount') }}:</label>
                            <input type="text" name="projOfferMsAmount" class="form-control"
                                id="projOfferMilestoneAmount">
                            <label class="font-size-ms font-weight-bold" for="projOfferMilestonDescription">{{
                                __('DepositDescription') }}:</label>
                            <input type="text" name="projOfferMsDescription" class="form-control"
                                id="projOfferMilestoneDescription">

                        </div>
                        <div class="modal-footer">
                            <a href="#" id="payment-after-consulantation"
                                class="payment-after-consulantation btn btn-secondary">{{ __('consultation') }}</a>
                            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            --}}
                            {{-- id="projectOfferMilestoneDepositPayment" --}}
                            <input type="submit" id="projectOfferMilestoneDepositPayment" value="Payment"
                                class="btn btn-primary">
                            {{-- <button type="button" class="btn btn-primary" id="publication-save-btn">Save
                                changes</button> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-bordered rounded-xl overflow-hidden mb-4">
                <div class="card-body text-center">
                    {{-- Profile Actions --}}
                    @if ($user->id === auth()->id())
                    @if (!request('edit_profile'))

                    <form action="{{ route('profile') }}" method="get">
                        <input type="submit" value="Edit Profile" class="btn btn-sm btn-dark btn-block m-2">
                        <input type="hidden" value="1" name="edit_profile">
                    </form>

                    @else
                    <form action="{{ route('profile') }}" method="get">
                        <input type="submit" value="View Profile" class="btn btn-sm btn-dark btn-block m-2">
                    </form>
                    @endif
                    @endif

                    @if (request('view') != 'client')
                    <form action="{{ route('profile') }}" method="get">
                        <input type="submit" value="{{ __('ClientViewer') }}"
                            class="btn btn-sm btn-secondary btn-block m-2">
                        <input type="hidden" value="client" name="view">
                    </form>
                    @else
                    <form action="{{ route('profile') }}" method="get">
                        <input type="submit" value="{{ __('FreelanceViewer') }}"
                            class="btn btn-sm btn-secondary btn-block m-2">
                        <input type="hidden" value="freelancer" name="view">
                    </form>
                    @endif

                    @if (request()->has('outsourcer'))
                    <form action="#" method="post">
                        {{-- @csrf --}}
                        <input type="hidden" name="" id="projectOfferOutsourcer" value="{{ request('outsourcer') }}">
                        <div class="card-body bg-gray-800 py-4 mt-4">
                            <h6 class="font-weight-bold text-white border-bottom border-light pb-3 mb-3">
                                {{ __('Contact') }}
                                {{ $user->username }} {{ __('AboutYourWorkOpportunity') }}</h6>
                            <div class="font-weight-bold text-white mb-4">{{ __('BudgetAmount') }} :</div>
                            <div class="custom-control custom-radio mb-4">
                                <input type="radio" id="projectOfferFixedRate" name="fixedRate"
                                    class="custom-control-input" value="1" checked>
                                <label class="custom-control-label text-white font-size-sm"
                                    for="projectOfferFixedRate">{{ __('fixedAmount') }}</label>
                            </div>

                            <div class="row">
                                <div class="col-sm-4 form-group pr-sm-2">
                                    <select class="custom-select" name="currency" id="projectOfferCurrency">
                                        <option value="KRW">KRW</option>
                                        <option value="USD">USD</option>
                                    </select>
                                </div>

                                <div class="col-sm-8 form-group pl-sm-2">
                                    <input type="number" class="form-control" placeholder="Budget" required
                                        name="budget" id="projectOfferBudget">
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Title" name="title" required
                                    id="projectOfferTitle">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" placeholder="Enter Description" name="description"
                                    required id="projectOfferDescription"></textarea>
                            </div>

                            <div class="from-group">
                                <input id="projectOfferBtn" type="submit" class="btn btn-primary btn-block"
                                    value="Freelance job {{ $user->username }}">
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>

            <div class="card card-bordered rounded-xl overflow-hidden mb-4">
                <div class="card-header py-4">
                    <h2 class="h5 font-weight-bold mb-0">{{ __('IdentityVerificationConfirmation') }}</h2>
                </div>
                <ul class="list-group list-group-flush">
                    {{-- <li class="list-group-item d-flex justify-content-between">
                        <div class="media">
                            <div class="icon text-info border-info">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="media-body text-info ml-2 pl-1">Location verified</div>
                        </div>
                        <i class="fa fa-check h4 text-info mb-0"></i>
                    </li> --}}
                    @if (!$user->paypal_verified)
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="media">
                            <div class="icon">
                                <i class="fa fa-asterisk"></i>
                            </div>
                            <div class="media-body ml-2 pl-1">{{ __('AccountInformationAuthentication') }}</div>
                        </div>
                        <form action="{{ route('payment') }}" method="get">
                            @csrf
                            <input type="hidden" name="paypal_deposit_amt" value="1">
                            <input type="submit" value="{{ __('RequireCertification') }}" class="btn btn-sm btn-info">
                        </form>
                    </li>
                    @else
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="media">
                            <div class="icon text-info border-info">
                                <i class="fa fa-asterisk"></i>
                            </div>
                            <div class="media-body text-info  ml-2 pl-1">{{ __('AccountInformationAuthentication') }}
                            </div>
                        </div>
                        <i class="fa fa-check text-info h4 mb-0"></i>
                    </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="media">
                            <div class="icon text-info border-info">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="media-body text-info ml-2 pl-1">{{ __('MobilePhoneAuthentication') }}</div>
                        </div>
                        <i class="fa fa-check text-info h4 mb-0"></i>
                    </li>
                    @if (!$user->email_verified_at)
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="media">
                            <div class="icon ">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="media-body  ml-2 pl-1">{{ __('EmailAuthentication') }}</div>
                        </div>
                        {{-- <a href="{{ route('verification.notice') }}" class="btn btn-sm btn-info">Verify</a> --}}
                        @if ($user->id == auth()->id())
                        <form action="{{ route('verification.send') }}" method="post">
                            @csrf
                            <input type="submit" class="btn btn-sm btn-info" value="Verify">
                        </form>
                        @endif
                    </li>
                    @else
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="media">
                            <div class="icon text-info border-info">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="media-body text-info ml-2 pl-1">{{ __('EmailAuthentication') }}</div>
                        </div>
                        <i class="fa fa-check text-info h4 mb-0"></i>

                    </li>
                    @endif


                </ul>
            </div>

            <div class="card card-bordered rounded-xl mb-4">
                <div class="card-header d-flex justify-content-between py-4">
                    <h2 class="h5 font-weight-bold mb-0">{{ __('Expertise') }}</h2>
                    @if ($user->id === auth()->id())
                    <button class="btn btn-sm btn-secondary" onclick="addSkills()">+ {{ __('Add') }}</button>
                    @endif
                </div>
                <div class="card-body">
                    @if ($user->skills)
                    <ul class="list-inline">
                        @foreach (Illuminate\Support\Str::of($user->skills)->explode(',') as $skill)
                        <li class="badge badge-lg bg-success-alt text-white mr-1 mb-1 list-inline-item">
                            {{ App\Models\User::skillTitle($skill)->title }}</li>
                        @endforeach
                    </ul>
                    @else
                    <span>{{ __('skillsNotExist') }}</span>
                    @endif
                    <div id="skill_select_block" style="display: none;">
                        <button class="btn btn-info btn-sm" onclick="saveFun()">{{ __('Save') }}</button>
                        <br>
                        <select
                            class="js-skills-tags form-control select2 select2-container select2-container--default mt-2"
                            id="select_top_skills" multiple="multiple">
                            @if ($user->skills)
                            <ul class="list-inline">
                                @foreach (Illuminate\Support\Str::of($user->skills)->explode(',') as $skill)
                                <option selected="selected" value="{{ $skill }}">
                                    {{ App\Models\User::skillTitle($skill)->title }}
                                </option>
                                @endforeach
                            </ul>
                            @endif
                        </select>
                    </div>
                </div>
            </div>

            <div class="card card-bordered rounded-xl mb-4">
                <div class="card-header d-flex justify-content-between py-4">
                    <h2 class="h5 font-weight-bold mb-0">{{ __('Certificate') }}</h2>
                    @if ($user->id === auth()->id())
                    <button class="btn btn-sm btn-secondary" onclick="addCerts()">+ {{ __('Add') }}</button>
                    @endif
                </div>
                <div class="card-body">
                    @if ($user->certs)
                    <ul class="list-inline">
                        @foreach (Illuminate\Support\Str::of($user->certs)->explode(',') as $cert)
                        <li class="badge badge-lg bg-success-alt text-white mr-1 mb-1 list-inline-item">
                            {{ App\Models\User::certTitle($cert)->title }}</li>
                        @endforeach
                    </ul>
                    @else
                    <span>{{ __('topCertNotExist') }}</span>
                    @endif
                    <div id="cert_select_block" style="display: none;">
                        <button class="btn btn-info btn-sm" onclick="saveFun()">{{ __('Save') }}</button>
                        <br>
                        <select
                            class="js-certs-tags form-control select2 select2-container select2-container--default mt-2"
                            id="select_top_certs" multiple="multiple">
                            @if ($user->certs)
                            <ul class="list-inline">
                                @foreach (Illuminate\Support\Str::of($user->certs)->explode(',') as $cert)
                                <option selected="selected" value="{{ $cert }}">
                                    {{ App\Models\User::certTitle($cert)->title }}
                                </option>
                                @endforeach
                            </ul>
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ====================== --}}
{{-- ======= MODELS ======= --}}
{{-- ====================== --}}
{{-- Portfolio Modal --}}
<div class="modal fade" id="portfolio_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('CreatePortfolio') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="portfolio_form" method="post" enctype="multipart/form-data">
                    <label for="port_title">{{ __('CareerName') }}:</label>
                    <input type="text" class="form-control" name="port_title" id="port_title" required>
                    <label for="port_description">{{ __('Description') }}:</label>
                    <textarea class="form-control" name="port_description" id="port_description" cols="30" rows="10"
                        required></textarea>
                    <label for="port_file">{{ __('file') }}: <small> {{ __('fileValid') }}</small></label>
                    <input type="file" class="form-control" name="port_image" id="port_image" required>
                    <label for="select_port_skills">{{ __('ExpertiesSkills') }}:</label><br>
                    <select
                        class="portfolio-skills-tags form-control select2 select2-container select2-container--default"
                        id="select_port_skills" multiple="multiple" required>
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary" id="portfolio-save-btn">{{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>
{{-- Portfolio Modal --}}
<div class="modal fade" id="portfolio_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('CreatePortfolio') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="portfolio_update_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="port_id">
                    <input type="hidden" id="port_user_id" value="{{ $user->id }}">
                    <label for="port_title">{{ __('CareerName') }}:</label>
                    <input type="text" class="form-control" name="port_title" id="port_title_update" required>
                    <label for="port_description">{{ __('Description') }}:</label>
                    <textarea class="form-control" name="port_description_update" id="port_description_update" cols="30"
                        rows="10" required></textarea>
                    <label for="port_file">{{ __('file') }}: <small> {{ __('fileValid') }}:
                            2MB)</small></label>
                    <input type="file" class="form-control" name="port_image" id="port_image_update" required>
                    <br>
                    <span>{{ __('fileOld') }}:</span>
                    <br>
                    <img src="" id="port_old_img" alt="" srcset="" width="300px"><br>
                    <label for="select_port_skills">{{ __('ExpertiesSkills') }}:</label><br>
                    <select
                        class="portfolio-skills-tags form-control select2 select2-container select2-container--default"
                        id="select_port_skills_update" multiple="multiple" required>
                        @if ($portfolios->count())
                        @foreach ($portfolios as $port)
                        @foreach (Illuminate\Support\Str::of($port->skills)->explode(',') as $skill)
                        <option value="{{ $skill }}" selected>
                            {{ App\Models\User::skillTitle($skill)->title }}
                        </option>
                        @endforeach
                        @endforeach
                        @endif
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary" id="portfolio-update-btn">{{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>
{{-- Hourly Modal --}}
<div class="modal fade" id="hourly_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('hourlyAmount') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="hourly_form" method="post">
                    <input type="number" class="form-control" name="hourly_rate" value="{{ $user->hourly_rate }}"
                        id="hourly_rate">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary" id="hourly-save-btn"> {{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>
{{-- Profession headline Modal --}}
<div class="modal fade" id="profession_headline_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('ProfessionHeadline') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="profession_headline_form" method="post">
                    <input type="text" class="form-control" name="prof_headline" value="{{ $user->prof_headline }}"
                        id="prof_headline">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary" id="profession-headline-save-btn">{{ __('Save')
                    }}</button>
            </div>
        </div>
    </div>
</div>
{{-- Description headline Modal --}}
<div class="modal fade" id="description_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Description') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="description_form" method="post">
                    <textarea name="description" id="company_description" class="form-control" cols="30"
                        rows="10">{{ $user->description }}</textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary" id="description-save-btn">{{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>
{{-- Experience Modal --}}
<div class="modal fade" id="experience_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Career') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="experience_form" method="post">
                    <label for="title">{{ __('CareerName') }}:</label>
                    <input type="text" name="title" class="form-control" id="title">
                    <label for="companyname">{{ __('CompanyName') }}:</label>
                    <input type="text" name="companyname" class="form-control" id="companyname">
                    <label for="started_at">{{__('WorkorJobStartDate')}}:</label>
                    <input type="date" name="started_at" class="form-control" id="started_at">
                    <input type="checkbox" name="work_status" id="work_status" onclick="ShowHideCompletion(this)"
                        value="1">
                    <span>{{__('CurrentlyWorkingorDeveloping')}}</span>

                    <div id="completion_at_row">
                        <label for="completion_at">{{__('WorkorJobEndDate')}}:</label>
                        <input type="date" name="completion_at" class="form-control" id="completion_at">
                    </div>

                    <label for="summary">{{__('BusinessorDevelopmentContent')}}:</label>
                    <textarea name="summary" class="form-control" id="summary" cols="30" rows="10"></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary" id="experience-save-btn">{{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>
{{-- Education Modal --}}
<div class="modal fade" id="education_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Education')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="eduaction_form" method="post">
                    <label class="font-size-ms font-weight-bold" for="country">{{__('Country')}}</label>
                    <select class="custom-select" id="country" name="country">
                        <option value="" selected="selected">Please Select Your Country / 국가를 선택하십시오</option>
                        @foreach (App\Models\Country::all() as $item)
                        <option value="{{ $item->name }}">
                            {{ $item->name }} -
                            {{ $item->code }}</option>
                        @endforeach
                    </select>
                    <label for="name">{{__('UniversityCollege')}}:</label>
                    <input type="text" name="name" class="form-control" id="name">
                    <label for="subjects">{{__('Major')}}:</label>
                    <input type="text" name="subjects" class="form-control" id="subjects">
                    <label for="addmission_year">{{__('AdmissionYear')}}:</label>
                    <select name="addmission_year" class="form-control" id="addmission_year">
                        <x-years />
                    </select>
                    <label for="grad_year">{{__('GraduationYear')}}:</label>
                    <select name="grad_year" class="form-control" id="grad_year">
                        <x-years />
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary" id="education-save-btn">{{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>
{{-- Certification Modal --}}
<div class="modal fade" id="certification_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Certificate')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="eduaction_form" method="post">
                    <label class="font-size-ms font-weight-bold"
                        for="name">{{__('CertificationsDiplomasorAwards')}}:</label>
                    <input type="text" name="name" class="form-control" id="cert_name">
                    <label for="organization">{{__('IssuingAgency')}}:</label>
                    <input type="text" name="organization" class="form-control" id="organization">
                    <label for="subjects">{{__('DetailedDescriptionOfCertification')}}:</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                    <label for="issue_date">{{__('DateofIssue')}}:</label>
                    <input type="date" class="form-control" name="issue_date" id="issue_date">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary" id="certification-save-btn">{{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>
{{-- Publication Modal --}}
<div class="modal fade" id="publication_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('PromoteYourArticles')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="publication_form" method="post">
                    <label class="font-size-ms font-weight-bold"
                        for="pub_title">{{__('ArticlePromotionTitle')}}:</label>
                    <input type="text" name="pub_title" class="form-control" id="pub_title">
                    <label for="pub_name">{{__('ArticlePublicityIssue')}}:</label>
                    <input type="text" name="pub_name" class="form-control" id="pub_name">
                    <label for="pub_summary">{{__('ArticleContents')}}:</label>
                    <textarea class="form-control" name="description" id="pub_summary" cols="30" rows="10"></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary" id="publication-save-btn">{{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>

{{-- ====================== --}}
{{-- ===== MODELS END ===== --}}
{{-- ====================== --}}


<script>
    function saveFun() {
            window.location.replace('/profile');
        }

        function uploadBtn() {
            document.getElementById("upload-cover-img-btn").style.display = "inline";
        }

        function addSkills() {
            document.getElementById("skill_select_block").style.display = "inline";
        }

        function addCerts() {
            document.getElementById("cert_select_block").style.display = "inline";
        }

        function uploadProfBtn() {
            $('#profile_img').attr('src', URL.createObjectURL(event.target.files[0]));
            document.getElementById("upload-profile-img-btn").style.display = "inline";
        }

        function ShowHideCompletion(chkStatus) {
            var status = document.getElementById("completion_at_row");
            status.style.display = chkStatus.checked ? "none" : "block";
            document.getElementById("completion_at").value = null;
        }

        function ShowHideCompletionUpdate(chkStatus) {
            var status = document.getElementById("completion_at_row_update");
            status.style.display = chkStatus.checked ? "none" : "block";
            document.getElementById("completion_at_update").value = null;
        }
</script>
@endsection