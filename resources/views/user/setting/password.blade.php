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
                    <a class="nav-link px-3 py-2" 
                        href="{{ route('/setting/notification') }}"
                    >
                        <i class="fa fa-envelope-open mr-1"></i>
                        Notification
                    </a>
                    <a class="nav-link px-3 py-2 active" 
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
                    <div class="tab-pane fade show active" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                        <div class="bg-secondary text-center bg-cover py-5"
                            style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
                            <h1 class="h5 font-weight-bold text-white">Password Change</h1>
                        </div>
                        <div class="p-5">
                            <h2 class="font-weight-bold pb-2">Change Password</h2>

                            <hr>
                            <form action="{{ route('/setting/password') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="font-size-ms" for="cPassword">Current Password</label>
                                    <input type="password" class="form-control" id="cPassword"
                                        placeholder="Enter Your Current Password" name="current_password">
                                    @error('current_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-size-ms" for="nPassword">New Password</label>
                                    <input type="password" class="form-control" id="nPassword"
                                        placeholder="Enter Your New Password" name="new_password">
                                    @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="font-size-ms" for="rcPassword">ReConfirm Password</label>
                                    <input type="password" class="form-control" id="rcPassword"
                                        placeholder="Enter Your New Password" name="password_confirmation">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <hr>

                                <div class="text-center">
                                    <input type="submit" value="Change Password" name="submit" class="btn btn-primary px-4">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
