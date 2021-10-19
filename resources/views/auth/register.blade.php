@extends('layouts.app')
<style>
    .btn-primary:not(:disabled):not(.disabled):active,
    .btn-check:checked+.btn-primary {
        color: #fff;
        background-color: #5a5d61 !important;
        border-color: #5a5d61 !important;
    }

</style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-6 bg-primary">
                <div class="col-md-8 px-0 mx-auto sticky-top">
                    <div class="container px-0">
                        <div class="py-5">
                            <h2 class="text-white pt-lg-4">
                                <div class="h1 font-weight-bold mb-4">{{ __('signupForFreeAccount') }}</div>
                                <div class="h5">
                                    <ol class="pl-3">
                                        <li>{{ __('ProvenFreelance') }}</li>
                                        <li>{{ __('RealtimeVideoChatSupport') }}</li>
                                        <li>{{ __('ProjectContestFreeReg') }}</li>
                                    </ol>
                                </div>
                            </h2>
                        </div>

                        <div class="mt-5 py-5 d-none d-lg-block">
                            <h2 class="h5 text-white pt-5 my-4">{{ __('AutomaticallyDeleted') }}</h2>
                            <h2 class="h6 text-white-75">{{ __('OptimizedForGoogleChrome') }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 py-5 bg-light">
                <div class="col-md-8 px-0 mx-auto">
                    <div class="container px-0">
                        <div class="bg-primary text-center rounded-sm p-4 my-4">
                            <h4 class="h5 text-white mb-0">{{ __('signupOutSourcing') }}</h4>
                        </div>

                        <form class="mb-4" name="" novalidate="" autocomplete="off"
                            action="{{ route('register') }}" method="post">
                            @csrf
                            <fieldset>
                                <div class="form-group d-flex align-items-center">
                                    <div class="h5 font-weight-bold text-danger mr-2 mb-0">*</div>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="{{ __('RegEnterName') }}" required value="{{ old('name') }}">
                                </div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group d-flex align-items-center">
                                    <div class="h5 font-weight-bold text-danger mr-2 mb-0">*</div>
                                    <input type="text" class="form-control" id="companyName" name="companyname"
                                        placeholder="{{ __('RegCompanyName') }}" required
                                        value="{{ old('companyname') }}">
                                </div>
                                @error('companyname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group d-flex align-items-center">
                                    <div class="h5 font-weight-bold text-danger mr-2 mb-0">*</div>
                                    <input type="text" class="form-control" id="businessReg" name="business_reg_num"
                                        placeholder="{{ __('RegBusinessName') }}" required
                                        value="{{ old('business_reg_num') }}">
                                </div>
                                @error('business_reg_num')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group d-flex align-items-center">
                                    <div class="h5 font-weight-bold text-danger mr-2 mb-0">*</div>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="{{ __('RegEmail') }}" required value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group d-flex align-items-center">
                                    <div class="h5 font-weight-bold text-danger mr-2 mb-0">*</div>
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="{{ __('RegUserName') }}" required value="{{ old('username') }}">
                                </div>
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group d-flex align-items-center">
                                    <div class="h5 font-weight-bold text-danger mr-2 mb-0">*</div>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="{{ __('RegPwd') }}" required>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group d-flex align-items-center">
                                    <div class="h5 font-weight-bold text-danger mr-2 mb-0">*</div>
                                    <input type="password" class="form-control" id="confirmPassword"
                                        name="password_confirmation" placeholder="{{ __('RegConPwd') }}" required>
                                </div>

                                <div class="form-group py-4">
                                    <h6 class="text-center pb-4">
                                        <i class="fa fa-user-plus mr-2"></i>{{ __('wantTo') }}
                                    </h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="col-4 px-0">
                                            <div>
                                                <input type="radio" class="btn-check" name="usertype" id="hire"
                                                    value="2">
                                                <label class="btn btn-primary btn-block"
                                                    for="hire">{{ __('hire') }}</label>
                                            </div>
                                            <div class="text-center">{{ __('RegisteredOnly') }}</div>
                                        </div>

                                        <div class="px-5">
                                            <span translate="or" class="ng-scope">or</span>
                                        </div>

                                        <div class="col-4 px-0">
                                            <div>
                                                <input type="radio" class="btn-check" name="usertype" id="work"
                                                    value="3">
                                                <label class="btn btn-primary btn-block"
                                                    for="work">{{ __('work') }}</label>
                                            </div>
                                            <div class="text-center">{{ __('ApplicantOnly') }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group d-flex align-items-center">
                                    <div class="h5 font-weight-bold text-danger mr-2 mb-0">*</div>
                                    <div class="font-weight-bold">{{ __('MandatoryInput') }}</div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="userRules">
                                        <label class="custom-control-label" for="userRules">{{ __('example') }} <a
                                                target="_blank" href="./user-rules.html">{{ __('UserRules') }}</a>
                                            {{ __('AgreeforEmails') }}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="userRules1">
                                        <label class="custom-control-label" for="userRules1">{{ __('example') }} <a
                                                target="_blank" href="./terms-of-use.html">{{ __('TermsofUse') }}</a>
                                            {{ __('and') }} <a target="_blank"
                                                href="./privacy-statement.html">{{ __('PrivacyStatement') }}</a></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary btn-block"><span translate="signup"
                                            class="ng-scope">{{ __('signup') }}</span></button>
                                </div>

                                <div class="form-group">
                                    <i class="fa fa-user mr-2" aria-hidden="true"></i>
                                    <span>{{ __('alreadyAccount') }}</span>?&nbsp;
                                    <a href="/login">{{ __('signin') }}</a>
                                </div>
                            </fieldset>
                        </form>

                        <div class="pt-5">
                            <p class="mb-4">
                                <i class="fa fa-laptop mr-2"></i>
                                <span>{{ __('optmizeGoogle') }}</span>
                                <br>
                                <a class="d-block mt-3" href="https://www.google.co.kr/chrome/browser/desktop/index.html"
                                    target="_blank">
                                    <img src="{{ url('assets/img/pages/signin/chrome.png') }}">
                                    <span translate="download" class="ng-scope">{{ __('download') }}</span>
                                </a>
                            </p>
                            <p>
                                <i class="fa fa-video-camera mr-2"></i>
                                {{ __('choromeExtensionParagraph') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
