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

    <section class="container py-5">
        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills sticky-top" style="top: 5rem;" aria-orientation="vertical">
                    <a class="nav-link px-3 py-2" href="{{ route('/setting/profile') }}">
                        <i class="fa fa-user mr-1"></i>
                        {{ __('profile') }}
                    </a>
                    <a class="nav-link px-3 py-2" href="{{ route('/setting/notification') }}">
                        <i class="fa fa-envelope-open mr-1"></i>
                        {{ __('Notification') }}
                    </a>
                    <a class="nav-link px-3 py-2" href="{{ route('/setting/password') }}">
                        <i class="fa fa-unlock mr-1"></i>
                        {{ __('password') }}
                    </a>
                    <a class="nav-link px-3 py-2 active" href="{{ route('/setting/account') }}">
                        <i class="fa fa-shield mr-1"></i>
                        {{ __('Account') }}
                    </a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content bg-white" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-account" role="tabpanel"
                        aria-labelledby="v-pills-account-tab">
                        <div class="bg-secondary text-center bg-cover py-5"
                            style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
                            <h1 class="h5 font-weight-bold text-white">{{ __('accountHeading') }}</h1>
                        </div>
                        <div class="p-5">
                            <h2 class="font-weight-bold pb-2">{{ __('Account') }}</h2>

                            <hr>
                            <form action="{{ route('/setting/account') }}" method="post">
                                @csrf
                                <h6 class="font-weight-bold pb-2">{{ __('SettingUpFreelanceList') }}</h6>

                                {{-- <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch3" checked>
                                    <label class="custom-control-label font-size-sm font-weight-bold" for="customSwitch3">I
                                        want
                                        to be registered on the freelance list so that I can hire myself for the project
                                        work.</label>
                                </div> --}}

                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="account-notify-freelancer"
                                        {{ auth()->user()->notify_all_freelancers == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label font-size-sm font-weight-bold"
                                        for="account-notify-freelancer">{{ __('IWantToBeNotified') }}</label>
                                </div>

                                <hr>

                                <h6 class="font-weight-bold pb-2">{{ __('SelectAmount') }}</h6>
                                <p class="font-size-sm">{{ __('IfYouWantToChangeAccount') }}</p>

                                <div class="pt-4">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" name="usertype"
                                            class="custom-control-input"
                                            {{ auth()->user()->usertype == '3' ? 'checked' : '' }} value="3">
                                        <label class="custom-control-label font-size-sm font-weight-bold"
                                            for="customRadioInline1">{{ __('freelancer') }}</label>
                                    </div>
                                    {{-- {{ auth()->user()->usertype == '2' ? 'checked' : '' }} --}}
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="usertype"
                                            class="custom-control-input"
                                            {{ auth()->user()->usertype == '2' ? 'checked' : '' }} value="2">
                                        <label class="custom-control-label font-size-sm font-weight-bold"
                                            for="customRadioInline2">{{ __('Client') }}</label>
                                    </div>
                                </div>
                                <p><span><b>{{ __('Note') }}:</b></span>{{ __('IWantToBeRegistered') }}</p>

                                <hr>

                                <div class="text-center">
                                    <input type="submit" value="Set up" class="btn btn-primary btn-wide">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
