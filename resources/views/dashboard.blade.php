@extends('layouts.app')
@section('content')
    <!-- Page Content -->
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

    <!-- Title -->
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
        <h1 class="h5 font-weight-bold text-white">{{ __('MyDashboard') }}</h1>
    </div>

    <section class="container py-5">
        <div class="row">
            <div class="col-md-7">
                <div class="card card-bordered card-body text-center rounded-xl bg-cover py-5 mb-4"
                    style="background-image: url({{ url('assets/img/dashboard/banner-2.png') }});">
                    <h2 class="h5 font-weight-bold text-white">{{ __('LookingForaProfessionalFreelanceInAnyField') }}</h2>
                    <p class="text-primary mb-4 pb-3">{{ __('YouCanMeetanIncredibleProfessionalFreelancer') }}
                    </p>

                    <div class="text-center mb-4 pb-3">
                        <a class="btn btn-outline-light mb-2 mx-2" href="./project-post">Web siteㆍInformationㆍSoftware</a>
                        <a class="btn btn-outline-light mb-2 mx-2" href="./project-post">Mobile phoneㆍComputing</a>
                        <a class="btn btn-outline-light mb-2 mx-2" href="./contest-post">DesignㆍMediaㆍArchitecture</a>
                        <a class="btn btn-outline-light mb-2 mx-2" href="./project-post">Writing · Contents</a>
                        <a class="btn btn-outline-light mb-2 mx-2" href="./project-post">Engineering · Science</a>
                        <a class="btn btn-outline-light mb-2 mx-2"
                            href="./project-post">BusinessㆍAccountingㆍPersonnelㆍLaw</a>
                        <a class="btn btn-outline-light mb-2 mx-2" href="./project-post">Data input / Management</a>
                        <a class="btn btn-outline-light mb-2 mx-2" href="./project-post">Product SourcingㆍManufacturing</a>
                        <a class="btn btn-outline-light mb-2 mx-2" href="./project-post">Translation / Language</a>
                    </div>

                    <p class="text-primary mb-0">{{ __('SaveTimeAndMoneyWithOnlineliveVideoChat') }}</p>
                </div>

                <div class="card card-bordered rounded-xl mb-4">
                    <div class="card-header py-4">
                        <h2 class="h5 font-weight-bold mb-0">{{ __('newsFeed') }}</h2>
                    </div>
                    <ul class="list-group list-group-flush">
                        @if ($newsFeed->count())
                            @foreach ($newsFeed as $item)
                                <li class="list-group-item d-flex px-0">
                                    <div class="col-md-2">
                                        <img class="rounded-circle"
                                            src="{{ auth()->user()->img == '' ? url('assets/img/pages/default.png') : url('uploads/users/' . auth()->id() . '/images/' . auth()->user()->img) }}"
                                            width="64" alt="user">
                                    </div>
                                    <div class="col-md-6 font-size-sm pt-2">
                                        {{ $item->message }}
                                    </div>
                                    <div class="col-md-4 font-size-xs text-right pt-2">
                                        {{ $item->created_at->format('M d, Y h:i A') }}
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <span class="text-danger text-center">Not Found</span>
                        @endif

                    </ul>
                    <div class="card-body text-center">
                        {{ $newsFeed->links() }}
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card card-bordered card-body rounded-xl mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <img class="rounded-circle shadow-lg"
                                src="{{ auth()->user()->img == '' ? url('assets/img/pages/default.png') : url('uploads/users/' . auth()->id() . '/images/' . auth()->user()->img) }}"
                                width="112" alt="user">
                        </div>

                        <div class="col-md-8 text-center">
                            <h5 class="font-size-sm">{{ __('welcomeBack') }}</h5>
                            <h2 class="h5 font-weight-bold">{{ auth()->user()->name }}</h2>
                            <span class="badge badge-danger badge-icon">
                                <i class="fa fa-trophy"></i>
                            </span>
                            <div class="py-2"></div>
                            <div class="btn-group btn-group-sm">
                                <a href="/project/my-project/employer/open-projects" class="btn btn-secondary">{{__('myProject')}}</a>
                                <a href="/profile" class="btn btn-secondary">{{__('viewProfile')}}</a>
                            </div>
                        </div>
                    </div>

                    {{-- <h5 class="font-size-lg font-weight-bold pt-4 pb-4">{{__('SetupYourAccount')}}</h5> --}}
                    {{-- <div class="progress mb-2">
                        <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75"
                            aria-valuemin="0" aria-valuemax="100">75%</div>
                    </div> --}}
                    {{-- <a class="font-size-sm" href="#">+ Verify Payment Method 25%</a> --}}
                </div>

                <div class="card card-bordered card-body font-size-sm rounded-xl mb-4">
                    <p class="mb-4">
                        <a class="d-block mt-3" href="https://www.google.co.kr/chrome/browser/desktop/index.html"
                            target="_blank">
                            <img class="mr-2" src="{{ url('assets/img/brands/chrome-logo.png') }}">
                            <span>{{__('download')}}</span>
                        </a>
                        <br>
                        <i class="fa fa-laptop mr-2"></i>
                        <span>{{__('OptimizedForGoogleChrome')}}</span>
                    </p>
                    <p>
                        <i class="fa fa-video-camera mr-2"></i>
                        {{__('choromeExtensionParagraph')}}
                    </p>
                </div>

                <div class="card card-bordered card-body font-size-sm rounded-xl mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <h2 class="font-weight-bold text-center">
                            {{ auth()->user()->bids }}
                            <small class="d-block font-size-sm pt-2">{{__('bidsLeft')}}</small>
                        </h2>
                        <a href="#" class="btn btn-secondary ml-auto">{{__('GetmoreBids')}}</a>
                    </div>

                    <p class="mb-0">{{__('NumberOfBids')}}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
