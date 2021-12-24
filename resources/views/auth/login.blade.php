@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-6 bg-primary">
                <div class="col-md-8 px-0 mx-auto sticky-top">
                    <div class="container px-0">
                        <div class="py-5">
                            <h2 class="text-white pt-lg-4">
                                <div class="h1 font-weight-bold mb-4">{{ __('BestFreeLancers') }}
                                </div>
                                <div class="h5">{{ __('AnyoneCanSupport') }}
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
                            <h4 class="h5 text-white mb-0">{{ __('loginOutSourcing') }}</h4>
                        </div>

                        <form class="mb-4" name="" novalidate="" autocomplete="off"
                            action="{{ route('login') }}" method="post">
                            @csrf
                            <fieldset>
                                @if (session()->has('status'))
                                    <div class="text-danger">{{ session('status') }}</div>
                                @endif
                                
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group">
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="{{ __('RegUserName') }}" required value="{{ old('username') }}">
                                </div>
                                

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('RegPwd') }}" required>
                                </div>
                                
                                <div class="form-group">
                                    <a href="/forgot"><i class="fa fa-lock mr-2"></i> {{ __('forgetPassword') }}?</a>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary btn-block"><span translate="signin"
                                            class="ng-scope">{{ __('signin') }}</span></button>
                                </div>

                                <div class="form-group">
                                    <i class="fa fa-key mr-2" aria-hidden="true"></i>
                                    <span>{{ __('dontAccount') }}</span>?&nbsp;
                                    <a href="{{ route('register') }}">{{ __('signup') }}</a>
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
                                    <span translate="download" class="ng-scope">{{__('download')}}</span>
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