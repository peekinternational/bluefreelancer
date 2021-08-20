@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-6 bg-primary">
                <div class="col-md-8 px-0 mx-auto sticky-top">
                    <div class="container px-0">
                        <div class="py-5">
                            <h2 class="text-white pt-lg-4">
                                <div class="h1 font-weight-bold mb-4">The best freelancers will help you grow your business.
                                </div>
                                <div class="h5">Anyone can support all projects and contests with a fixed amount of time.
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
                            <h4 class="h5 text-white mb-0">Login to Bluefreelancer</h4>
                        </div>

                        <form class="mb-4" name="" novalidate="" autocomplete="off" action="{{ route('login') }}"
                            method="post">
                            @csrf
                            <fieldset>
                                @if (session()->has('status'))
                                    <div class="text-danger">{{ session('status') }}</div>
                                @endif
                                <div class="form-group">
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Please enter your username" required>
                                </div>
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Please enter your password" required>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group">
                                    <a href="forgot.html"><i class="fa fa-lock mr-2"></i> Forgot your password?</a>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary btn-block"><span translate="signin"
                                            class="ng-scope">Sign In</span></button>
                                </div>

                                <div class="form-group">
                                    <i class="fa fa-key mr-2" aria-hidden="true"></i>
                                    <span>Dont have an account</span>?&nbsp;
                                    <a href="{{ route('register') }}">Sign Up</a>
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
