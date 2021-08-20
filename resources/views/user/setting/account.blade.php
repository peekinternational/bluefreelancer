@extends('layouts.app')
@section('content')
    <div class="bg-secondary py-4">
        <div class="container pt-2 pb-3">
            <div class="d-flex flex-column flex-md-row align-items-center">
                <a href="./project-list.html" class="btn btn-block bg-gray-800 text-white w-md-auto mt-2 mr-md-2">Browse
                    Projects</a>
                <a href="./contest-list.html" class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">Browse
                    Contests</a>
                <a href="./browse-category.html" class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">Browse
                    Categories</a>
                <a href="./showcase.html" class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">Showcase</a>
                <a href="./contest-post.html" class="btn btn-block btn-primary w-md-auto ml-auto">Start a Contest</a>
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
                    <a class="nav-link px-3 py-2" 
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
                    <a class="nav-link px-3 py-2 active" 
                        href="{{ route('/setting/account') }}">
                        <i class="fa fa-shield mr-1"></i>
                        Account
                    </a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content bg-white" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab">
                        <div class="bg-secondary text-center bg-cover py-5"
                            style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
                            <h1 class="h5 font-weight-bold text-white">Account setting</h1>
                        </div>
                        <div class="p-5">
                            <h2 class="font-weight-bold pb-2">Account</h2>

                            <hr>
                            <form action="{{ route('/setting/account') }}" method="post">
                                @csrf
                                <h6 class="font-weight-bold pb-2">Setting up a freelance list</h6>

                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch3" checked>
                                    <label class="custom-control-label font-size-sm font-weight-bold" for="customSwitch3">I
                                        want
                                        to be registered on the freelance list so that I can hire myself for the project
                                        work.</label>
                                </div>

                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch4" checked>
                                    <label class="custom-control-label font-size-sm font-weight-bold" for="customSwitch4">I
                                        want
                                        to be notified to all freelancers after registration of project, contest,
                                        service.</label>
                                </div>

                                <hr>

                                <h6 class="font-weight-bold pb-2">Select Amount</h6>
                                <p class="font-size-sm">If you want to change your account:</p>

                                <div class="pt-4">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" name="usertype"
                                            class="custom-control-input"
                                            {{ auth()->user()->usertype == '3' ? 'checked' : '' }} value="3">
                                        <label class="custom-control-label font-size-sm font-weight-bold"
                                            for="customRadioInline1">Freelancer</label>
                                    </div>
                                    {{ auth()->user()->usertype == '2' ? 'checked' : '' }}
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="usertype"
                                            class="custom-control-input"
                                            {{ auth()->user()->usertype == '2' ? 'checked' : '' }} value="2">
                                        <label class="custom-control-label font-size-sm font-weight-bold"
                                            for="customRadioInline2">Client</label>
                                    </div>
                                </div>

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
