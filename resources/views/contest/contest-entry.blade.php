@extends('layouts.app')
@section('content')
    <!-- Page Content -->
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

    <!-- Title -->
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
        <h1 class="h5 font-weight-bold text-white">{{ __('YouCanRegisterForTheContest') }}</h1>
    </div>

    <div class="bg-gray-500 pt-3">
        <div class="container">
            <div class="d-sm-flex justify-content-between align-items-center mb-3 mb-sm-2">
                <h4 class="font-weight-bold text-white mb-3 mb-sm-0">{{ $contest->title }}</h4>
                <div>
                    <sapn class="badge bg-warning-alt2 font-size-lg text-white p-2">
                        {{ __('deadline') }} {{ $contest->days }} {{ __('days') }}
                    </sapn>
                    <div class="font-size-lg font-weight-bold text-white order-sm-1 py-2">
                        <h3 class="font-weight-bold"> {{ __('PRIZE') }} {{ $contest->currency == 'USD' ? '$' : '₩' }}
                            {{ $contest->budget }}</h3>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <section class="container py-5">
        <h2 class="h4 font-weight-bold mb-4">
            <i class="fa fa-pencil mr-2"></i>
            {{ __('YouCanRegisterForTheContest') }}
        </h2>
        <p class="font-size-sm font-weight-bold mb-4 pl-4 ml-3 pb-1">
            <i class="fa fa-warning text-danger mr-2"></i> {{ __('Below') }} <span
                class="icon icon-sm bg-secondary text-white mx-1">1</span> {{ __('From') }} <span
                class="icon icon-sm bg-secondary text-white mx-1">4</span> {{ __('RequiredItemsMustFilloutInTheOrder') }}
        </p>
        <form action="{{ route('contest-entry.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="entry_contest_id" value="{{ request()->route('id') }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-bordered rounded-xl shadow p-md-4 mb-4">
                        <div class="card-body px-5">
                            <div class="form-group mb-4">
                                <div class="font-size-sm font-weight-bold mb-3">
                                    <div class="icon bg-secondary text-white mr-2">1</div>
                                    {{ __('ContestTitle') }}:
                                </div>
                                <input type="text" class="form-control" id="contest_entry_title"
                                    placeholder="{{ __('ContestTitle') }}" name="entry_title" required>
                                @error('entry_title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <div class="font-size-sm font-weight-bold mb-3">
                                    <div class="icon bg-secondary text-white mr-2">2</div>
                                    {{ __('Details') }}:
                                </div>
                                <textarea class="form-control" id="contest_entry_details"
                                    placeholder="{{ __('EntryDetails') }}" name="entry_details" id="" cols="30" rows="7"
                                    required></textarea>
                                @error('entry_details')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <div class="font-size-sm font-weight-bold mb-3">
                                    <div class="icon bg-secondary text-white mr-2">3</div>
                                    {{ __('SupportAmount') }}:
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            {{ $contest->currency == 'USD' ? '$' : '₩' }}
                                        </div>
                                    </div>
                                    <input type="number" class="form-control" placeholder="0" name="entry_amount"
                                        required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            {{ $contest->currency == 'USD' ? 'USD' : 'KRW' }}
                                        </div>
                                    </div>
                                    @error('entry_amount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <hr>
                            <h3 class="font-size-md font-weight-bold text-right">
                                Total (excluding VAT) : $1,000
                            </h3> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-bordered rounded-xl shadow p-md-4 mb-4">
                        <div class="card-body px-5">
                            <div class="form-group mb-4">
                                <div class="font-size-sm font-weight-bold mb-3">
                                    <div class="icon bg-secondary text-white mr-2">4</div>
                                    {{ __('file') }}:
                                </div>
                                <input type="file" name="entry_file" max="1M" required>
                                @error('entry_file')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <p class="font-size-sm font-weight-bold">
                                <i class="fa fa-warning mr-2"></i>
                                {{ __('attachFile') }}
                            </p>
                            <p class="font-size-sm font-weight-bold">
                                <i class="fa fa-warning mr-2"></i>
                                {{ __('ContestEntryOne') }}
                            </p>
                            <p class="font-size-sm font-weight-bold">
                                <i class="fa fa-warning mr-2"></i>
                                {{ __('ContestEntryTwo') }}
                            </p>
                            <input type="submit" class="btn btn-secondary" value="Participate in Contest">
                            <p class="font-size-sm font-weight-bold text-danger my-2">
                                <i class="fa fa-warning mr-2"></i>
                                {{ __('ContestEntryThree') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
