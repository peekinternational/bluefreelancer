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
                    <a class="nav-link px-3 py-2 active" href="{{ route('/setting/profile') }}">
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
                    <a class="nav-link px-3 py-2" href="{{ route('/setting/account') }}">
                        <i class="fa fa-shield mr-1"></i>
                        {{ __('Account') }}
                    </a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content bg-white" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel"
                        aria-labelledby="v-pills-profile-tab">
                        <div class="bg-secondary text-center bg-cover py-5"
                            style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
                            <h1 class="h5 font-weight-bold text-white">{{ __('SetProfileInformation') }}</h1>
                        </div>
                        <div class="p-5">
                            <form action="{{ route('/setting/profile') }}" method="post">
                                @csrf
                                <h2 class="font-weight-bold pb-2">{{ __('ProfileInformation') }}</h2>
                                <hr>
                                <h6 class="font-weight-bold pb-2">{{ __('name') }}</h6>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-size-ms" for="name">{{ __('name') }}</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="{{ __('RegEnterName') }}" name="name"
                                                value="{{ auth()->user()->name }}">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h6 class="font-weight-bold pb-2">{{ __('Address') }}</h6>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-size-ms font-weight-bold"
                                                for="address">{{ __('Address') }}</label>
                                            <input type="text" class="form-control" id="address"
                                                placeholder="{{ __('RegAddress') }}" name="address"
                                                value="{{ auth()->user()->address }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-size-ms font-weight-bold"
                                                for="city">{{ __('City') }}</label>
                                            <input type="text" class="form-control" id="city"
                                                placeholder="{{ __('InputCityName') }}" name="city"
                                                value="{{ auth()->user()->city }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-size-ms font-weight-bold"
                                                for="zipCode">{{ __('zipCode') }}</label>
                                            <input type="text" class="form-control" id="zipCode"
                                                placeholder="{{ __('zipCodeRequired') }}" name="zipcode"
                                                value="{{ auth()->user()->zipcode }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-size-ms font-weight-bold"
                                                for="state">{{ __('State/Province') }}</label>
                                            <input type="text" class="form-control" id="state"
                                                placeholder="{{ __('State/Province') }}" name="state"
                                                value="{{ auth()->user()->state }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-size-ms font-weight-bold"
                                                for="country">{{ __('Country') }}</label>
                                            <select class="custom-select" id="country" name="country">
                                                <option value="" selected="selected">Please Select Your Country / 국가를 선택하십시오
                                                </option>
                                                @foreach (App\Models\Country::all() as $item)
                                                    <option value="{{ $item->name }}"
                                                        {{ $item->name == auth()->user()->country ? 'selected' : '' }}>
                                                        {{ $item->name }} -
                                                        {{ $item->code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-size-ms font-weight-bold"
                                                for="company">{{ __('Comp') }}</label>
                                            <input type="text" class="form-control" id="company"
                                                placeholder="{{ __('RegCompanyName') }}" name="companyname"
                                                value="{{ auth()->user()->companyname }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-size-ms font-weight-bold"
                                                for="timezone">{{ __('TimeZone') }}</label>
                                            <input type="text" class="form-control" id="timezone"
                                                placeholder="{{ __('TimeZone') }}" name="timezone"
                                                value="{{ auth()->user()->timezone }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-size-ms font-weight-bold"
                                                for="location">{{ __('location') }}</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="location"
                                                    placeholder={{ __('location') }}" name="location"
                                                    value="{{ auth()->user()->location }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary">
                                                        <i class="fa fa-map-marker"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h6 class="font-weight-bold pb-2">{{ __('MobilePhoneNumber') }}</h6>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-size-ms"
                                                for="number">{{ __('MobilePhoneNumber') }}:</label>
                                            <span class="font-size-sm ml-2">+923487991015</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-size-ms" for="country2">{{ __('Country') }}:</label>
                                            <span class="font-size-sm ml-2">{{ auth()->user()->country }}</span>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="text-center">
                                    <input type="submit" class="btn btn-primary btn-wide" value="{{ __('Save') }}"
                                        name="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
