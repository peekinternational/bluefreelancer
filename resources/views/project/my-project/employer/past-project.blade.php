@extends('layouts.app')
@section('content')
    <x-head-links></x-head-links>

    <!-- Title -->
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
        <h1 class="h5 font-weight-bold text-white">{{ __('MyProjectContest') }}</h1>
    </div>

    <section class="container py-5 mt-3 mt-md-4">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-6">
                <h2 class="h5 font-weight-bold mb-3">{{ __('MyProjectContest') }}</h2>
            </div>

            <div class="col-md-6 d-flex justify-content-end">
                <ul class="nav nav-pills nav-pills-dark border border-secondary rounded-pill mb-3" id="pills-tab"
                    role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-pill active"
                            href="{{ route('my-project.employer.open-projects') }}">{{ __('Employer') }}</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-pill "
                            href="{{ route('my-project.freelancer.open-projects') }}">{{ __('FreeLancer') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="container pb-5 mb-3 mb-md-4">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-employeer" role="tabpanel"
                aria-labelledby="pills-employeer-tab">
                <div class="card rounded-xl overflow-hidden">
                    <div class="card-header bg-secondary">
                        <div class="nav nav-pills nav-pills-light nav-fill flex-column flex-md-row mb-md-n2" id="nav-tab"
                            role="tablist">
                            <a class="nav-link py-2 " id="nav-open-tab"
                                href="{{ route('my-project.employer.open-projects') }}">{{ __('Opentab') }}</a>
                            <a class="nav-link py-2" id="nav-work-tab"
                                href="{{ route('my-project.employer.work-projects') }}">{{ __('WorkProgess') }}</a>
                            <a class="nav-link py-2 active" id="nav-past-project-tab"
                                href="#nav-past-project">{{ __('PastProject') }}</a>
                            <a class="nav-link py-2" id="nav-active-contest-tab"
                                href="{{ route('my-project.employer.open-contests') }}">{{ __('OpenContests') }}</a>
                            <a class="nav-link py-2" id="nav-past-contest-tab"
                                href="{{ route('my-project.employer.awarded-contests') }}">{{ __('PrizesAwarded') }}</a>
                        </div>
                    </div>
                </div>

                <div class="row py-4 d-none d-md-flex my-3">
                    <div class="col-md-8 col-lg-10">
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-secondary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-2">
                        <div class="input-group">
                            <select class="custom-select">
                                <option value="1">1 Items | 아이템</option>
                                <option value="10">10 Items | 아이템</option>
                                <option value="25">25 Items | 아이템</option>
                                <option value="50">50 Items | 아이템</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-secondary">
                                    <i class="fa fa-refresh"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content border shadow-sm" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="nav-past-project" role="tabpanel"
                        aria-labelledby="nav-past-project-tab">
                        <div class="table-responsive">
                            <table class="table font-size-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-nowrap" scope="col">{{ __('PROJECTName') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('BID') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('FREELANCE') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('AWARDEDBIDS') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('TIME') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('STATUS') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('ACTION') }}</th>
                                    </tr>
                                </thead>

                                <tbody></tbody>

                                <caption>
                                    <button class="btn btn-light btn-block">
                                        {{ __('pastCaption') }}
                                    </button>
                                </caption>
                            </table>
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm justify-content-center">
                                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
