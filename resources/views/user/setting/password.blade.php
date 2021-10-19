@extends('layouts.app')
@section('content')
<x-head-links></x-head-links>

    <section class="container py-5">
        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills sticky-top" style="top: 5rem;" 
                    aria-orientation="vertical">
                    <a class="nav-link px-3 py-2" 
                        href="{{ route('/setting/profile') }}"  
                       >
                        <i class="fa fa-user mr-1"></i>
                        {{ __('profile') }}
                    </a>
                    <a class="nav-link px-3 py-2" 
                        href="{{ route('/setting/notification') }}"
                    >
                        <i class="fa fa-envelope-open mr-1"></i>
                        {{ __('Notification') }}
                    </a>
                    <a class="nav-link px-3 py-2 active" 
                        href="{{ route('/setting/password') }}" >
                        <i class="fa fa-unlock mr-1"></i>
                        {{ __('password') }}
                    </a>
                    <a class="nav-link px-3 py-2" 
                        href="{{ route('/setting/account') }}">
                        <i class="fa fa-shield mr-1"></i>
                        {{ __('Account') }}
                    </a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content bg-white" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                        <div class="bg-secondary text-center bg-cover py-5"
                            style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
                            <h1 class="h5 font-weight-bold text-white">{{__('PasswordChange')}}</h1>
                        </div>
                        <div class="p-5">
                            <h2 class="font-weight-bold pb-2">{{__('ChnagePassword')}}</h2>

                            <hr>
                            <form action="{{ route('/setting/password') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="font-size-ms" for="cPassword">{{__('CurrentPassword')}}</label>
                                    <input type="password" class="form-control" id="cPassword"
                                        placeholder="{{__('PleaseEnterCurrentPassword')}}" name="current_password">
                                    @error('current_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-size-ms" for="nPassword">{{__('newPassword')}}</label>
                                    <input type="password" class="form-control" id="nPassword"
                                        placeholder="{{__('PleaseEnterNewPassword')}}" name="new_password">
                                    @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="font-size-ms" for="rcPassword">{{__('reconfirmPassword')}}</label>
                                    <input type="password" class="form-control" id="rcPassword"
                                        placeholder="{{__('PleaseReverifyPassword')}}" name="password_confirmation">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <hr>

                                <div class="text-center">
                                    <input type="submit" value="{{__('ChnagePassword')}}" name="submit" class="btn btn-primary px-4">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
