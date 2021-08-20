@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-6 bg-primary">
                <div class="col-md-8 px-0 mx-auto sticky-top">
                    <div class="container px-0">
                        <div class="py-5">
                            <h2 class="text-white pt-lg-4">
                                <div class="h1 font-weight-bold mb-4">Sign Up for your FREE account</div>
                                <div class="h5">
                                    <ol class="pl-3">
                                        <li>Proven freelance credit card deposit payment system.</li>
                                        <li>Support for client and freelancer connection Project and contest free
                                            registration.</li>
                                        <li>Proven freelance Real-time video chat support.</li>
                                    </ol>
                                </div>
                            </h2>
                        </div>

                        <div class="mt-5 py-5 d-none d-lg-block">
                            <h2 class="h5 text-white pt-5 my-4">If you do not create your profile, it will be automatically
                                deleted after one week.</h2>
                            <h2 class="h6 text-white-75">Bluefreelancer is optimized for Google Chrome</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 py-5 bg-light">
                <div class="col-md-8 px-0 mx-auto">
                    <div class="container px-0">
                        <div class="bg-primary text-center rounded-sm p-4 my-4">
                            <h4 class="h5 text-white mb-0">Sign Up to Bluefreelancer</h4>
                        </div>

                        <form class="mb-4" name="" novalidate="" autocomplete="off" action="{{ route('register') }}"
                            method="post">
                            @csrf
                            <fieldset>
                                <div class="form-group d-flex align-items-center">
                                    <div class="h5 font-weight-bold text-danger mr-2 mb-0">*</div>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter your full name" required value="{{old('name')}}">
                                </div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group d-flex align-items-center">
                                    <div class="h5 font-weight-bold text-danger mr-2 mb-0">*</div>
                                    <input type="text" class="form-control" id="companyName" name="companyname"
                                        placeholder="Company name" required value="{{old('companyname')}}">
                                </div>
                                @error('companyname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group d-flex align-items-center">
                                    <div class="h5 font-weight-bold text-danger mr-2 mb-0">*</div>
                                    <input type="text" class="form-control" id="businessReg" name="business_reg_num"
                                        placeholder="Business registration number (the wrong number is forcibly withdrawn)"
                                        required value="{{old('business_reg_num')}}">
                                </div>
                                @error('business_reg_num')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group d-flex align-items-center">
                                    <div class="h5 font-weight-bold text-danger mr-2 mb-0">*</div>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Enter your email address" required value="{{old('email')}}">
                                </div>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group d-flex align-items-center">
                                    <div class="h5 font-weight-bold text-danger mr-2 mb-0">*</div>
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Enter your user name" required value="{{old('username')}}">
                                </div>
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group d-flex align-items-center">
                                    <div class="h5 font-weight-bold text-danger mr-2 mb-0">*</div>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password (8 or more characters in capital letters and special symbols)"
                                        required>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group d-flex align-items-center">
                                    <div class="h5 font-weight-bold text-danger mr-2 mb-0">*</div>
                                    <input type="password" class="form-control" id="confirmPassword" name="password_confirmation"
                                        placeholder="Confirm your password" required>
                                </div>

                                <div class="form-group py-4">
                                    <h6 class="text-center pb-4">
                                        <i class="fa fa-user-plus mr-2"></i>I want to
                                    </h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="col-4 px-0">
                                            <div>
                                                <input type="radio" class="btn-check" name="usertype" id="hire" value="2">
                                                <label class="btn btn-primary btn-block" for="hire">Hire</label>
                                            </div>
                                            <div class="text-center">Registered Only</div>
                                        </div>

                                        <div class="px-5">
                                            <span translate="or" class="ng-scope">or</span>
                                        </div>

                                        <div class="col-4 px-0">
                                            <div>
                                                <input type="radio" class="btn-check" name="usertype" id="work" value="3">
                                                <label class="btn btn-primary btn-block" for="work">Work</label>
                                            </div>
                                            <div class="text-center">Applicant Only</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group d-flex align-items-center">
                                    <div class="h5 font-weight-bold text-danger mr-2 mb-0">*</div>
                                    <div class="font-weight-bold">Mandatory inputs</div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="userRules">
                                        <label class="custom-control-label" for="userRules">Example <a target="_blank"
                                                href="./user-rules.html">User rules</a> I agree to receive emails</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="userRules1">
                                        <label class="custom-control-label" for="userRules1">Example <a target="_blank"
                                                href="./terms-of-use.html">Term of Use</a> and <a target="_blank"
                                                href="./privacy-statement.html">Privacy Statement</a></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary btn-block"><span translate="signin"
                                            class="ng-scope">Sign In</span></button>
                                </div>

                                <div class="form-group">
                                    <i class="fa fa-user mr-2" aria-hidden="true"></i>
                                    <span>Already have an account</span>?&nbsp;
                                    <a href="signin.html">Sign In</a>
                                </div>
                            </fieldset>
                        </form>

                        <div class="pt-5">
                            <p class="mb-4">
                                <i class="fa fa-laptop mr-2"></i>
                                <span>Bluefreelancer is optimized for Google Chrome desktop</span>
                                <br>
                                <a class="d-block mt-3" href="https://www.google.co.kr/chrome/browser/desktop/index.html"
                                    target="_blank">
                                    <img src="{{ url('assets/img/pages/signin/chrome.png') }}">
                                    <span translate="download" class="ng-scope">Download</span>
                                </a>
                            </p>
                            <p>
                                <i class="fa fa-video-camera mr-2"></i>
                                It works as a live video chat using a Google Chrome browser for the best communication among
                                members. Currently, when using video chat in Internet Explorer (IE), it is not possible to
                                use video chat, but you can use chat but it is a bit inconvenient. We strongly recommend you
                                to use Google Chrome to protect your valuable property. If you download Google Chrome from
                                IE (Internet Explorer), you can click on the chrome icon on your desktop to use the live
                                video chat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
