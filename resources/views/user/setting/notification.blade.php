@extends('layouts.app')
@section('content')
    <x-head-links></x-head-links>

    <section class="container py-5">
        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills sticky-top" style="top: 5rem;" aria-orientation="vertical">
                    <a class="nav-link px-3 py-2" href="{{ route('/setting/profile') }}">
                        <i class="fa fa-user mr-1"></i>
                        {{ __('profile') }}
                    </a>
                    <a class="nav-link px-3 py-2 active" href="{{ route('/setting/notification') }}">
                        <i class="fa fa-envelope-open mr-1"></i>
                        {{ __('Notification') }}
                    </a>
                    <a class="nav-link px-3 py-2" href="{{ route('/setting/password') }}">
                        <i class="fa fa-unlock mr-1"></i>
                        {{ __('password') }}
                    </a>
                    <a class="nav-link px-3 py-2" href="{{ route('/setting/account') }}">
                        <i class="fa fa-shield mr-1"></i>
                        {{ __('Account') }}
                    </a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content bg-white" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-notification" role="tabpanel"
                        aria-labelledby="v-pills-notification-tab">
                        <div class="bg-secondary text-center bg-cover py-5"
                            style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
                            <h1 class="h5 font-weight-bold text-white">{{ __('notificationSetting') }}</h1>
                        </div>
                        <div class="p-5">
                            <h2 class="font-weight-bold pb-2">{{ __('Notification') }}</h2>

                            <hr>

                            <h6 class="font-weight-bold pb-2">{{ __('emailAddress') }}</h6>
                            <form action="{{ route('/setting/email') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-size-ms" for="email">{{ __('emailAddress') }}</label>
                                            <input type="email" class="form-control" id="email"
                                                placeholder="{{ __('emailAddress') }}"
                                                value="{{ auth()->user()->email }}" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6 align-self-end">
                                        <div class="form-group">
                                            <input type="submit" value="{{ __('UpdateEmail') }}" class="btn btn-secondary"
                                                name="submit">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>

                            <h6 class="font-weight-bold pb-2">{{ __('IWantToReceiveNewProjects') }}</h6>
                            <p class="font-size-sm">{{ __('WithThisFeature') }}</p>
                            <ul class="text-info py-4">
                                <li>{{ __('IfFreelancerSupports') }}</li>
                                <li>{{ __('IfFreelancerApproves') }}</li>
                                <li>{{ __('WhenFreelancerRequests') }}</li>
                                <li>{{ __('WhenFreelancerSubmits') }}</li>
                                <li>{{ __('WhenClientCreates') }}</li>
                                <li>{{ __('IfTheClientPays') }}</li>
                                <li>{{ __('WhenEvaluatingProject') }}</li>
                            </ul>
                            {{-- <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                                <label class="custom-control-label font-size-sm font-weight-bold" for="customSwitch1">If the
                                    amount of the project is canceled or renewed</label>
                            </div> --}}

                            <hr>

                            <h6 class="font-weight-bold pb-2">{{ __('ProjectNotifications') }}</h6>
                            <p class="font-size-sm">{{ __('WhenYouUse') }}</p>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="notifications-notify-projects"
                                    {{ auth()->user()->notify_all_projects == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label font-size-sm font-weight-bold"
                                    for="notifications-notify-projects">{{ __('NotifyMeWhen') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
