@extends('layouts.app')
@section('content')
<div class="bg-secondary py-4">
    <div class="container pt-2 pb-3">
        <div class="d-flex flex-column flex-md-row align-items-center">
            <a href="/project-listing" class="btn btn-block bg-gray-800 text-white w-md-auto mt-2 mr-md-2">Browse
                Projects</a>
            <a href="/contest-listing" class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">Browse
                Contests</a>
            <a href="/browse/category" class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">Browse
                Categories</a>
            <a href="/showcases" class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">Showcase</a>
            <a href="/post-contest" class="btn btn-block btn-primary w-md-auto ml-auto">Start a Contest</a>
        </div>
    </div>
</div>

    <section class="container py-5">
        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills sticky-top" style="top: 5rem;" 
                    aria-orientation="vertical">
                    <a class="nav-link px-3 py-2" 
                        href="{{ route('/setting/profile') }}"  
                       >
                        <i class="fa fa-user mr-1"></i>
                        Profile
                    </a>
                    <a class="nav-link px-3 py-2 active" 
                        href="{{ route('/setting/notification') }}"
                    >
                        <i class="fa fa-envelope-open mr-1"></i>
                        Notification
                    </a>
                    <a class="nav-link px-3 py-2" 
                        href="{{ route('/setting/password') }}" >
                        <i class="fa fa-unlock mr-1"></i>
                        Password
                    </a>
                    <a class="nav-link px-3 py-2" 
                        href="{{ route('/setting/account') }}">
                        <i class="fa fa-shield mr-1"></i>
                        Account
                    </a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content bg-white" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-notification" role="tabpanel"
                        aria-labelledby="v-pills-notification-tab">
                        <div class="bg-secondary text-center bg-cover py-5"
                            style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
                            <h1 class="h5 font-weight-bold text-white">Notification Setting</h1>
                        </div>
                        <div class="p-5">
                            <h2 class="font-weight-bold pb-2">Notification</h2>

                            <hr>

                            <h6 class="font-weight-bold pb-2">Email</h6>
                            <form action="{{ route('/setting/email') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-size-ms" for="email">Email Address</label>
                                            <input type="email" class="form-control" id="email"
                                                placeholder="Enter Your Email Address"
                                                value="{{ auth()->user()->email }}" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6 align-self-end">
                                        <div class="form-group">
                                            <input type="submit" value="Update Email Address" class="btn btn-secondary" name="submit">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>

                            <h6 class="font-weight-bold pb-2">I want to receive new projects, contests, and service
                                employment news by email</h6>
                            <p class="font-size-sm">With this feature, you will receive notifications and you will be
                                notified of project, contest, and service adoption emails through various activities such
                                as:</p>
                            <ul class="text-info py-4">
                                <li>If a freelancer supports the project</li>
                                <li>If the freelancer approves the project</li>
                                <li>When a freelancer requests payment</li>
                                <li>When a freelancer submits to a contest</li>
                                <li>When a client creates a deposit</li>
                                <li>If the client pays the deposit</li>
                                <li>When evaluating project completion work</li>
                            </ul>
                            {{-- <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                                <label class="custom-control-label font-size-sm font-weight-bold" for="customSwitch1">If the
                                    amount of the project is canceled or renewed</label>
                            </div> --}}

                            <hr>

                            <h6 class="font-weight-bold pb-2">Project notifications that match your expertise</h6>
                            <p class="font-size-sm">When you use this feature, you will be notified of all projects that
                                match your expertise.</p>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="notifications-notify-projects" {{ auth()->user()->notify_all_projects == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label font-size-sm font-weight-bold" for="notifications-notify-projects">Notify
                                    me when my project is registered</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
