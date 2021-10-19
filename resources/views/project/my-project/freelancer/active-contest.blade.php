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
                        <a class="nav-link rounded-pill"
                            href="{{ route('my-project.employer.open-projects') }}">{{ __('Employer') }}</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-pill active"
                            href="{{ route('my-project.freelancer.open-projects') }}">{{ __('FreeLancer') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="container pb-5 mb-3 mb-md-4">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-freelancer" role="tabpanel"
                aria-labelledby="pills-freelancer-tab">
                <div class="card rounded-xl overflow-hidden">
                    <div class="card-header bg-secondary">
                        <div class="nav nav-pills nav-pills-light nav-fill flex-column flex-md-row mb-md-n2" id="nav-tabs"
                            role="tablist">
                            <a class="nav-link py-2 " id="nav-open2-tab"
                                href="{{ route('my-project.freelancer.open-projects') }}">{{ __('Opentab') }}</a>
                            <a class="nav-link py-2" id="nav-work2-tab"
                                href="{{ route('my-project.freelancer.work-projects') }}">{{ __('WorkProgess') }}</a>
                            <a class="nav-link py-2" id="nav-past-project2-tab"
                                href="{{ route('my-project.freelancer.past-projects') }}">{{ __('PastProject') }}</a>
                            <a class="nav-link py-2 active" id="nav-active-contest2-tab"
                                href="#nav-active-contest2">{{ __('ActiveContests') }}</a>
                            <a class="nav-link py-2" id="nav-past-contest2-tab"
                                href="{{ route('my-project.freelancer.past-contests') }}">{{ __('PastContests') }}</a>
                        </div>
                    </div>
                </div>

                <div class="row py-4 d-none d-md-flex my-3">
                    <div class="col-md-8 col-lg-10">
                        <form action="{{ route('my-project.freelancer.active-contests') }}" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control"
                                    placeholder="You can find Contests by their names / 이름으로 프로젝트를 찾을 수 있습니다." name="filter"
                                    value="{{ request('filter') ? request('filter') : '' }}">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-4 col-lg-2">
                        <div class="input-group">
                            <select class="custom-select" onchange="window.location.href=this.value;">
                                {{-- <option value="{{ route('my-project.employer.active-contests') }}?limit=1">1 Items</option> --}}
                                <option value="{{ route('my-project.freelancer.active-contests') }}?limit=10"
                                    @if (request('limit') == 10) selected @endif>10 Items | 아이템
                                </option>
                                <option value="{{ route('my-project.freelancer.active-contests') }}?limit=25"
                                    @if (request('limit') == 25) selected @endif>25 Items | 아이템
                                </option>
                                <option value="{{ route('my-project.freelancer.active-contests') }}?limit=50"
                                    @if (request('limit') == 50) selected @endif>50 Items | 아이템
                                </option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-secondary">
                                    <i class="fa fa-refresh"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content border shadow-sm" id="nav-tabsContent">
                    <div class="tab-pane fade show active" id="nav-active-contest2" role="tabpanel"
                        aria-labelledby="nav-active-contest2-tab">
                        <div class="table-responsive">
                            <table class="table font-size-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-nowrap" scope="col">{{ __('CONTESTNAME') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('ENTRIES') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('ClientID') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('MYENTRIES') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('PRIZE') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('DEADLINE') }}</th>
                                        {{-- <th class="text-nowrap" scope="col">ACTION</th> --}}
                                    </tr>
                                </thead>
                                @if ($activeContest->count())
                                    <tbody>
                                        @foreach ($activeContest as $item)
                                            <tr>
                                                <td class="text-nowrap">{{ $item->contest->title }}</td>
                                                <td class="text-nowrap">{{ $item->contestEntries->count() }}</td>
                                                <td class="text-nowrap">
                                                    {{ App\Models\User::find($item->contest->user_id)->username }}</td>
                                                <td class="text-nowrap">{{ $item->title }}</td>
                                                <td class="text-nowrap">{{ $item->amount }}</td>
                                                <td class="text-nowrap">
                                                    {{ $item->created_at->addDays($item->days)->format('M d, Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @else
                                    <caption>
                                        <button class="btn btn-light btn-block">
                                            {{ __('activeContestCaption') }}
                                        </button>
                                    </caption>
                                @endif
                            </table>
                        </div>
                        {{ $activeContest->links('vendor.pagination.simple-bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
